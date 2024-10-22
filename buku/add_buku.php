<?php
include('../config.php');
include('../includes/header.php');
?>
<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'Perpustakaan');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika tombol kirim ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_buku = $_POST['judul buku'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun terbit'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO buku (judul buku, penulis, tahun terbit, stok) VALUES ('$judul_buku', '$penulis', '$tahun_terbit', '$stok')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: Buku.php"); // Redirect ke halaman daftar buku
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Buku</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <textarea class="form-control" id="stok" name="stok" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
