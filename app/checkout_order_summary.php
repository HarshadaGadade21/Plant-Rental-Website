<?php
session_start();
if (!isset($_SESSION['plant_id'])) {
  echo "No plant info in session. Please start from the product page.";
  exit();
}

// Save payment method & promo code
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['payment_method'] = $_POST['payment_method'];
  $_SESSION['promo_code'] = $_POST['promo_code'] ?? '';
}

$plantName = $_SESSION['plant_name'];
$plantPrice = $_SESSION['plant_price'];
$paymentMethod = $_SESSION['payment_method'];
$promoCode = $_SESSION['promo_code'];

// Simple example of expected delivery (3 days from now)
$expectedDelivery = date('Y-m-d', strtotime('+3 days'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Summary</title>
  <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>

<header class="main-header">
  <div class="logo">Plant Rental</div>
  <nav>
    <ul>
      <li><a href="plants_list.php">Plants</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>
</header>

<div class="container summary-page">
  <h2>Review Your Order</h2>
  <ul class="order-summary">
    <li><strong>Plant:</strong> <?php echo htmlspecialchars($plantName); ?></li>
    <li><strong>Price:</strong> Rs <?php echo number_format($plantPrice, 2); ?></li>
    <li><strong>Payment Method:</strong> <?php echo htmlspecialchars($paymentMethod); ?></li>
    <li><strong>Promo Code:</strong> <?php echo htmlspecialchars($promoCode); ?></li>
  </ul>

  <label>Quantity:</label>
  <form action="order.php" method="post">
    <input type="number" name="quantity" value="1" min="1">
    <p>Expected Delivery Date: <strong><?php echo $expectedDelivery; ?></strong></p>

    <h3>Delivery Address</h3>
    <label>Full Name</label>
    <input type="text" name="full_name" placeholder="Your Name" required>
    <label>Address</label>
    <textarea name="address" rows="3" placeholder="Street, City, State, ZIP" required></textarea>
    <label>Phone Number</label>
    <input type="text" name="phone" placeholder="Your phone number" required>

    <div class="btn-container">
      <button type="submit" class="rent-btn">Place Order</button>
    </div>
  </form>
</div>

</body>
</html>
