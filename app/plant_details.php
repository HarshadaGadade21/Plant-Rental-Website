<?php
// plant_details.php
include '../database/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "No plant selected.";
  exit();
}

$plant_id = (int)$_GET['id'];

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

// Build image path
$imagePath = "../resources/images/Plants/" . htmlspecialchars($plant['image_name']);

// Fetch suggestions (3 random plants, excluding current)
$suggestion_sql = "SELECT * FROM Plants WHERE id != ? ORDER BY RAND() LIMIT 3";
$suggestion_stmt = $conn->prepare($suggestion_sql);
$suggestion_stmt->bind_param("i", $plant_id);
$suggestion_stmt->execute();
$suggestion_result = $suggestion_stmt->get_result();
$suggestion_stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($plant['name']); ?> - Details</title>
  <!-- Main Plant Details CSS -->
  <link rel="stylesheet" href="../resources/css/plant_details.css">
  <!-- (Optional) Additional CSS for checkout flow, if needed -->
  <link rel="stylesheet" href="../resources/css/checkout_flow.css">
</head>

<body>
  <!-- Header / Navigation -->
  <header>
    <h2>Plant Rental</h2>
    <nav>
      <ul>
        <li><a href="plants_list.php">Plants</a></li>
        <li><a href="#">Nurseries</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Sign Up</a></li>
        <li><a href="#">Orders</a></li>
      </ul>
    </nav>
  </header>

  <!-- Plant Details Container -->
  <div class="plant-details-container">
    <!-- Left Column: Plant Image -->
    <div class="plant-image">
      <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($plant['name']); ?>" />
    </div>

    <!-- Right Column: Plant Info -->
    <div class="plant-info">
      <h1><?php echo htmlspecialchars($plant['name']); ?></h1>
      <p class="price">Rs <?php echo number_format($plant['price'], 2); ?></p>

      <!-- If Pink Syngonium, show detailed specs as table; else list description -->
      <?php if ($plant['name'] === 'Pink Syngonium'): ?>
        <table class="plant-specs">
          <tr>
            <th>Plant or Animal Product Type:</th>
            <td>Pink Syngonium</td>
          </tr>
          <tr>
            <th>Indoor/Outdoor Usage:</th>
            <td>Indoor</td>
          </tr>
          <tr>
            <th>Brand:</th>
            <td>Blooming Botanicals</td>
          </tr>
          <tr>
            <th>Material Feature:</th>
            <td>Organic</td>
          </tr>
          <tr>
            <th>Colour:</th>
            <td>Light Pink &amp; Green</td>
          </tr>
          <tr>
            <th>Special Feature:</th>
            <td>Low Maintenance</td>
          </tr>
          <tr>
            <th>Expected Growth Period:</th>
            <td>All Year</td>
          </tr>
          <tr>
            <th>Item Weight:</th>
            <td>500 Grams</td>
          </tr>
          <tr>
            <th>Sunlight Exposure:</th>
            <td>Indirect Light</td>
          </tr>
          <tr>
            <th>Net Quantity:</th>
            <td>1.00 count</td>
          </tr>
        </table>
      <?php else: ?>
        <ul class="highlights">
          <li><strong>Description:</strong> <?php echo htmlspecialchars($plant['description']); ?></li>
        </ul>
      <?php endif; ?>

      <div class="tags">
        <span>Free Delivery</span>
        <span>Pay on Delivery</span>
        <span>Non-Returnable</span>
        <span>Top Brand</span>
        <span>Amazon Delivered</span>
        <span>Secure Transaction</span>
      </div>

      <div class="actions">
        <!-- Anchor styled as a button -->
        <a href="checkout_payment.php?id=<?php echo $plant_id; ?>" class="rent-btn">Buy on Rent</a>
        <button class="cart-btn">Add to Cart</button>
      </div>

      <div class="delivery-check">
        <h3>Check Delivery Availability</h3>
        <div class="pincode-form">
          <input type="text" placeholder="Enter Pincode" />
          <button class="check-btn">Check</button>
        </div>
        <p class="availability-info"></p>
      </div>
    </div>
  </div>

  <!-- Suggestions Section -->
  <div class="suggestions-section">
    <h2>You May Also Like</h2>
    <div class="suggestions-grid">
      <?php
      if ($suggestion_result->num_rows > 0) {
        while ($sugg = $suggestion_result->fetch_assoc()) {
          $suggImage = "../resources/images/Plants/" . htmlspecialchars($sugg['image_name']);
          echo "<div class='suggestion-card'>
                  <a href='plant_details.php?id={$sugg["id"]}'>
                    <img src='{$suggImage}' alt='" . htmlspecialchars($sugg["name"]) . "' />
                    <h4>" . htmlspecialchars($sugg["name"]) . "</h4>
                    <p class='sugg-price'>₹" . number_format($sugg["price"], 2) . "</p>
                    <p class='sugg-rating'>⭐ {$sugg["rating"]}/5</p>
                  </a>
                </div>";
        }
      } else {
        echo "<p>No suggestions available.</p>";
      }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Plant Rental. All rights reserved.</p>
  </footer>

  <script>
    // Pincode Check
    document.querySelector('.check-btn').addEventListener('click', function() {
      const pincodeInput = document.querySelector('.pincode-form input');
      const availabilityMsg = document.querySelector('.availability-info');
      const pincode = pincodeInput.value.trim();

      const punePincodes = ["411001","411002","411003","411004","411005"];

      if (punePincodes.includes(pincode)) {
        availabilityMsg.textContent = "Delivery is available for this pincode in Pune!";
        availabilityMsg.style.color = "green";
      } else {
        availabilityMsg.textContent = "Sorry, delivery not available at this pincode.";
        availabilityMsg.style.color = "red";
      }
    });
  </script>

</body>
</html>


