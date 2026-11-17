<?php // Membuka blok kode PHP
// MODEL: semua akses database untuk tabel lecturers
// Class model untuk tabel lecturers
class Lecturer {
    private $conn;                                              // Properti penyimpan koneksi database

    // Constructor menerima objek koneksi
    function __construct($conn) {
        $this->conn = $conn;                                    // Menyimpan koneksi ke properti class
    }

    // Mengambil seluruh data dosen
    function getAll() {
        return $this->conn->query("SELECT * FROM lecturers")->fetch_all(MYSQLI_ASSOC); // Menjalankan query dan mengambil semua baris
    }

    // Mengambil satu data dosen berdasarkan id
    function find($id) {
        $s = $this->conn->prepare("SELECT * FROM lecturers WHERE id=?"); // Menyiapkan query dengan placeholder
        $s->bind_param('i', $id);                               // Mengikat parameter id bertipe integer
        $s->execute();                                          // Menjalankan query
        return $s->get_result()->fetch_assoc();                 // Mengambil satu baris hasil sebagai array asosiatif
    }

    // Menambah data dosen baru
    function create($name, $nidn, $phone, $join_date) {
        $s = $this->conn->prepare("INSERT INTO lecturers (name, nidn, phone, join_date) VALUES (?, ?, ?, ?)"); // Menyiapkan query insert
        $s->bind_param('ssss', $name, $nidn, $phone, $join_date); // Mengikat empat parameter bertipe string
        return $s->execute();                                   // Menjalankan insert dan mengembalikan status
    }

    // Mengubah data dosen
    function update($id, $name, $nidn, $phone, $join_date) {
        $s = $this->conn->prepare("UPDATE lecturers SET name=?, nidn=?, phone=?, join_date=? WHERE id=?"); // Menyiapkan query update
        $s->bind_param('ssssi', $name, $nidn, $phone, $join_date, $id); // Mengikat parameter string dan id integer
        return $s->execute();                                   // Menjalankan update dan mengembalikan status
    }

    // Menghapus data dosen
    function delete($id) {
        $s = $this->conn->prepare("DELETE FROM lecturers WHERE id=?"); // Menyiapkan query delete
        $s->bind_param('i', $id);                               // Mengikat parameter id bertipe integer
        $deleted = $s->execute();                               // Menjalankan delete dan menyimpan status

        // Jika data dosen habis, ID berikutnya dimulai dari 1 lagi
        if ($deleted) {
            $this->resetAutoIncrement();                        // Mengatur ulang ID tabel lecturers
            $this->resetCourseAutoIncrement();                  // Mata kuliah ikut terhapus (cascade), ID-nya juga diatur ulang
        }

        return $deleted;                                        // Mengembalikan status delete
    }

    // Mengatur ulang AUTO_INCREMENT tabel lecturers jika sudah tidak ada data
    private function resetAutoIncrement() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM lecturers"); // Menghitung jumlah data dosen
        if ($result && (int) $result->fetch_assoc()['total'] === 0) {            // Jika tabel kosong
            $this->conn->query("ALTER TABLE lecturers AUTO_INCREMENT = 1");       // ID berikutnya kembali ke 1
        }
    }

    // Mengatur ulang AUTO_INCREMENT tabel courses jika sudah tidak ada data
    private function resetCourseAutoIncrement() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM courses"); // Menghitung jumlah mata kuliah
        if ($result && (int) $result->fetch_assoc()['total'] === 0) {          // Jika tabel kosong
            $this->conn->query("ALTER TABLE courses AUTO_INCREMENT = 1");       // ID berikutnya kembali ke 1
        }
    }
}
