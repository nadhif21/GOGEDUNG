<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>
<body>
<header class="sticky-header">
        <div class="logo">
            <img src="../assets/image/logo-removebg-preview.png" alt="Logo" class="logo-image">
        </div>
        <nav>
            <ul>
                <li><a href="homepage.php">MAIN</a></li>
                <li><a href="cari.php">CARI</a></li>
                <li><a href="contact.php" class="active" >CONTACTS</a></li>
                <li><a href="pesanan.php">PEMESANAN</a></li>
            </ul>
        </nav>
    </header>
    <section class="contact-section">
        <h1>Contact Us</h1>
        <p>Any question or remarks? Just write us a message!</p>
        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>Say something to start a live chat!</p>
                <ul>
                    <li><i class="fas fa-phone"></i> 512.333.2222</li>
                    <li><i class="fas fa-envelope"></i> goged@gmail.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> 1234 Sample Street Austin Texas 78704</li>
                </ul>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <form action="#">
                    <div class="form-group">
                        <input type="text" placeholder="First Name" required>
                        <input type="text" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" required>
                        <input type="text" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Write your message.." required></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <img src="../assets/image/logo.jpg" alt="Logo" class="footer-logo">
            </div>
            <div class="footer-column">
                <h3>Information</h3>
                <ul>
                    <li><a href="#">Main</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contacts</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Bandar Lampung</li>
                    <li><i class="fas fa-phone-alt"></i> +62812345678</li>
                    <li><i class="fas fa-envelope"></i> goged@gmail.com</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Social Media</h3>
                <div class="social-media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2021 All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>
