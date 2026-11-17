<?php // Membuka blok kode PHP
// MODEL: semua akses database untuk tabel courses (relasi ke lecturers lewat lecturer_id)
// Class model untuk tabel courses
class Course {
    private $conn;                                              // Properti penyimpan koneksi database

    // Constructor menerima objek koneksi
    function __construct($conn) {
        $this->conn = $conn;                                    // Menyimpan koneksi ke properti class
    }

    // Mengambil seluruh mata kuliah beserta nama dosen
    function getAll() {
        // Query mengambil data courses dan nama dosen melalui JOIN
        $sql = "SELECT courses.*, lecturers.name AS lecturer_name
                FROM courses JOIN lecturers ON lecturers.id = courses.lecturer_id"; // Query join tabel courses dan lecturers
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC); // Menjalankan query dan mengambil semua baris
    }

    // Mengambil satu data mata kuliah berdasarkan id
    function find($id) {
        $s = $this->conn->prepare("SELECT * FROM courses WHERE id=?"); // Menyiapkan query dengan placeholder
        $s->bind_param('i', $id);                               // Mengikat parameter id bertipe integer
        $s->execute();                                          // Menjalankan query
        return $s->get_result()->fetch_assoc();                 // Mengambil satu baris hasil sebagai array asosiatif
    }

    // Menambah data mata kuliah baru
    function create($code, $name, $credits, $lecturer_id) {
        $s = $this->conn->prepare("INSERT INTO courses (code, name, credits, lecturer_id) VALUES (?, ?, ?, ?)"); // Menyiapkan query insert
        $s->bind_param('ssii', $code, $name, $credits, $lecturer_id); // Mengikat parameter string dan integer
        return $s->execute();                                   // Menjalankan insert dan mengembalikan status
    }

    // Mengubah data mata kuliah
    function update($id, $code, $name, $credits, $lecturer_id) {
        $s = $this->conn->prepare("UPDATE courses SET code=?, name=?, credits=?, lecturer_id=? WHERE id=?"); // Menyiapkan query update
        $s->bind_param('ssiii', $code, $name, $credits, $lecturer_id, $id); // Mengikat parameter string dan integer
        return $s->execute();                                   // Menjalankan update dan mengembalikan status
    }

    // Menghapus data mata kuliah
    function delete($id) {
        $s = $this->conn->prepare("DELETE FROM courses WHERE id=?"); // Menyiapkan query delete
        $s->bind_param('i', $id);                               // Mengikat parameter id bertipe integer
        $deleted = $s->execute();                               // Menjalankan delete dan menyimpan status

        // Jika data mata kuliah habis, ID berikutnya dimulai dari 1 lagi
        if ($deleted) {
            $result = $this->conn->query("SELECT COUNT(*) AS total FROM courses"); // Menghitung jumlah data mata kuliah
            if ($result && (int) $result->fetch_assoc()['total'] === 0) {          // Jika tabel kosong
                $this->conn->query("ALTER TABLE courses AUTO_INCREMENT = 1");       // ID berikutnya kembali ke 1
            }
        }

        return $deleted;                                        // Mengembalikan status delete
    }
}
