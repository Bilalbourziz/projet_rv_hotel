<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/success.css"> <!-- Add your CSS file -->
    <title>Success</title>
</head>
<body>
    <div class="container">
        <h1>Success!</h1>
        <p>Your action was completed successfully.</p>
        <p>
            <?php if (isset($_SESSION['user_name'])): ?>
                Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! 
                You can now <a href="index.php">view your bookings</a> or <a href="sing_in.php">sign in again</a>.
            <?php else: ?>
                You can now <a href="sing_in.php">log in</a> to your account.
            <?php endif; ?>
        </p>
        <a href="index.php">Go to Home</a>
    </div>
</body>
</html>
