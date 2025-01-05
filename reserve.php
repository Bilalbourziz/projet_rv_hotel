<?php
session_start();
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['button1'])) {
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: sign_in.php");
            exit();
        }

       
        $user_id = $_SESSION['user_id'];
        $hotel_id = intval($_POST['hotel_id']);
        $room_id = intval($_POST['room']);
        $chambre_number = intval($_POST['chambre_number']); 
        $check_in_date = $_POST['check-in'];
        $check_out_date = $_POST['check-out'];
        $adults_count = intval($_POST['adults']);
        $children_count = intval($_POST['children']);

        try {
            
            $stmt = $conn->prepare(
                "SELECT chambre_id 
                FROM chambre 
                WHERE chambre_number = ? AND hotel_id = ? AND room_id = ? AND etat_chambre = 'disponible'"
            );
            $stmt->bind_param("iii", $chambre_number, $hotel_id, $room_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                // If the chambre_number is not available, redirect with an error
                $_SESSION['error_message'] = "The selected room is not available for booking.";
                header("Location: error.php");
                exit();
            }

            // Retrieve the chambre_id from the query result
            $chambre_data = $result->fetch_assoc();
            $chambre_id = $chambre_data['chambre_id'];

            // Insert the reservation
            $stmt = $conn->prepare(
                "INSERT INTO Reservations (user_id, room_id, hotel_id, chambre_id, check_in_date, check_out_date, adults_count, children_count) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                "iiiissii",
                $user_id,
                $room_id,
                $hotel_id,
                $chambre_id,
                $check_in_date,
                $check_out_date,
                $adults_count,
                $children_count
            );

            if ($stmt->execute()) {
                
                $_SESSION['reserve_id'] = $conn->insert_id;

                
                header("Location: payement_page.php");
                exit();
            } else {
                throw new Exception("Failed to make a reservation. Please try again.");
            }
        } 
        catch (Exception $e) {
           
            $_SESSION['error_message'] = $e->getMessage();
            header("Location: error.php");
            exit();
        } finally {
            
            if (isset($stmt)) $stmt->close();
            if (isset($conn)) $conn->close();
        }
    } else {
        
        header("Location: index.php");
        exit();
    }
}
?>
