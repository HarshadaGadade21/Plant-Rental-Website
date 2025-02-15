<?php
include_once('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($query) === TRUE) {
        $success = "Your message has been sent successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Plant Rental</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('../resources/images/Plants/bg.jpg') no-repeat center center/cover;
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            background: #56ab2f;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .contact-form {
            background-color: rgba(0, 0, 0, 0);
            /* White with 80% opacity */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgb(0, 0, 0);
        }

        .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #1abc9c;
        }

        /* Contact Form */
        .contact-container {
            max-width: 700px;
            background: rgba(255, 255, 255, 0.15);
            /* Glass effect */
            backdrop-filter: blur(12px);
            /* Adjust blur for glass effect */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            /* Subtle shadow */
            margin: 100px auto;
            text-align: center;
            color: white;
        }

        .contact-container h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }

        .contact-container input,
        .contact-container textarea {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .contact-container input::placeholder,
        .contact-container textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .contact-container button {
            background: #27ae60;
            color: white;
            border: none;
            padding: 14px 24px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 10px;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
        }

        .contact-container button:hover {
            background: #218c54;
            transform: scale(1.05);
        }

        /* Success/Error Messages */
        .message {
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .success {
            background: rgba(46, 204, 113, 0.8);
            color: white;
        }

        .error {
            background: rgba(231, 76, 60, 0.8);
            color: white;
        }
    </style>

</head>

<body>

    <body style="background-image: url('../resources/images/Plants/bg.jpg'); background-size: cover; background-position: center; background-attachment: fixed;"></body>


    <!-- Navigation -->
    <nav>
    <div class="logo">Plant Rental</div>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="plants.php">Plants</a></li>`
      <li><a href="nurseries.php">Nurseries</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="signup.php">Sign Up</a></li>
      <li><a href="orders.php">Orders</a></li>
    </ul>
  </nav>

    <!-- Contact Form -->
    <div class="contact-container">
        <h2>Get in Touch</h2>
        <?php if (isset($success)) echo "<p class='message success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='message error'>$error</p>"; ?>

        <form action="contact.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

</body>

</html>