<?php
include_once('..\database\db.php');
$query = "SELECT * FROM about_us LIMIT 1";
$result = $conn->query($query);
$about = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $about['title']; ?> | Plant Rental</title>
    <link rel="stylesheet" href="..\resources\css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="..\resources\css\about.css">
</head>
<body>
<?php include '../app/reusablelibrary/unauthenticated_header.php';?>
<div class="hero">
    <h1>About Us</h1>
</div>


<div class="about-container">
    <div class="about-box">
        <h2><?php echo $about['title']; ?></h2>
        <p><?php echo $about['description']; ?></p>

        <div class="about-section">
            <i class="fas fa-leaf"></i>
            <div>
                <h3>Our Mission</h3>
                <p><?php echo $about['mission']; ?></p>
            </div>
        </div>

        <div class="about-section">
            <i class="fas fa-eye"></i>
            <div>
                <h3>Our Vision</h3>
                <p><?php echo $about['vision']; ?></p>
            </div>
        </div>

        <a href="contact.php" class="cta-btn">Get in Touch</a>
    </div>
</div>

</body>
</html>
