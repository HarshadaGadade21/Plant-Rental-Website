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

// Hardcoded shipping rates by plant name
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

// Determine shipping cost
$plantName = $plant['name'];
$shipping = array_key_exists($plantName, $shippingRates) ? $shippingRates[$plantName] : 0;

// Calculate total
$price = (float)$plant['price'];
$total = $price + $shipping;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Options - <?php echo htmlspecialchars($plant['name']); ?></title>
  <link rel="stylesheet" href="../resources/css/checkout_payment.css">  
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="logo">Plant Rental</div>
  <ul>
    <li><a href="plants_list.php">Plants</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>

<!-- Payment Container -->
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
    <p class="value"><?php echo "Rs ".number_format($total, 2); ?></p>
  </div>

  <h2>Select Payment Method</h2>
  <div class="payment-options">
    <label>
      <input type="radio" name="payment_method" value="cod" checked />
      Cash on Delivery
    </label>
    <label>
      <input type="radio" name="payment_method" value="upi" />
      UPI
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

  <!-- UPI Payment -->
  <div id="upiSection" class="payment-form-section">
    <h3>UPI Payment</h3>
    <input type="text" placeholder="YourUPI@bank" style="width:100%; margin-bottom:10px;">
    <div style="margin-bottom:10px;">
      <label><input type="radio" name="upi_app" value="gpay" checked> GPay</label>
      <label><input type="radio" name="upi_app" value="phonepe"> PhonePe</label>
      <label><input type="radio" name="upi_app" value="paytm"> Paytm</label>
    </div>
    <button class="btn-pay" id="upiPayBtn">Pay &amp; Proceed</button>
  </div>

  <!-- Card Payment -->
  <div id="cardSection" class="payment-form-section">
    <h3>Debit/Credit Card</h3>
    <label>Card Number</label>
    <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" style="width:100%; margin-bottom:10px;">
    <label>Expiry (MM/YY)</label>
    <input type="text" placeholder="MM/YY" style="width:100%; margin-bottom:10px;">
    <label>CVV</label>
    <input type="text" placeholder="XXX" style="width:100%; margin-bottom:10px;">
    <button class="btn-pay" id="cardPayBtn">Pay &amp; Proceed</button>
  </div>

  <!-- Net Banking -->
  <div id="netbankingSection" class="payment-form-section">
    <h3>Net Banking</h3>
    <select style="width:100%; margin-bottom:10px;">
      <option>SBI</option>
      <option>HDFC</option>
      <option>ICICI</option>
      <option>Axis</option>
      <option>Other</option>
    </select>
    <button class="btn-pay" id="netbankingPayBtn">Pay &amp; Proceed</button>
  </div>

  <!-- QR Code Payment -->
  <div id="qrSection" class="payment-form-section">
    <h3>QR Code Payment</h3>
    <p>Scan the code below using your UPI app.</p>
    <img src="../resources/images/QR.jpg" alt="qr-section" class="qr-img">
    <button class="btn-pay" id="qrPaidBtn">I Have Paid</button>
  </div>

  <!-- Promo Code -->
  <div class="promo-section">
    <label>Add Promo Code (optional):</label>
    <input type="text" placeholder="Enter promo code" style="width:100%;">
  </div>

  <!-- "Proceed" for COD -->
  <button class="btn-next" id="proceedBtn">Proceed</button>

  <!-- Final Order Summary -->
  <div class="order-summary" id="orderSummary">
    <h3>Order Summary</h3>
    <p><strong>Plant:</strong> <?php echo htmlspecialchars($plant['name']); ?></p>
    <p><strong>Price:</strong> Rs <?php echo number_format($price, 2); ?></p>
    <p><strong>Shipping:</strong> <?php echo ($shipping>0) ? "Rs ".number_format($shipping,2) : "Free"; ?></p>
    <p><strong>Total:</strong> Rs <?php echo number_format($total,2); ?></p>

    <h4>Delivery Address</h4>
    <input type="text" placeholder="Full Name" style="width:100%; margin-bottom:10px;">
    <textarea rows="3" placeholder="Street, City, State, ZIP" style="width:100%; margin-bottom:10px;"></textarea>
    <input type="text" placeholder="Phone Number" style="width:100%; margin-bottom:10px;">

    <button class="place-order-btn" id="placeOrderBtn">Place Order</button>
  </div>
</div>

<script>
const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

const upiSection = document.getElementById('upiSection');
const cardSection = document.getElementById('cardSection');
const netbankingSection = document.getElementById('netbankingSection');
const qrSection = document.getElementById('qrSection');

const proceedBtn = document.getElementById('proceedBtn');
const orderSummary = document.getElementById('orderSummary');

const upiPayBtn = document.getElementById('upiPayBtn');
const cardPayBtn = document.getElementById('cardPayBtn');
const netbankingPayBtn = document.getElementById('netbankingPayBtn');
const qrPaidBtn = document.getElementById('qrPaidBtn');

/* Hide all sections initially */
function hideAllSections() {
  upiSection.classList.remove('active');
  cardSection.classList.remove('active');
  netbankingSection.classList.remove('active');
  qrSection.classList.remove('active');
}

/* Payment method radio change */
paymentRadios.forEach(radio => {
  radio.addEventListener('change', () => {
    hideAllSections();
    const selected = radio.value;

    // Show only the relevant section
    if (selected === 'upi') {
      upiSection.classList.add('active');
    } else if (selected === 'card') {
      cardSection.classList.add('active');
    } else if (selected === 'netbanking') {
      netbankingSection.classList.add('active');
    } else if (selected === 'qr') {
      qrSection.classList.add('active');
    }
  });
});

/* COD => "Proceed" => show summary */
proceedBtn.addEventListener('click', () => {
  const method = document.querySelector('input[name="payment_method"]:checked').value;
  if (method === 'cod') {
    orderSummary.style.display = 'block';
  } else {
    alert("Please complete your payment method first.");
  }
});

/* UPI => "Pay & Proceed" => show summary */
upiPayBtn.addEventListener('click', () => {
  alert("UPI Payment simulated!");
  hideAllSections();
  orderSummary.style.display = 'block';
});

/* Card => "Pay & Proceed" => show summary */
cardPayBtn.addEventListener('click', () => {
  alert("Card Payment simulated!");
  hideAllSections();
  orderSummary.style.display = 'block';
});

/* Net Banking => "Pay & Proceed" => show summary */
netbankingPayBtn.addEventListener('click', () => {
  alert("Net Banking Payment simulated!");
  hideAllSections();
  orderSummary.style.display = 'block';
});

/* QR => "I Have Paid" => show summary */
qrPaidBtn.addEventListener('click', () => {
  alert("QR Payment completed!");
  hideAllSections();
  orderSummary.style.display = 'block';
});

/* Place Order => final step */
document.getElementById('placeOrderBtn').addEventListener('click', () => {
  const orderID = 'ORD-' + Math.random().toString(36).substr(2, 9).toUpperCase();
  alert(`Order placed successfully! Your Order ID: ${orderID}`);
  // In real app: store in DB, redirect to confirmation, etc.
});
</script>

</body>
</html>
