<?php 
session_start();
error_reporting(0);
include_once('..\database\db.php');

if (isset($_POST['submit'])) {  
    $UsernameCon = $_POST['username'];
    $password = ($_POST['password']); 

    // Query to check if the user exists
    $query = mysqli_query($con, "SELECT ID FROM users WHERE (Username='$UsernameCon' OR MobileNumber='$UsernameCon') AND Password='$password' ");
    $ret = mysqli_fetch_array($query);
   

    if ($ret>0) { // If a record is found
        $_SESSION['Login_id'] = $ret['ID'];

       
        echo "<script>
                alert('Login Successful1234!');
                window.location.href='index.php';
              </script>";
        exit();
    } else {
        // Show error alert if login fails
        echo "<script>alert('Invalid Username or Password!');</script>";
    }
}
?>


<!-- <?php
    include_once('..\database\db.php');
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Page</title>
    <link rel="stylesheet" href="..\resources\css\styles.css">
</head>
<body>
<body style="background-image: url('../resources/images/Plants/bg2.jpg'); background-size: cover; background-position: center; background-attachment: fixed;"></body>

<nav>
    <div class="logo">Plant Rental</div>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="../app/plants/plants.php">Plants</a></li>
      <li><a href="../app/nursary/nurseries.php">Nurseries</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="signup.php">Sign Up</a></li>
      <li><a href="../app/order/orders.php">Orders</a></li>
    </ul>
  </nav>



<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form action="#" id="loginForm">
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="#">Sign up</a></p>
        </div>
    </div>
</div>

<!-- <script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (username === "" || password === "") {
            alert("Please fill in all fields!");
        } else {
            alert("Login Successful!");
        }
    });
</script> -->

<script> $UsernameCon = $_POST['username'];
    $password = ($_POST['password']); 

    // Query to check if the user exists
    $query = mysqli_query($con, "SELECT ID FROM users WHERE (Username='$UsernameCon' OR MobileNumber='$UsernameCon') AND Password='$password' ");
    $ret = mysqli_fetch_array($query);
   

    if ($ret>0) { // If a record is found
        $_SESSION['Login_id'] = $ret['ID'];

       
        echo "<script>
                alert('Login Successful1234!');
                window.location.href='index.php';
              </script>";
        exit();
    } else {
        // Show error alert if login fails
        echo "<script>alert('Invalid Username or Password!');</script>";
    }
    </script>

</body>
</html>
