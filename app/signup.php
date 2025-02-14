<?php
    include_once('..\database\db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="..\resources\css\styles.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('../resources/images/pexels-sohi-807598.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Glass Effect */
        .signup-container {
            background: rgba(255, 255, 255, 0.1); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Glass blur effect */
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        /* Box Shadow for Depth */
        .signup-box {
            background: rgba(255, 255, 255, 0.9); /* Light white background for content */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Navigation Styling */
        nav {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 10px;
        }

        .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        /* Form Input Styling */
        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            padding-left: 40px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.6);
            font-size: 16px;
            outline: none;
        }

        .input-box input:focus {
            border-color: #27ae60;
        }

        .input-box label {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 16px;
            transition: 0.3s;
        }

        .input-box input:focus + label,
        .input-box input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 12px;
            color: #27ae60;
        }

        /* Button Styling */
        .btn {
            width: 100%;
            padding: 12px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #218c54;
        }

        /* Footer Section */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .footer a {
            color: #27ae60;
            text-decoration: none;
        }
    </style>
</head>
<body>
<body style="background-image: url('../resources/images/Plants/bg4.jpg'); background-size: cover; background-position: center; background-attachment: fixed;"></body>


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

<div class="signup-container">
    <div class="signup-box">
        <h2>Sign Up</h2>
        <form action="#" id="signupForm">
            <div class="input-box">
                <input type="text" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-box">
                <input type="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input type="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-box">
                <input type="password" id="confirmPassword" required>
                <label for="confirmPassword">Confirm Password</label>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>

<script>
    document.getElementById("signupForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirmPassword").value.trim();

        if (username === "" || email === "" || password === "" || confirmPassword === "") {
            alert("Please fill in all fields!");
        } else if (password !== confirmPassword) {
            alert("Passwords do not match!");
        } else {
            alert("Sign Up Successful!");
        }
    });
</script>

</body>
</html>
