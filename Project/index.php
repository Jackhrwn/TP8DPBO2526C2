<?php // Membuka blok PHP (front controller)
// Front controller: menerima request lalu meneruskannya ke controller yang sesuai
include "connection.php";                           // Memuat koneksi database
include "models/Lecturer.php";                      // Memuat model Lecturer
include "models/Course.php";                        // Memuat model Course
include "controllers/LecturerController.php";       // Memuat controller Lecturer
include "controllers/CourseController.php";         // Memuat controller Course

// Fungsi helper untuk escape output HTML
function e($s) {
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); // Mengubah karakter khusus agar aman ditampilkan
}

$controllers = ['lecturers' => 'LecturerController', 'courses' => 'CourseController']; // Daftar halaman dan controller-nya
$page = $_GET['page'] ?? 'lecturers';               // Mengambil parameter page, default lecturers
$action = $_GET['action'] ?? 'index';               // Mengambil parameter action, default index

if (                                                // Memvalidasi halaman dan aksi
    !isset($controllers[$page])                     // Halaman harus terdaftar
    || !in_array($action, ['index', 'create', 'edit', 'delete']) // Aksi harus diizinkan
) {
    http_response_code(404);                        // Mengirim status HTTP 404
    die("Page not found");                          // Menghentikan program dengan pesan
}
$controller = new $controllers[$page]($conn);       // Membuat objek controller sesuai halaman
$controller->$action();                             // Menjalankan method controller sesuai aksi
