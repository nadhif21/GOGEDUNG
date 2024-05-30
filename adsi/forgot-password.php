<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <form action="reset-password.php" method="post">
                <img src="assets/image/logo.jpg" alt="Logo" class="logo">
                <?php
                session_start();
                if (isset($_SESSION['message'])) {
                    echo "<div id='alert' class='alert'>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']);
                    echo "<script>
                        setTimeout(function() {
                            document.getElementById('alert').style.display = 'none';
                        }, 3000); // Menghilangkan pesan setelah 3 detik
                    </script>";
                }
                ?>
                <h3>Reset Your Password</h3>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="login-button">Submit</button>
                <div class="back-to-login">
                    <p>Remember your password? <a href="login.php" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
