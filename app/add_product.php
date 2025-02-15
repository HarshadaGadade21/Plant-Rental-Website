<?php
    include_once('../api/config.php');

    if(isset($_POST["submit"])) {
        $url = $api_url . 'plants';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        if($response['status'] == '1') {
            header("Location: index.php?add_status=success");
        } elseif($response['status'] == 0) {
            header("Location: index.php?add_status=failed");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Plant | Plant Rental WebApp</title>
    <link rel="stylesheet" href="..\resources\css\add_product.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">All Plants</a>
            <a href="nurseries.php">Nurseries</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
    </header>
    <div class="container">
        <h1>Add Plant</h1>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="product_name">Plant Name:</label></td>
                    <td><input type="text" id="product_name" name="product_name" required></td>
                </tr>
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="text" id="price" name="price" required></td>
                </tr>
                <tr>
                    <td><label for="quantity">Quantity:</label></td>
                    <td><input type="text" id="quantity" name="quantity" required></td>
                </tr>
                <tr>
                    <td><label for="seller">Seller:</label></td>
                    <td><input type="text" id="seller" name="seller" required></td>
                </tr>
            </table>
            <div>
                <input type="submit" name="submit" value="Add Plant">
                <input type="button" value="Cancel" onclick="window.location='index.php';">
            </div>
        </form>
    </div>
</body>
</html>
