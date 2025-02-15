<?php include '../database/db.php';?>
<?php

$sql = "SELECT * FROM Plants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plant Rental System</title>
  <link rel="stylesheet" href="..\resources\css\plants.css">
  <link rel="stylesheet" href="../resources/css/Nursery.css">
 
</head>

<body>
<?php include '../app/reusablelibrary/unauthenticated_header.php';?>

  <!-- <h1 style="text-align:center; background-color:rgb(108, 225, 108); padding: 70px;">Plant Rental System</h1> -->

  <div class="nursery-list">
    <?php
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        $image = !empty($row["image"]) ? $row["image"] : "../resources/images/Plants/{$row["image_name"]}";
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