<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'Perpustakaan'); // Gantilah 'db_crud' dengan nama database Anda

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID peminjam dari URL
$id = $_GET['id'];

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_anggota = $_POST['nama anggota'];
    $tanggal_peminjam = $_POST['tanggal peminjam'];
    $tanggal_pengembalian = $_POST['tanggal pengembalian'];
    $status = $_POST['status'];

    // Query untuk mengupdate data customer
    $sql = "UPDATE Buku SET nama anggota='$nama_anggota', tanggal peminjam='$tanggal_peminjam', tanggal pengembalian='$tanggal_pengembalian', status='$status' WHERE id_peminjam=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil diperbarui!";
        header("Location: Buku.php"); // Redirect ke halaman Buku setelah update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data peminjam untuk ditampilkan di form
$result = $conn->query("SELECT * FROM Peminjam WHERE id_peminjam = $id");

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $conn->error);
}

$row = $result->fetch_assoc();

if (!$row) {
    die("Data Buku tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Peminjam</title>
</head>
<body>
    <h1>Edit Peminjam</h1>
    <form method="post">
    <input type="hidden" name="id" value="<?= $row['id_peminjam'] ?>">
        <input type="hidden" name="id" value="<?= $row['id_buku'] ?>">
        <input type="text" name="nama anggota" value="<?= $row['nama anggota'] ?>" required>
        <input type="date" name="tanggal peminjaman" value="<?= $row['tanggal peminjaman'] ?>" required>
        <input type="date" name="tanggal pengembalian" value="<?= $row['tanggal pengembalian'] ?>">
        <textarea name="status" required><?= $row['status'] ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="customer.php">Kembali ke Daftar Peminjam</a>
</body>
</html>

<?php $conn->close(); ?>
