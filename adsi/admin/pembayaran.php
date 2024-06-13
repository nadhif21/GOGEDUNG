<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['name'];
$error_message = '';

$sql = "SELECT pemesanan.pemesanan_id, pemesanan.user_id, DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m-%d') as formatted_date, pemesanan.jumlah_pembayaran, pemesanan.status, unit.name as user_name 
        FROM pemesanan 
        JOIN unit ON pemesanan.user_id = unit.user_id";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Table</title>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Gedung</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["user_name"]) . "</td>"; // Mengambil nama pengguna dari tabel unit

                    // Kondisi untuk kolom "Gedung"
                    $building = "";
                    switch ($row["pemesanan_id"]) {
                        case 1:
                            $building = "Dance";
                            break;
                        case 2:
                            $building = "Olahraga";
                            break;
                        case 3:
                            $building = "Gym";
                            break;
                        case 4:
                            $building = "Pesta";
                            break;
                        default:
                            $building = "Unknown";
                            break;
                    }
                    echo "<td>" . $building . "</td>";
                    echo "<td>" . $row["formatted_date"] . "</td>";
                    echo "<td>Rp. " . number_format($row["jumlah_pembayaran"], 0, ',', '.') . ",-</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo '<td><a href="confirm.php?pemesanan_id=' . $row["pemesanan_id"] . '&user_id=' . $row["user_id"] . '&tanggal=' . $row["formatted_date"] . '&jumlah=' . $row["jumlah_pembayaran"] . '&status=' . $row["status"] . '"><i class="fas fa-check"></i></a></td>';
                    echo '<td><a href="cancel.php?pemesanan_id=' . $row["pemesanan_id"] . '&user_id=' . $row["user_id"] . '&tanggal=' . $row["formatted_date"] . '&jumlah=' . $row["jumlah_pembayaran"] . '&status=' . $row["status"] . '"><i class="fas fa-times"></i></a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            $koneksi->close();
            ?>
        </tbody>
    </table>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
