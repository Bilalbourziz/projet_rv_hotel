<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    $sql = $conn->prepare("UPDATE Rooms SET room_type=?, prices=? WHERE id=?");
    $sql->bind_param("ssi", $room_type, $price, $id);
    if ($sql->execute()) {
        header("Location: admin_page.php");
        exit();
    }
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM Rooms WHERE id=?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$room = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Room</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($room['id']) ?>">
            <label for="room_type">Room Type:</label>
            <input type="text" id="room_type" name="room_type" value="<?= htmlspecialchars($room['room_type']) ?>" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($room['prices']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="admin_page.php">Cancel</a>
    </div>
</body>
</html>
