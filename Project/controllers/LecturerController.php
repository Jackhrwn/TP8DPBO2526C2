<?php // Membuka blok kode PHP
// CONTROLLER: menerima request, memanggil model, lalu memilih view
// Controller untuk halaman lecturers
class LecturerController {
    private $model;                                             // Properti model Lecturer

    // Constructor menerima objek koneksi
    function __construct($conn) {
        $this->model = new Lecturer($conn);                     // Membuat model Lecturer dengan koneksi
    }

    // Menampilkan daftar dosen
    function index() {
        $lecturers = $this->model->getAll();                    // Mengambil semua data dosen
        $active = 'lecturers';                                  // Menandai menu yang aktif
        include "views/lecturers/index.php";                    // Memuat view daftar dosen
    }

    // Menampilkan form atau menyimpan dosen baru
    function create() {
        // Mengecek apakah form sudah disubmit
        if (isset($_POST['submit'])) {
            $this->model->create($_POST['name'], $_POST['nidn'], $_POST['phone'], $_POST['join_date']); // Menyimpan data dosen baru
            header("Location: index.php?page=lecturers");       // Mengarahkan kembali ke daftar dosen
            exit;                                               // Menghentikan eksekusi setelah redirect
        }
        $lecturer = ['id' => '', 'name' => '', 'nidn' => '', 'phone' => '', 'join_date' => '']; // Data awal untuk form kosong
        $active = 'lecturers';                                  // Menandai menu yang aktif
        $title = 'Create Lecturer';                             // Judul form
        include "views/lecturers/form.php";                     // Memuat view form dosen
    }

    // Menampilkan form atau menyimpan perubahan dosen
    function edit() {
        // Mengecek apakah form sudah disubmit
        if (isset($_POST['submit'])) {
            $this->model->update($_POST['id'], $_POST['name'], $_POST['nidn'], $_POST['phone'], $_POST['join_date']); // Menyimpan perubahan data dosen
            header("Location: index.php?page=lecturers");       // Mengarahkan kembali ke daftar dosen
            exit;                                               // Menghentikan eksekusi setelah redirect
        }
        $lecturer = $this->model->find($_GET['id'] ?? 0);       // Mengambil data dosen berdasarkan id
        // Mengecek apakah data tidak ditemukan
        if (!$lecturer) {
            header("Location: index.php?page=lecturers");       // Mengarahkan kembali ke daftar dosen
            exit;                                               // Menghentikan eksekusi
        }
        $active = 'lecturers';                                  // Menandai menu yang aktif
        $title = 'Update Lecturer';                             // Judul form
        include "views/lecturers/form.php";                     // Memuat view form dosen
    }

    // Menghapus data dosen
    function delete() {
        if (isset($_GET['id'])) $this->model->delete($_GET['id']); // Menghapus data jika parameter id tersedia
        header("Location: index.php?page=lecturers");           // Mengarahkan kembali ke daftar dosen
        exit;                                                   // Menghentikan eksekusi
    }
}
