<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $user_id = $_POST['user_id'];
    $hotel_id = $_POST['hotel_id'];
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    
    // Update the reservation in the database
    $sql = $conn->prepare("UPDATE Reservations SET user_id=?, hotel_id=?, room_id=?, check_in_date=?, check_out_date=? WHERE id=?");
    $sql->bind_param("iiissi", $user_id, $hotel_id, $room_id, $check_in_date, $check_out_date, $reservation_id);
    
    if ($sql->execute()) {
        header("Location: admin_page.php");
        exit();
    }
}

$reservation_id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM Reservations WHERE id=?");
$sql->bind_param("i", $reservation_id);
$sql->execute();
$result = $sql->get_result();
$reservation = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Reservation</h2>
        <form method="POST" action="">
            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reservation['id']) ?>">
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" value="<?= htmlspecialchars($reservation['user_id']) ?>" required>
            <label for="hotel_id">Hotel ID:</label>
            <input type="number" id="hotel_id" name="hotel_id" value="<?= htmlspecialchars($reservation['hotel_id']) ?>" required>
            <label for="room_id">Room ID:</label>
            <input type="number" id="room_id" name="room_id" value="<?= htmlspecialchars($reservation['room_id']) ?>" required>
            <label for="check_in_date">Check In Date:</label>
            <input type="date" id="check_in_date" name="check_in_date" value="<?= htmlspecialchars($reservation['check_in_date']) ?>" required>
            <label for="check_out_date">Check Out Date:</label>
            <input type="date" id="check_out_date" name="check_out_date" value="<?= htmlspecialchars($reservation['check_out_date']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="admin_page.php">Cancel</a>
    </div>
</body>
</html>
