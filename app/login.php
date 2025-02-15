<?php
session_start();
error_reporting(0);
include_once('..\database\db.php');

if (isset($_POST['login'])) {
    $usernamecon = $_POST['usernamecon'];
    $passwordcon = base64_encode($_POST['passwordcon']);

     // Query to get users
   
     $query=mysqli_query($con,"select username from users where  username='$usernamecon' and password = '$passwordcon'");
     $ret=mysqli_fetch_array($query);
    
   
    if ($ret>0) { // If a record is found
        $_SESSION['username'] = $result["username"];
        $_SESSION['userrole'] = $result["userrole"];
       
        echo "<script>
                alert('Login Successful!');
                window.location.href='index.php';
              </script>";
        exit();
    } else {
        // Show error alert if login fails
        echo "<script>alert('Invalid Username or Password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Page</title>
    <link rel="stylesheet" href="..\resources\css\styles.css">
</head>

<body>

    <body
        style="background-image: url('../resources/images/Plants/bg2.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    </body>
    <<?php include '../app/reusablelibrary/unauthenticated_header.php'; ?>

        <div class="login-container">
            <div class="login-box">
                <h2>Login</h2>
                <form action="" method="post" name="login" id="login-form">
                    <div class="input-box">
                        <input type="text" name="usernamecon" id="username" required>
                        <label for="username">User Name</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="passwordcon" id="password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" name="login" value="Login" class="btn">Login</button>
                </form>
                <div class="footer">
                    <p>Don't have an account? <a href="#">Sign up</a></p>
                </div>
            </div>
        </div>

</body>

</html>