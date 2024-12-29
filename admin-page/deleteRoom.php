<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if (isset($_GET['id'])) {
    $room_id = intval($_GET['id']);

    // Ensure the room exists
    $delete_sql = $conn->prepare("DELETE FROM Rooms WHERE id = ?");
    $delete_sql->bind_param("i", $room_id);

    if ($delete_sql->execute()) {
        // Redirect back to the room list page after deletion
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error deleting room.";
    }
} else {
    echo "No room ID provided.";
}
?>
