<?php
session_start();
include '../database/db.php';

// 1. Validate Plant ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "No plant selected for payment.";
    exit();
}
$plant_id = (int)$_GET['id'];

// 2. Fetch the plant
$sql = "SELECT * FROM Plants WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $plant_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    echo "Plant not found.";
    exit();
}
$plant = $result->fetch_assoc();
$stmt->close();
$conn->close();

// EXAMPLE: Hardcoded shipping rates by plant name
$shippingRates = [
    'Fiddle Leaf Fig'      => 0,
    'Snake Plant'          => 50,
    'Pothos'               => 30,
    'Areca Palm'           => 70,
    'Aloe Vera'            => 20,
    'Peace Lily'           => 40,
    'Rubber Plant'         => 60,
    'Bamboo Palm'          => 80,
    'ZZ Plant'             => 50,
    'Monstera Deliciosa'   => 60,
    'Jade Plant'           => 25,
    'Cactus'               => 15,
    'Croton'               => 45,
    'Spider Plant'         => 35,
    'Money Plant'          => 90
];


// 3. Determine shipping cost from the array
$plantName = $plant['name'];
if (array_key_exists($plantName, $shippingRates)) {
    $shipping = $shippingRates[$plantName];
} else {
    // If not in the array, default shipping cost
    $shipping = 0;
}

// 4. Calculate total
$price = (float)$plant['price'];
$total = $price + $shipping;

// 5. Store data in session if needed
$_SESSION['plant_id']   = $plant_id;
$_SESSION['plant_name'] = $plant['name'];
$_SESSION['plant_price'] = $plant['price'];
$_SESSION['shipping']   = $shipping;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Options - <?php echo htmlspecialchars($plant['name']); ?></title>
    <link rel="stylesheet" href="../resources/css/checkout_payment.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">Plant Rental</div>
        <ul>
            <li><a href="plants_list.php">Plants</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Main Container -->
    <div class="payment-container">
        <h1><?php echo htmlspecialchars($plant['name']); ?></h1>
        <div class="price-info">
            <p class="label">Price:</p>
            <p class="value">Rs <?php echo number_format($price, 2); ?></p>
        </div>
        <div class="price-info">
            <p class="label">Shipping:</p>
            <?php if ($shipping > 0): ?>
                <p class="value">Rs <?php echo number_format($shipping, 2); ?></p>
            <?php else: ?>
                <p class="value">Free</p>
            <?php endif; ?>
        </div>
        <div class="price-info total">
            <p class="label">Total:</p>
            <p class="value">Rs <?php echo number_format($total, 2); ?></p>
        </div>

        <h2>Select Payment Method</h2>
        <form action="checkout_order_summary.php" method="post" class="payment-form">
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment_method" value="cod" checked />
                    Cash on Delivery
                </label>
                <label>
                    <input type="radio" name="payment_method" value="upi" />
                    UPI (GPay, PhonePe, Paytm)
                </label>
                <label>
                    <input type="radio" name="payment_method" value="card" />
                    Debit/Credit Card
                </label>
                <label>
                    <input type="radio" name="payment_method" value="netbanking" />
                    Net Banking
                </label>
                <label>
                    <input type="radio" name="payment_method" value="qr" />
                    QR Code
                </label>
            </div>

            <!-- Promo Code -->
            <div class="promo-section">
                <label for="promo_code">Add Promo Code (optional):</label>
                <input type="text" id="promo_code" name="promo_code" placeholder="Enter promo code">
            </div>

            <!-- Next Button -->
            <button type="submit" class="btn-next">Next</button>
        </form>
    </div>

</body>

</html>