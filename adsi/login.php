<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <form action="index.php" method="post">
                <img src="assets/image/logo.jpg" alt="Logo" class="logo">
                <h3>Unlimited free access to our resourses</h3>
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal") {
                        echo "<div id='alert' class='alert'>Username dan Password tidak sesuai !</div>";
                        echo "<script>
      setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
      }, 3000); // Menghilangkan pesan setelah 5 detik (5000 milidetik)
    </script>";
                    }
                }
                ?>

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
                <form>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="password" required>
                    </div>
                    <div class="forgot-password">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    <button type="submit" class="login-button">Login</button>
                </form>
                <h5>OR</h5>
                <div class="login-link">
                    <p>Don't have an account? <a href="signup.php" class="signup">Sign Up</a></p>
                </div>
        </div>
    </div>
</body>

</html>