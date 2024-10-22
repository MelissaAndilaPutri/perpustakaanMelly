<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
 header("Location: index.php");
 exit();
}
// Mengambil level pengguna dari session
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Perpustakan</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container">
 <a class="navbar-brand" href="#">Project CRUD</a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNav">
 <ul class="navbar-nav">
 <?php if ($role == 'admin') : ?>
 <li class="nav-item">
 <a class="nav-link" href="../dashboard/admin.php">Dashboard</a>
 </li>
 <?php elseif ($role == 'user') : ?>
 <li class="nav-item">
 <a class="nav-link" href="../dashboard/user.php">Dashboard</a>
 </li>
 <?php endif; ?>
 <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle" href="#" role="button" 
data-bs-toggle="dropdown" aria-expanded="false">
 Master
 </a>
 <ul class="dropdown-menu">
 <li><a class="dropdown-item" href="../buku/Buku.php">Buku</a></li>
 <li><a class="dropdown-item" href="../peminjam/Peminjam.php">Peminjam</a></li>
 </ul>
 </li>
 <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle" href="#" role="button" 
data-bs-toggle="dropdown" aria-expanded="false">
 Laporan
 </a>
 <ul class="dropdown-menu">
 <li><a class="dropdown-item" href="../laporan/laporan_Buku.php"> laporan Buku</a></li>
 <li><a class="dropdown-item" href="../laporan/laporan_peminjam.php"> laporan Peminjam</a></li>
 </ul>
 </li>
 </ul>
 <ul class="navbar-nav ms-auto">
 <li class="nav-item">
 <a href="../logout.php" class="btn btn-danger">Logout</a>
 </li>
 </ul>
 </div>
 </div>
 </nav>
 <!-- Konten utama -->
 <div class="container flex-grow-1 mt-4">