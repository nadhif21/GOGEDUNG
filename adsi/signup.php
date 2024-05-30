<?php
session_start();

// menghubungkan php dengan koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'goged';

$koneksi = mysqli_connect($host, $user, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // menangkap data yang dikirim dari form pendaftaran
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = 'user'; // Set default level to 'user'

    // gabungkan nama depan dan nama belakang
    $full_name = $first_name . ' ' . $last_name;

    // cek apakah email sudah digunakan
    $cek_email = mysqli_query($koneksi, "SELECT * FROM unit WHERE email='$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // menyimpan data ke database
        $query = "INSERT INTO unit (name, email, password, level) VALUES ('$full_name', '$email', '$password', '$level')";
        if (mysqli_query($koneksi, $query)) {
            $success_message = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error_message = "Pendaftaran gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-box">
            <?php
            if (isset($error_message)) {
                echo "<div class='alert'>$error_message</div>";
            }
            if (isset($success_message)) {
                echo "<div class='alert' style='background: #4caf50; border-color: #388e3c;'>$success_message</div>";
            }
            ?>
            <form method="POST" action="">
            <img src="assets/image/logo.jpg" alt="Logo" class="logo">
            <h2>Welcome !</h2>
                <div class="name">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required style="margin-left: 10px;">
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="signup-button">Sign Up</button>
            </form>
            <h5>Or</h5>
            <div class="login-link">
                <p>Have an account?<a href="login.php"> Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
