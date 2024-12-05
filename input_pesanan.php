<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namapelanggan = $_POST['namapelanggan'];
    $makanan = $_POST['makanan'];
    $jumlah = $_POST['jumlah'];

    // Perbaiki query SQL
    $query_insert = "INSERT INTO pesanan (namapelanggan, makanan, jumlah) VALUES ('$namapelanggan', '$makanan', '$jumlah')";

    // Eksekusi query
    if (mysqli_query($conn, $query_insert)) {
        
    } else {
        
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #000000;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0000ff;
        }
        .back-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #000000;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
        .back-button:hover {
            background-color: #0000ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pesan sekarang</h1>
        <form method="POST" action="input_pesanan.php">
            <label>nama pelanggan:</label>
            <input type="text" name="namapelanggan" required>
            <label>Makanan/Minuman:</label>
            <input type="text" name="makanan" required>
            <label>jumlah:</label>
            <input type="number" name="jumlah" required>
            <a href="index.php" class="back-button">Kembali</a>
            <input type="submit" value="Kirim Pesanan">
        </form>
    </div>
</body>
</html>