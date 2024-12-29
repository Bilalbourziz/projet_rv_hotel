<?php
session_start();
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['button1'])) {
        // Ensure the user is logged in 
        if (!isset($_SESSION['user_id'])) {
            header("Location: sign_in.php");
            exit();
        }

        // Retrieve data from the form
        $user_id = $_SESSION['user_id'];
        $hotel_id = intval($_POST['hotel_id']);
        $room_id = intval($_POST['room']);
        $chambre_number = intval($_POST['chambre_number']); // Chambre Number entered by the user
        $check_in_date = $_POST['check-in'];
        $check_out_date = $_POST['check-out'];
        $adults_count = intval($_POST['adults']);
        $children_count = intval($_POST['children']);

        try {
            // Validate chambre_number against the database and ensure it's disponible
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
                // Store the reservation ID in the session
                $_SESSION['reserve_id'] = $conn->insert_id;

                // Redirect to success page
                header("Location: payement_page.php");
                exit();
            } else {
                throw new Exception("Failed to make a reservation. Please try again.");
            }
        } 
        catch (Exception $e) {
            // Handle errors gracefully
            $_SESSION['error_message'] = $e->getMessage();
            header("Location: error.php");
            exit();
        } finally {
            // Close resources
            if (isset($stmt)) $stmt->close();
            if (isset($conn)) $conn->close();
        }
    } else {
        // Redirect if the script is accessed without a POST request
        header("Location: index.php");
        exit();
    }
}
?>
