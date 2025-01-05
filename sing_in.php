<?php
require 'database/db.php'; // Ensure this includes the database connection setup
session_start(); // Start session to track user login state

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); // Directly compare the plain-text password

    // Query to check if the user exists and retrieve their role
    $sql = $conn->prepare("SELECT id, name, password, Role FROM Users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

    
        if ($user['password'] === $password) {
            // Authentication successful
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['user_name'] = $user['name']; // Store user name in session
            $_SESSION['logged_in'] = true; // Track login status

          
            if ($user['Role'] === 'client') {
                header("Location: index.php"); // Redirect to client index page
            } else {
                header("Location: admin-page/admin_page.php"); // Redirect to admin page
            }
            exit();
        } else {
            // Incorrect password
            $error = "Invalid email or password.";
        }
    } else {
        // No user found
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sign_in.css">
    <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <title>Sign In</title>
</head>
<body>

<form action="" method="POST" id="form">
    <div id="formWrapper">
        <div id="form">
            <div class="logo">
                <img src="images/imageedit_6_4031431126 1.png" class="logo1" style="height: 70px;width:auto;" alt="Logo">
            </div>
            <div class="form-item">
                <p class="formLabel">Email</p>
                <input type="email" name="email" id="email" class="form-style" autocomplete="off" required />
            </div>
            <div class="form-item">
                <p class="formLabel">Password</p>
                <input type="password" name="password" id="password" class="form-style" required />
                <p><a href="#" ><small>Forgot Password?</small></a></p>
            </div>

            <!-- Display error messages -->
            <?php if (isset($error)): ?>
                <p style="color: red; text-align: center;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <div class="form-item">
                <p class="pull-left"><a href="sing_up.php"><small>Create Account</small></a></p>
                <input type="submit" class="login pull-right" value="Log In">
                <div class="clear-fix"></div>
            </div>
        </div>
    </div>
</form>

<script src="styles/sing_in.js"></script>
</body>
</html>
