<?php include '../../database/db.php';?>
<?php


// $servername = "localhost";
// $username = "root";
// $password = "8767";
// $dbname = "plant_rental";


// $conn = new mysqli($servername, $username, $password, $dbname);


// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }


$sql = "SELECT * FROM Plants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant Rental System</title>
  <link rel="stylesheet" href="..\..\resources\css\plants.css">
</head>

<body>
  <h1 style="text-align:center; background-color:rgb(108, 225, 108); padding: 70px;">Plant Rental System</h1>
  <nav>
    <div class="logo">Plant Rental</div>
    <ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="../app/plants/plants.php">Plants</a></li>
      <li><a href="../../app/nursary/nurseries.php">Nurseries</a></li>
      <li><a href="../about.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="signup.php">Sign Up</a></li>
      <li><a href="../app/order/orders.php">Orders</a></li>
    </ul>
  </nav>
  <div class="plant-container">
    <?php
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        $image = !empty($row["image"]) ? $row["image"] : "../../resources/images/Plants/{$row["image_name"]}";
        echo "<div class='plant-card'>
                        <img src='$image' alt='{$row["name"]}'>
                        <h3>{$row["name"]}</h3>
                        <p>{$row["description"]}</p>
                        <p>Category: {$row["category"]}</p>
                        <p class='price'>₹{$row["price"]}</p>
                        <p class='rating'>⭐ {$row["rating"]}/5</p>
                      </div>";
      }
    } else {
      echo "<p>No plants available.</p>";
    }
    ?>
  </div>
</body>

</html>

<?php
$conn->close();
?>