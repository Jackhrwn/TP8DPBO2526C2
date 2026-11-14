<?php // Membuka blok kode PHP
// Konfigurasi koneksi database
$servername = "localhost";                                         // Nama server database
$username = "root";                                                // Username database
$password = "";                                                    // Password database (kosong pada XAMPP)
$db_name = "tp_mvc25";                                             // Nama database yang digunakan
$conn = new mysqli($servername, $username, $password, $db_name);   // Membuat koneksi MySQLi
// Mengecek apakah koneksi gagal
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);               // Hentikan program dan tampilkan pesan error
}
