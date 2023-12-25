<?php
include('koneksi.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Change 'username' to 'name'
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_pengguna (username, password) VALUES (?, ?)"; // Remove the third parameter
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword); // Change to "ss"
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil');</script>";
        echo "<script>window.location='index.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <titleLogin</title>
</head>
<body>
    <div class="input">
        <h1>Login Page</h1>
        <link href="style-login.css" rel="stylesheet" type="text/css" />
        <form action="sign-in.php" method="post">
            <div class="box-input">
                <i class="fas fa-address-book"></i>
                <input type="text" placeholder="Username" name="username">
            </div> 
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="password">
            </div>   
            <button type="submit" name="login" class="btn-input">Login</button>   
        </form>
    </div>
</body>
</html>
