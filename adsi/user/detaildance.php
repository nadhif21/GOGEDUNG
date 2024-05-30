<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$_SESSION['pemesanan_id'] = 1;

$sql = "SELECT * FROM gedung WHERE pemesanan_id = 1";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Gedung</title>
    <link rel="stylesheet" href="../assets/css/detaildance.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="sticky-header">
        <div class="logo">
            <img src="../assets/image/logo-removebg-preview.png" alt="Logo" class="logo-image">
        </div>
        <nav>
            <ul>
                <li><a href="homepage.php">MAIN</a></li>
                <li><a href="cari.php" class="active">CARI</a></li>
                <li><a href="contact.php">CONTACTS</a></li>
                <li><a href="pesanan.php">PEMESANAN</a></li>
            </ul>
        </nav>
    </header>
    <section class="pilihan">
        <h2 id="pil">Pilihan</h2>
        <h2>gedung</h2>
    </section>

    <section class="containercontent">
        <div class="gedungdance" >
        <img src="../assets/image/gedungdance.png" alt="Image 1" class="gallery-image"><br>
        <h2>GEDUNG DANCE</h2>
        <p>
            Anda memerlukan tempat yang tepat untuk acara dansa Anda? 
            Kami siap membantu! Dengan berbagai pilihan ruang yang luas dan nyaman, 
            gedung dance kami adalah tempat ideal untuk mengadakan acara dansa Anda. 
            Dengan fasilitas yang lengkap dan layanan yang ramah, kami akan membantu 
            Anda menjadikan acara Anda sukses dan tak terlupakan. Hubungi kami sekarang 
            untuk informasi lebih lanjut dan booking.
        </p>
        <a href="pesan.php">pesan</a>
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

