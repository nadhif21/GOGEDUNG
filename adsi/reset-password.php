<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $koneksi->prepare("SELECT * FROM unit WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a 4-digit reset token
        $token = random_int(1000, 9999);

        // Store the token in the database against the user's email
        $stmt = $koneksi->prepare("UPDATE unit SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("is", $token, $email);
        $stmt->execute();

        // Set message and redirect to the reset password form with the token in the URL
        header("Location: reset-password-form.php?token=$token");
    } else {
        $_SESSION['message'] = "No account found with that email.";
        header("Location: forgot-password.php");
    }

    $stmt->close();
    $koneksi->close();
    exit();
}
?>
