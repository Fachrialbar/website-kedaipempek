<?php
include '../database.php';

// Proses penghapusan data
if (isset($_GET['delete_idpesanan'])) {
    $delete_idpesanan = $_GET['delete_idpesanan'];
    
    // Pastikan untuk menggunakan prepared statement untuk keamanan
    $query_delete = "DELETE FROM pesanan WHERE idpesanan = ?";
    $stmt = $conn->prepare($query_delete);
    $stmt->bind_param("i", $delete_idpesanan);
    $stmt->execute();
    $stmt->close();
    
    // Redirect setelah penghapusan
    header("Location: pesanan.php");
    exit();
}

// Ambil data pesanan
$query_select = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $query_select);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
        .back-button:hover {
            background-color: #0056b3;
        }

        .btn-hapus {
            display: inline-block;
            width: 30px; /* Lebar tombol */
            height: 30px; /* Tinggi tombol */
            background-color: #dc3545; /* Warna merah untuk tombol hapus */
            color: white;
            text-align: center; /* Memusatkan teks di dalam tombol */
            line-height: 30px; /* Memusatkan teks vertikal */
            border-radius: 50%; /* Membuat tombol berbentuk bulat */
            text-decoration: none; /* Menghilangkan garis bawah */
            transition: background-color 0.3s;
        }

        .btn-hapus:hover {
            background-color: #c82333; /* Warna merah lebih gelap saat hover */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Data Pesanan</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Makanan/Minuman</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['idpesanan']; ?></td>
                <td><?php echo $row['namapelanggan']; ?></td>
                <td><?php echo $row['makanan']; ?></td>
                <td><?php echo $row['jumlah']; ?></td>
                <td>
                    <a href="?delete_idpesanan=<?php echo $row['idpesanan']; ?>" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');" title="Hapus data"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="index.php" class="back-button">Kembali</a>
    </div>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($conn);
?>