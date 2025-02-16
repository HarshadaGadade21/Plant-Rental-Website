<?php
session_start();
if (!isset($_SESSION['plant_id'])) {
  echo "No order data. Please start again.";
  exit();
}

// Grab posted data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $quantity   = (int)$_POST['quantity'];
  $full_name  = $_POST['full_name'];
  $address    = $_POST['address'];
  $phone      = $_POST['phone'];
} else {
  echo "No form data submitted.";
  exit();
}

// Gather session data
$plantName     = $_SESSION['plant_name'];
$plantPrice    = $_SESSION['plant_price'];
$paymentMethod = $_SESSION['payment_method'];
$promoCode     = $_SESSION['promo_code'];

// Simple total
$totalPrice = $quantity * $plantPrice;

// Generate order ID
$orderID = 'ORD-' . strtoupper(substr(md5(time()), 0, 8));

// In real app, save to DB here, get actual order ID

// Clear session if you want
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>

<header class="main-header">
  <div class="logo">Plant Rental</div>
</header>

<div class="container order-page">
  <h2>Order Confirmed!</h2>
  <p>Your order has been placed successfully.</p>
  <h3>Order ID: <?php echo $orderID; ?></h3>

  <h4>Invoice Summary</h4>
  <ul class="order-summary">
    <li><strong>Plant:</strong> <?php echo htmlspecialchars($plantName); ?></li>
    <li><strong>Quantity:</strong> <?php echo $quantity; ?></li>
    <li><strong>Price (Each):</strong> Rs <?php echo number_format($plantPrice, 2); ?></li>
    <li><strong>Total Price:</strong> Rs <?php echo number_format($totalPrice, 2); ?></li>
    <li><strong>Payment Method:</strong> <?php echo htmlspecialchars($paymentMethod); ?></li>
    <li><strong>Promo Code:</strong> <?php echo htmlspecialchars($promoCode); ?></li>
    <li><strong>Delivery Address:</strong> <?php echo htmlspecialchars($address); ?></li>
    <li><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></li>
    <li><strong>Order Status:</strong> Processing</li>
  </ul>

  <p>Thank you for shopping with us!</p>
</div>

</body>
</html>
