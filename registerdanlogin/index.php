<?php
session_start();

echo isset($_SESSION["login"]);

if(isset($_SESSION["login"])){
    header("Location: dashboard.php");
    exit;
}

require 'function.php';

if(isset($_POST["login"])){

    $username= $_POST["username"];
    $password= $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM login_user WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row["password"])){
            // cek session
            $_SESSION["login"] = true;

            
            header("Location: dashboard.php");
            exit();
        }
    }
    //$error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registerdanlogin</title>
</head>
<body>
    <h1>HALAMAN LOGIN</h1>
    <!-- untuk membuat agar saat login salah keluar notifikasi kesalahan -->
    <?php if(isset($error)): ?>
    <p style="color:red;">username atau password salah</p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <button type="submit" name="login">Login</button>
                
                <button type="submit" name="register"><a href="register.php" style="text-decoration:none;color:black;">register</a></button>
            </li>
        </ul>
    </form>
</body>
</html>