<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if (isset($_GET['id'])) {
    $reserve_id = intval($_GET['id']);

    $delete_sql = $conn->prepare("
        DELETE FROM Reservations 
        WHERE id = ?
    ");
    $delete_sql->bind_param("i", $reserve_id);

    if ($delete_sql->execute()) {
        
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error deleting reservation.";
    }
} else {
    echo "No reservation ID provided.";
}
?>
