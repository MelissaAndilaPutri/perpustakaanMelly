<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'Perpustakaan';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>