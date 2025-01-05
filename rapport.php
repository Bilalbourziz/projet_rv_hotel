<?php
session_start();
require './database/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: sing_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$count_sql = $conn->prepare("
    SELECT COUNT(*) AS total_reservations 
    FROM Reservations 
    WHERE user_id = $user_id;
");

$count_sql->execute();
$count_result = $count_sql->get_result();
$data_count = $count_result->fetch_assoc();
$total_reservations = $data_count['total_reservations'];

$sql = $conn->prepare("
    SELECT  
       r.id AS reservation_id, 
       h.name AS hotel_name, 
       rm.room_type AS type_room, 
       r.check_in_date AS check_in, 
       r.check_out_date AS check_out, 
       r.adults_count AS adult, 
       r.children_count AS children, 
       c.chambre_number AS num_room 
    FROM Reservations r 
    JOIN Users u ON r.user_id = u.id 
    JOIN Rooms rm ON r.room_id = rm.id 
    JOIN chambre c ON r.chambre_id = c.chambre_id 
    JOIN Hotels h ON r.hotel_id = h.id
    WHERE r.user_id = ? and etat_reserve='termine'
");
$sql->bind_param("i", $user_id);
$sql->execute();
$result = $sql->get_result();

$data_client = [];
while ($row = $result->fetch_assoc()) {
    $data_client[] = $row;
}


if (isset($_GET['id'])) {
    $reserve_id = intval($_GET['id']);

   
    $delete_sql = $conn->prepare("
        DELETE FROM Reservations 
        WHERE id = ? AND user_id = ?
    ");
    $delete_sql->bind_param("ii", $reserve_id, $user_id);

    if ($delete_sql->execute()) {
        
        header("Location: rapport.php");
        exit();
    } else {
        echo "Error deleting reservation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
    <link rel="stylesheet" href="styles/rapport.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
 function confirmDeletion(deleteUrl) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action will remove your reservation permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            
            window.location.href = deleteUrl;
        }
    });
}

    </script>
</head>
<body>
    <div class="container">
        <h1 class="title">Welcome <?php echo $_SESSION['user_name']; ?></h1>
        <h2 class="subtitle">You have <?php echo $total_reservations ; ?> reservation(s)</h2>
        <table>
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Room Type</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Room Number</th>
                    <th>Remove Reservation</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data_client as $data_clients): ?>
                <tr>
                    <td><?= $data_clients["hotel_name"] ?></td>
                    <td><?= $data_clients["type_room"] ?></td>
                    <td><?= $data_clients["check_in"] ?></td>
                    <td><?= $data_clients["check_out"] ?></td>
                    <td><?= $data_clients["adult"] ?></td>
                    <td><?= $data_clients["children"] ?></td>
                    <td><?= $data_clients["num_room"] ?></td>
                    <td>
                    <a href="javascript:void(0);"
       onclick="confirmDeletion('rapport.php?id=<?= $data_clients['reservation_id'] ?>')" 
       style="display: inline-block; padding: 5px 15px; background-color: none; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; border: solid 2px rgb(81, 1, 112); color: rgb(81, 1, 112);">
       Delete
    </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
