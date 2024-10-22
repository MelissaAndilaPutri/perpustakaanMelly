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
    $nama_anggota= $_POST['nama anggota'];
    $tanggal_peminjam = $_POST['tanggal peminjam'];
    $tanggal_pengembalian = $_POST['tanggal pengembalian'];
    $status = $_POST['status'];

    $sql = "INSERT INTO peminjam (nama anggota, tanggal peminjam, tanggal pengembalian, status) VALUES ('$nama_anggota', '$tanggal_peminjam', '$tanggal_pengembalian', '$status')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: Peminjam.php"); // Redirect ke halaman daftar peminjam
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
    <title>Tambah Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Peminjam</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nama anggota" class="form-label"> Nama angota</label>
                <input type="text" class="form-control" id="nama anggota" name="nama anggota" required>
            </div>
            <div class="mb-3">
                <label for="tanggal peminjam" class="form-label"> Tanggal Peminjam</label>
                <input type="date" class="form-control" id="tanggal peminjam" name="tanggal peminjam" required>
            </div>
            <div class="mb-3">
                <label for="tanggal pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggal pengembalian" name="tanggal pengembalian">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <textarea class="form-control" id="status" name="status" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
