<?php
session_start();
error_reporting(0);
include_once('..\database\db.php');


if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!'); window.location.href='login.php';</script>";
    exit();
}

$username = $_SESSION['username'];

// Fetch user's orders
$query = mysqli_query($con, "SELECT * FROM Orders WHERE customer_name='$username' ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="..\resources\css\my-orders.css">
</head>

<body>
    <?php include '../app/reusablelibrary/authenticated_header.php'; ?>
    
    <div class="order-container">
        <h2>My Orders</h2>
        
        <?php if (mysqli_num_rows($query) > 0) { ?>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Plant Name</th>
                        <th>Quantity</th>
                        
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['plant_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <!-- <td>$<?php echo $row['total_price']; ?></td> -->
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No orders found.</p>
        <?php } ?>
    </div>
    
</body>
</html>
