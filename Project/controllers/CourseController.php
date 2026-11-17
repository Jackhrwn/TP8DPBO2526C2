<?php // Membuka blok kode PHP
// Controller untuk halaman courses
class CourseController {
    private $model;                                             // Properti model Course
    private $lecturers;                                         // Properti model Lecturer untuk pilihan dosen

    // Constructor menerima objek koneksi
    function __construct($conn) {
        $this->model = new Course($conn);                       // Membuat model Course dengan koneksi
        $this->lecturers = new Lecturer($conn);                 // Membuat model Lecturer untuk pilihan dosen pada form
    }

    // Menampilkan daftar mata kuliah
    function index() {
        $courses = $this->model->getAll();                      // Mengambil semua data mata kuliah
        $active = 'courses';                                    // Menandai menu yang aktif
        include "views/courses/index.php";                      // Memuat view daftar mata kuliah
    }

    // Menampilkan form atau menyimpan mata kuliah baru
    function create() {
        // Mengecek apakah form sudah disubmit
        if (isset($_POST['submit'])) {
            $this->model->create($_POST['code'], $_POST['name'], $_POST['credits'], $_POST['lecturer_id']); // Menyimpan data mata kuliah baru
            header("Location: index.php?page=courses");         // Mengarahkan kembali ke daftar mata kuliah
            exit;                                               // Menghentikan eksekusi setelah redirect
        }
        $course = ['id' => '', 'code' => '', 'name' => '', 'credits' => '', 'lecturer_id' => '']; // Data awal untuk form kosong
        $lecturers = $this->lecturers->getAll();                // Mengambil data dosen untuk dropdown
        $active = 'courses';                                    // Menandai menu yang aktif
        $title = 'Create Course';                               // Judul form
        include "views/courses/form.php";                       // Memuat view form mata kuliah
    }

    // Menampilkan form atau menyimpan perubahan mata kuliah
    function edit() {
        // Mengecek apakah form sudah disubmit
        if (isset($_POST['submit'])) {
            $this->model->update($_POST['id'], $_POST['code'], $_POST['name'], $_POST['credits'], $_POST['lecturer_id']); // Menyimpan perubahan data mata kuliah
            header("Location: index.php?page=courses");         // Mengarahkan kembali ke daftar mata kuliah
            exit;                                               // Menghentikan eksekusi setelah redirect
        }
        $course = $this->model->find($_GET['id'] ?? 0);         // Mengambil data mata kuliah berdasarkan id
        // Mengecek apakah data tidak ditemukan
        if (!$course) {
            header("Location: index.php?page=courses");         // Mengarahkan kembali ke daftar mata kuliah
            exit;                                               // Menghentikan eksekusi
        }
        $lecturers = $this->lecturers->getAll();                // Mengambil data dosen untuk dropdown
        $active = 'courses';                                    // Menandai menu yang aktif
        $title = 'Update Course';                               // Judul form
        include "views/courses/form.php";                       // Memuat view form mata kuliah
    }

    // Menghapus data mata kuliah
    function delete() {
        if (isset($_GET['id'])) $this->model->delete($_GET['id']); // Menghapus data jika parameter id tersedia
        header("Location: index.php?page=courses");             // Mengarahkan kembali ke daftar mata kuliah
        exit;                                                   // Menghentikan eksekusi
    }
}
