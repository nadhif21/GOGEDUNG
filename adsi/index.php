<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = mysqli_query($koneksi, "SELECT * FROM unit WHERE email='$email' AND password='$password'");

    if (!$login) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['name'] = $name['name'];
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $data['level'];

        switch ($data['level']) {
            case "admin":
                header("location:user/homepage.php");
                break;
            case "user":
                header("location:user/homepage.php");
                break;
            case "Dep Adkor":
                header("location:user/homepage.php");
                break;
            default:
                $error_message = "Level user tidak dikenal.";
        }
    } else {
        $error_message = "Email atau password salah.";
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=gagal");
}
?>
