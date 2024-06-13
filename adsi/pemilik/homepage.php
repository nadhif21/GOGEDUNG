<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Gedung</title>
    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="sticky-header">
        <div class="logo">
            <img src="../assets/image/logo-removebg-preview.png" alt="Logo" class="logo-image">
        </div>
        <nav>
            <ul>
                <li><a href="homepage.php" class="active">MAIN</a></li>
                <li><a href="input.php">INPUT</a></li>
                <li><a href="contact.php">CONTACTS</a></li>
                <li><a href="permintaan.php">PEMESANAN</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>GOGED</h1>
            <h2>GO GEDUNG</h2>
            <a href="cari.php" class="view-gallery">VIEW GALLERY →</a>
        </div>
        <img src="../assets/image/poto1.jpg" alt="Main Image" class="main-image">
    </section>

    <section class="about">
        <div class="about-images">
            <img src="../assets/image/poto2.jpg" alt="Image 1" class="about-image" id="poto1">
            <img src="../assets/image/poto1.jpg" alt="Image 2" class="about-image" id="poto2">
        </div>
        <div class="about-images2">
            <img src="../assets/image/poto3.jpg" alt="Image 3" class="about-image" id="poto3">
        </div>
        <div class="about-text">
            <h3>About</h3>
            <p>
                Pengembangan proyek sistem informasi Go Ged bertujuan untuk melakukan
                kerja sama dengan Gedung HYBE guna membantu pencatatan dan manajemen
                gedung dan instruktur yang lebih efisien, seperti pengelolaan pada data penyewaan,
                pembayaran dan lainnya.
            </p>
        </div>
    </section>

    <section class="mission">
        <h3>Main Focus/Mission Statement</h3>
        <div class="focus-points">
            <div class="point">
                <h4>1</h4>
            </div>
            <div class="point">
                <p>Providing exceptional event spaces for every occasion, ensuring memorable experiences for our clients and their guests.</p>
            </div>
            <div class="point">
                <h4 id="dua">2</h4>
            </div>
            <div class="point">
                <p>Simplifying the venue rental process, offering convenient and flexible options to meet diverse event needs.</p>
            </div>
        </div>
    </section>

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