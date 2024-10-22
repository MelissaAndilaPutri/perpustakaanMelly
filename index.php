<?php
include 'config.php';

// Handle form submission for books
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add Book
    if (isset($_POST['add_book'])) {
        $judul_buku = $_POST['judul_buku'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $stok = $_POST['stok'];

        $sql = "INSERT INTO Tabel_Buku (judul_buku, penulis, tahun_terbit, stok) VALUES ('$judul_buku', '$penulis', '$tahun_terbit', $stok)";
        mysqli_query($conn, $sql);
    }

    // Update Book
    if (isset($_POST['update_book'])) {
        $id_buku = $_POST['id_buku'];
        $judul_buku = $_POST['judul_buku'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $stok = $_POST['stok'];

        $sql = "UPDATE Tabel_Buku SET judul_buku='$judul_buku', penulis='$penulis', tahun_terbit='$tahun_terbit', stok=$stok WHERE id_buku=$id_buku";
        mysqli_query($conn, $sql);
    }

    // Add Borrowing
    if (isset($_POST['borrow_book'])) {
        $id_buku = $_POST['id_buku'];
        $nama_anggota = $_POST['nama_anggota'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];

        $sql = "INSERT INTO Tabel_Peminjaman (id_buku, nama_anggota, tanggal_peminjaman, status) VALUES ($id_buku, '$nama_anggota', '$tanggal_peminjaman', 'Dipinjam')";
        mysqli_query($conn, $sql);
    }

    // Update Borrowing
    if (isset($_POST['update_borrowing'])) {
        $id_peminjaman = $_POST['id_peminjaman'];
        $id_buku = $_POST['id_buku'];
        $nama_anggota = $_POST['nama_anggota'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

        $sql = "UPDATE Tabel_Peminjaman SET id_buku=$id_buku, nama_anggota='$nama_anggota', tanggal_pengembalian='$tanggal_pengembalian', status='Dikembalikan' WHERE id_peminjaman=$id_peminjaman";
        mysqli_query($conn, $sql);
    }
}

// Handle delete for books
if (isset($_GET['delete_book'])) {
    $id_buku = $_GET['delete_book'];
    $sql = "DELETE FROM Tabel_Buku WHERE id_buku=$id_buku";
    mysqli_query($conn, $sql);
}

// Handle delete for borrowings
if (isset($_GET['delete_borrowing'])) {
    $id_peminjaman = $_GET['delete_borrowing'];
    $sql = "DELETE FROM Tabel_Peminjaman WHERE id_peminjaman=$id_peminjaman";
    mysqli_query($conn, $sql);
}

// Fetch data
$books = mysqli_query($conn, "SELECT * FROM Tabel_Buku");
$borrowings = mysqli_query($conn, "SELECT * FROM Tabel_Peminjaman");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Manajemen Perpustakaan</h1>

    <h2>Tambah Buku</h2>
    <form method="post">
        <input type="text" name="judul_buku" placeholder="Judul Buku" required>
        <input type="text" name="penulis" placeholder="Penulis" required>
        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <button type="submit" name="add_book">Tambah Buku</button>
    </form>

    <h2>Daftar Buku</h2>
    <table border="1">
        <tr>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($books)) { ?>
            <tr>
                <td><?= $row['id_buku'] ?></td>
                <td><?= $row['judul_buku'] ?></td>
                <td><?= $row['penulis'] ?></td>
                <td><?= $row['tahun_terbit'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <a href="?edit_book=<?= $row['id_buku'] ?>">Edit</a>
                    <a href="?delete_book=<?= $row['id_buku'] ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if (isset($_GET['edit_book'])) {
        $id_buku = $_GET['edit_book'];
        $sql = "SELECT * FROM Tabel_Buku WHERE id_buku=$id_buku";
        $editResult = mysqli_query($conn, $sql);
        $editRow = mysqli_fetch_assoc($editResult);
    ?>
    <h2>Edit Buku</h2>
    <form method="post">
        <input type="hidden" name="id_buku" value="<?= $editRow['id_buku'] ?>">
        <input type="text" name="judul_buku" value="<?= $editRow['judul_buku'] ?>" required>
        <input type="text" name="penulis" value="<?= $editRow['penulis'] ?>" required>
        <input type="number" name="tahun_terbit" value="<?= $editRow['tahun_terbit'] ?>" required>
        <input type="number" name="stok" value="<?= $editRow['stok'] ?>" required>
        <button type="submit" name="update_book">Update Buku</button>
    </form>
    <?php } ?>

    <h2>Tambah Peminjaman</h2>
<form method="post">
    <select name="id_buku" required>
        <option value="">Pilih Buku</option>
        <?php
        // Mengambil daftar buku dari database
        $books = mysqli_query($conn, "SELECT * FROM Tabel_Buku");
        while ($book = mysqli_fetch_assoc($books)) {
            echo "<option value=\"{$book['id_buku']}\">{$book['judul_buku']} - {$book['penulis']}</option>";
        }
        ?>
    </select>
    <input type="text" name="nama_anggota" placeholder="Nama Anggota" required>
    <input type="date" name="tanggal_peminjaman" required>
    <button type="submit" name="borrow_book">Pinjam Buku</button>
</form>


    <h2>Daftar Peminjaman</h2>
    <table border="1">
        <tr>
            <th>ID Peminjaman</th>
            <th>Nama Anggota</th>
            <th>ID Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($borrowings)) { ?>
            <tr>
                <td><?= $row['id_peminjaman'] ?></td>
                <td><?= $row['nama_anggota'] ?></td>
                <td><?= $row['id_buku'] ?></td>
                <td><?= $row['tanggal_peminjaman'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="?delete_borrowing=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    <?php if ($row['status'] == 'Dipinjam') { ?>
                        <a href="?edit_borrowing=<?= $row['id_peminjaman'] ?>">Kembalikan</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if (isset($_GET['edit_borrowing'])) {
        $id_peminjaman = $_GET['edit_borrowing'];
        $sql = "SELECT * FROM Tabel_Peminjaman WHERE id_peminjaman=$id_peminjaman";
        $editResult = mysqli_query($conn, $sql);
        $editRow = mysqli_fetch_assoc($editResult);
    ?>
    <h2>Kembalikan Buku</h2>
    <form method="post">
        <input type="hidden" name="id_peminjaman" value="<?= $editRow['id_peminjaman'] ?>">
        <select name="id_buku" required>
            <option value="<?= $editRow['id_buku'] ?>"><?= $editRow['id_buku'] ?></option>
            <?php while ($book = mysqli_fetch_assoc($books)) { ?>
                <option value="<?= $book['id_buku'] ?>"><?= $book['judul_buku'] ?></option>
            <?php } ?>
        </select>
        <input type="text" name="nama_anggota" value="<?= $editRow['nama_anggota'] ?>" required>
        <input type="date" name="tanggal_pengembalian" required>
        <button type="submit" name="update_borrowing">Kembalikan Buku</button>
    </form>
    <?php } ?>
    <link rel="stylesheet" href="styles.css">

</body>
</html>

<?php mysqli_close($conn); ?>
