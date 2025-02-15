<?php include '../database/db.php'; ?>
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
  <link rel="stylesheet" href="../resources/css/plants.css">
  <link rel="stylesheet" href="../resources/css/Nursery.css">
</head>

<body>
  <?php include '../app/reusablelibrary/unauthenticated_header.php'; ?>

  <div class="nursery-list">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $image = !empty($row["image"]) ? $row["image"] : "../resources/images/Plants/{$row["image_name"]}";
        echo "<div class='plant-card'>
                <a href='plant_details.php?id={$row["id"]}'>
                  <img src='$image' alt='{$row["name"]}'>
                  <h3>{$row["name"]}</h3>
                </a>
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
  
  <?php $conn->close(); ?>
</body>
</html>
