<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']);

    // Ensure the client exists
    $delete_sql = $conn->prepare("DELETE FROM Users WHERE id = ?");
    $delete_sql->bind_param("i", $client_id);

    if ($delete_sql->execute()) {
        // Redirect back to the client list page after deletion
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error deleting client.";
    }
} else {
    echo "No client ID provided.";
}
?>
