<?php 
session_start(); 
require __DIR__ . '/../database/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = $conn->prepare("UPDATE Users SET name=?, email=?, password=? WHERE id=?");
    $sql->bind_param("sssi", $name, $email, $password, $id);
    if ($sql->execute()) {
        header("Location: admin_page.php");
        exit();
    }
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM Users WHERE id=?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$client = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Client</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($client['id']) ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($client['name']) ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= htmlspecialchars($client['password']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="admin_page.php">Cancel</a>
    </div>
</body>
</html>
