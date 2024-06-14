<?php
session_start();
include '../koneksi.php';


$user_id = $_SESSION['user_id'];
$error_message = '';

$sql = "SELECT p.pemesanan_id, DATE_FORMAT(p.tanggal_pemesanan, '%d %M') as formatted_date, p.jumlah_pembayaran, u.name, p.status
        FROM pemesanan p 
        JOIN unit u ON p.user_id = u.user_id
        WHERE p.user_id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Requests</title>
    <link rel="stylesheet" href="../assets/css/permintaan.css">
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
                <li><a href="cari.php">CARI</a></li>
                <li><a href="contact.php">CONTACTS</a></li>
                <li><a href="pesanan.php" class="active">PEMESANAN</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Permintaan penyewa (pending)</h2>
        <table>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo '<td class="user-info">';
                        echo '<img src="../assets/image/user-placeholder.png" alt="User Image">';
                        echo '<div>';
                        echo '<span class="user-name">' . htmlspecialchars($row["name"]) . '</span>';
                        echo '<span class="reservation-details">Gedung ' . htmlspecialchars($row["pemesanan_id"]) . ' | ' . $row["formatted_date"] . '</span>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td class="actions">';
                        echo '<i class="fas fa-check"></i>';
                        echo '<i class="fas fa-times"></i>';
                        echo '</td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No records found</td></tr>";
                }
                $stmt->close();
                $koneksi->close();
                ?>
            </tbody>
        </table>
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