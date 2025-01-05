<?php
session_start();
require_once('./database/db.php'); 


if (!isset($_SESSION['reserve_id'])) {
   
    
    header("Location: reserve.php");
    exit();
}


$price = 0;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $reserve_id = $_SESSION['reserve_id']; 
    $card_num = $_POST['credit-card-num'];
    $exp_month = $_POST['expiration-month'];
    $exp_year = $_POST['expiration-year']; 
    $cvv = $_POST['cvv'];

    
    $card_num = htmlspecialchars($card_num);
    $exp_month = htmlspecialchars($exp_month);
    $exp_year = htmlspecialchars($exp_year);
    $cvv = htmlspecialchars($cvv);

    
    if (empty($card_num) || empty($exp_month) || empty($exp_year) || empty($cvv)) {
        $_SESSION['payment_error'] = "Please fill in all the payment details.";
        header("Location: payement_page.php");
        exit();
    }

    
    if (!preg_match("/^[0-9]{16}$/", $card_num)) {
        $_SESSION['payment_error'] = "Invalid card number. Please check your card details.";
        header("Location: payement_page.php");
        exit();
    }

    
    $stmt = $conn->prepare(
        "INSERT INTO Payments (reserve_id, card_num, exp_month, exp_year, cvv) 
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("issss", $reserve_id, $card_num, $exp_month, $exp_year, $cvv);

    
    if ($stmt->execute()) {
        
        header("Location: success.php");
        exit();
    } else {
      
        $_SESSION['payment_error'] = "There was an error processing your payment. Please try again.";
        header("Location: payement_page.php");
        exit();
    }
}

$sql = $conn->prepare("
SELECT Ro.prices AS price 
FROM Rooms Ro 
JOIN Reservations R ON R.room_id = Ro.id 
WHERE R.id = ?
");


$sql->bind_param("i", $_SESSION['reserve_id']);

$sql->execute();


$result = $sql->get_result();


if ($row = $result->fetch_assoc()) {
    $price = $row['price'];  
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
