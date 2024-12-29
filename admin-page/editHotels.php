<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];

    $sql = $conn->prepare("UPDATE Hotels SET name=?, address=?, contact_info=? WHERE id=?");
    $sql->bind_param("sssi", $name, $address, $contact_info, $id);
    if ($sql->execute()) {
        header("Location: admin_page.php");
        exit();
    }
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM Hotels WHERE id=?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$hotel = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hotel</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Hotel</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($hotel['id']) ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($hotel['name']) ?>" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($hotel['address']) ?>" required>
            <label for="contact_info">Contact Info:</label>
            <input type="text" id="contact_info" name="contact_info" value="<?= htmlspecialchars($hotel['contact_info']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="admin_page.php">Cancel</a>
    </div>
</body>
</html>
