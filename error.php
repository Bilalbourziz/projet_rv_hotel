<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/error.css"> <!-- Add your CSS file -->
    <title>Error</title>
</head>
<body>
    <div class="container">
        <h1>you have a problem</h1>
        <p>There was an issue processing your request. Please try again later.</p>
        <?php if (isset($_SESSION['error_message'])): ?>
            <p>Error Details: <?php echo htmlspecialchars($_SESSION['error_message']); ?></p>
            <?php unset($_SESSION['error_message']); // Clear the error message after displaying ?>
        <?php endif; ?>
        <a href="sing_up.php">Try Again</a> or <a href="index.php">Go to Home</a>
    </div>
</body>
</html>
