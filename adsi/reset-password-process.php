<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // Do not hash the password (not recommended for production)
        $plain_password = $new_password;

        // Verify the token and update the password
        $stmt = $koneksi->prepare("UPDATE unit SET password = ?, reset_token = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $plain_password, $token);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Password has been reset successfully.";
        } else {
            $_SESSION['message'] = "Invalid token or token has expired.";
        }
    } else {
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: reset-password-form.php?token=$token");
    }

    $stmt->close();
    $koneksi->close();
    header("Location: login.php");
    exit();
}
?>
