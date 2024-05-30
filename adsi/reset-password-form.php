<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <form action="reset-password-process.php" method="post">
                <h3>Reset Password</h3>
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
                <div class="input-group">
                    <input type="text" id="token" name="token" placeholder="Enter the 4-digit code" required value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
                </div>
                <div class="input-group">
                    <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                </div>
                <button type="submit" class="login-button">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html>
