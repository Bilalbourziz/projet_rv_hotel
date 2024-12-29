<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if (isset($_GET['id'])) {
    $hotel_id = intval($_GET['id']);

    // Ensure the hotel exists
    $delete_sql = $conn->prepare("DELETE FROM Hotels WHERE id = ?");
    $delete_sql->bind_param("i", $hotel_id);

    if ($delete_sql->execute()) {
        // Redirect back to the hotel list page after deletion
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error deleting hotel.";
    }
} else {
    echo "No hotel ID provided.";
}
?>
