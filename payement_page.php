<?php
session_start();
require_once('./database/db.php'); // Include your database connection

// Ensure the user is logged in and a reservation exists
if (!isset($_SESSION['reserve_id'])) {
    // Redirect to the reservation page or show an error if no reserve_id
    header("Location: reserve.php");
    exit();
}

// Initialize the price variable
$price = 0;

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get payment information from the form
    $reserve_id = $_SESSION['reserve_id']; // Retrieve the reserve_id from the session
    $card_num = $_POST['credit-card-num'];
    $exp_month = $_POST['expiration-month'];
    $exp_year = $_POST['expiration-year']; // Corrected typo
    $cvv = $_POST['cvv'];

    // Sanitize inputs (optional but recommended)
    $card_num = htmlspecialchars($card_num);
    $exp_month = htmlspecialchars($exp_month);
    $exp_year = htmlspecialchars($exp_year);
    $cvv = htmlspecialchars($cvv);

    // Validate the payment data
    if (empty($card_num) || empty($exp_month) || empty($exp_year) || empty($cvv)) {
        $_SESSION['payment_error'] = "Please fill in all the payment details.";
        header("Location: payement_page.php");
        exit();
    }

    // Check if the card number is valid (simple validation)
    if (!preg_match("/^[0-9]{13,19}$/", $card_num)) {
        $_SESSION['payment_error'] = "Invalid card number. Please check your card details.";
        header("Location: payement_page.php");
        exit();
    }

    // Prepare SQL statement to insert payment data into the database
    $stmt = $conn->prepare(
        "INSERT INTO Payments (reserve_id, card_num, exp_month, exp_year, cvv) 
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("issss", $reserve_id, $card_num, $exp_month, $exp_year, $cvv);

    // Execute the query
    if ($stmt->execute()) {
        // Payment successful, redirect to a confirmation page or show a success message
        header("Location: success.php"); // You can create a success page
        exit();
    } else {
        // Handle error
        $_SESSION['payment_error'] = "There was an error processing your payment. Please try again.";
        header("Location: payement_page.php");
        exit();
    }
}

// Prepare the SQL statement to fetch the price
$sql = $conn->prepare("
SELECT Ro.prices AS price 
FROM Rooms Ro 
JOIN Reservations R ON R.room_id = Ro.id 
WHERE R.id = ?
");

// Bind the parameter (assuming $reserve_id is an integer)
$sql->bind_param("i", $_SESSION['reserve_id']); // Assuming the reserve_id is an integer

// Execute the query
$sql->execute();

// Get the result
$result = $sql->get_result();

// Fetch the price from the result
if ($row = $result->fetch_assoc()) {
    $price = $row['price'];  // Get the price for the room
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/paye_style.css">
    <title>Payment Page</title>
</head>
<body>
    <div class="checkout-container">
        <div class="left-side">
            <div class="text-box">
                <h1 class="home-heading">Modern Home</h1>
                <p class="home-price"><em><?php echo htmlspecialchars($price); ?> </em>/ 1 night</p>
                <hr class="left-hr" />
                <p class="home-desc"><em>Entire home </em>for <em>2 guests</em></p>
                <p class="home-desc">
                    <em>Tue, July 23, 2022 </em>to <em>Thu, July 25, 2022</em>
                </p>
            </div>
        </div>

        <div class="right-side">
            <div class="receipt">
                <h2 class="receipt-heading">Receipt Summary</h2>
                <div>
                    <table class="table">
                        <tr>
                            <td><?php echo htmlspecialchars($price); ?> x 2 nights</td>
                            <td class="price"><?php echo htmlspecialchars($price * 2); ?> USD</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td class="price"></td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td class="price"><?php echo htmlspecialchars($price * 2); ?> USD</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td class="price">47.41 USD</td>
                        </tr>
                        <tr class="total">
                            <td>Total</td>
                            <td class="price"><?php echo htmlspecialchars($price * 2 + 47.41); ?> USD</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="payment-info">
                <h3 class="payment-heading">Payment Information</h3>
                <form class="form-box" method="post">
                    <div>
                        <label for="credit-card-num">Card Number
                            <span class="card-logos">
                                <i class="card-logo fa-brands fa-cc-visa"></i>
                                <i class="card-logo fa-brands fa-cc-amex"></i>
                                <i class="card-logo fa-brands fa-cc-mastercard"></i>
                                <i class="card-logo fa-brands fa-cc-discover"></i>
                            </span>
                        </label>
                        <input type="number" id="credit-card-num" name="credit-card-num" placeholder="1111-2222-3333-4444" required min="1000000000000000" max="9999999999999999" />
                    </div>

                    <div>
                        <p class="expires">Expires on:</p>
                        <div class="card-experation">
                            <label for="expiration-month">Month</label>
                            <select id="expiration-month" name="expiration-month" required>
                                <option value="">Month:</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>

                            <label class="expiration-year">Year</label>
                            <select id="expiration-year" name="expiration-year" required>
                                <option value="">Year</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="cvv">CVV</label>
                        <input id="cvv" name="cvv" placeholder="415" type="text" required/>
                        <a class="cvv-info" href="#">What is CVV?</a>
                    </div>

                    <button class="btn"><i class="fa-solid fa-lock"></i> Book Securely</button>
                </form>

                <p class="footer-text">
                    <i class="fa-solid fa-lock"></i>
                    Your credit card information is encrypted
                </p>
            </div>
        </div>
    </div>
</body>
</html>
