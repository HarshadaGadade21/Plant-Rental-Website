<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "plant_rental";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$orderDetails = null;
$error = null;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderID = trim($_POST['order_id']);

    if (!empty($orderID)) {
        $sql = "SELECT * FROM Orders WHERE order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orderDetails = $result->fetch_assoc();
        } else {
            $error = "Order ID not found!";
        }
        $stmt->close();
    } else {
        $error = "Order ID cannot be empty!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c5f2d;
            padding: 10px 20px;
        }

        nav .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #38713a;
        }

        h1 {
            text-align: center;
            color: #2c5f2d;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background: #2c5f2d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #38713a;
        }

        .order-details {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .order-details p {
            margin: 5px 0;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
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

    <div class="container">
        <h1>Track Your Order</h1>
        <form method="POST" action="">
            <input type="text" name="order_id" placeholder="Enter your Order ID" required>
            <button type="submit">Track Order</button>
        </form>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($orderDetails): ?>
            <div class="order-details">
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> <?= htmlspecialchars($orderDetails['order_id']) ?></p>
                <p><strong>Customer Name:</strong> <?= htmlspecialchars($orderDetails['customer_name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($orderDetails['email']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($orderDetails['status']) ?></p>
                <p><strong>Order Date:</strong> <?= htmlspecialchars($orderDetails['order_date']) ?></p>
                <p><strong>Expected Delivery:</strong> <?= htmlspecialchars($orderDetails['expected_delivery']) ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
