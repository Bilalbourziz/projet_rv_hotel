<?php
require 'database/db.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 
    

    // Insert data into the Users table
    $sql = "INSERT INTO Users (name, email, password) 
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: sing_in.php"); // Redirect to sign in page after successful registration
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Display error message if insertion fails
    }

    $conn->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sign_up.css">
    <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <title>Sign Up</title>
</head>
<body>

<form id="formWrapper" action="" method="POST" id="form">
    <div id="form">
        <div class="logo">
            <img src="images/imageedit_6_4031431126 1.png" style="height: 70px;width:auto;" class="logo1" alt="">
        </div>
        <div class="form-item">
            <p class="formLabel">Full Name</p>
            <input type="text" name="name" id="name" class="form-style" autocomplete="off" required/>
        </div>
        <div class="form-item">
            <p class="formLabel">Email</p>
            <input type="email" name="email" id="email" class="form-style" required/>
        </div>
        <div class="form-item">
            <p class="formLabel">Password</p>
            <input type="password" name="password" id="password" class="form-style" required/>
        </div>
        <div class="form-item">
            <p class="pull-left"><a href="sing_in.php"><small>Already have an account? Sign In</small></a></p>
            <input type="submit" class="login pull-right" value="Sign Up"> <!-- Changed button text to Sign Up -->
            <div class="clear-fix"></div>
        </div>
    </div>
</form>

<script src="styles/sing_in.js"></script>
</body>
</html>
