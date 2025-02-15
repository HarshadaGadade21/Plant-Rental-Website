<?php
// Adjust the file path to match your project structure
include('../database/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nurseries</title>
  <link rel="stylesheet" href="../resources/css/Nursery.css">
</head>

<body>

<?php include '../app/reusablelibrary/unauthenticated_header.php';?>

  <header>
    <h1>Our Partner Nurseries</h1>
    <p>Explore the best nurseries that supply high-quality plants for rent.</p>
  </header>

 
  <div class="nursery-list">
    <?php
    if (isset($conn)) {
        // Fetch nurseries from the database
        $sql = "SELECT * FROM Nurseries";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Generate image URL or placeholder if no image exists
               //  $image = !empty($row["image"]) ? $row["image"] : "../resources/images/Nurseries/default.jpg";
                $image = !empty($row["image"]) ? $row["image"] : "../resources/images/Nurseries/{$row["image_name"]}";
     
                echo "
                <div class='nursery'>
                    <img src='$image' alt='Nursery'>
                    <h2>{$row["name"]}</h2>
                    <p>{$row["description"]}</p>
                    <p><strong>Location:</strong> {$row["location"]}</p>
                    <p><strong>Contact:</strong> {$row["contact"]}</p>
                </div>";
            }
        } else {
            echo "<p>No nurseries available at the moment. Please check back later.</p>";
        }
    } else {
        echo "<p>Error: Unable to connect to the database. Please contact support.</p>";
    }
    ?>
  </div>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Plant Rental. All Rights Reserved.</p>
  </footer>

</body>

</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>
