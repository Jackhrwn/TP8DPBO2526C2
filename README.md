# TP8DPBO2526C2 — Lecturers & Courses (PHP MVC)

Aplikasi CRUD sederhana untuk mengelola data **dosen** (`lecturers`) dan **mata kuliah** (`courses`) menggunakan PHP native dengan pola arsitektur **MVC** (Model-View-Controller). Kode awal (`tp_mvc25`: CRUD tabel `lecturers` dalam satu file per aksi) diubah menjadi arsitektur MVC, lalu ditambahkan tabel baru `courses` yang berelasi dengan `lecturers`.

## Janji

Saya Jaka Permana Herawan dengan NIM 2509371 mengerjakan Tugas Praktikum 8 pada Mata Kuliah Desain dan
Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Fitur

- CRUD data dosen: lihat, tambah, ubah, dan hapus.
- CRUD data mata kuliah: lihat, tambah, ubah, dan hapus.
- Konfirmasi sebelum menghapus data dosen atau mata kuliah.
- ID data baru kembali dimulai dari 1 setelah seluruh data dihapus.
- Relasi satu dosen dengan banyak mata kuliah (1 : N).
- Menghapus dosen otomatis menghapus mata kuliah yang terkait (`ON DELETE CASCADE`).
- Form menggunakan validasi HTML `required`.
- Output di-escape dengan `htmlspecialchars()` melalui helper `e()`.
- Navigasi bawah dengan penanda menu aktif.
- Tampilan responsif menggunakan Bootstrap dan CSS kustom.

## Teknologi

| Komponen | Keterangan |
|---|---|
| PHP native | Tanpa framework, menggunakan pola MVC |
| MySQL / MariaDB | Database `tp_mvc25`, diakses melalui ekstensi `mysqli` |
| Bootstrap 5.0.2 | File CSS dan JavaScript disimpan lokal di folder `assets/` |
| CSS kustom | Tema warna dan komponen di `assets/style.css` |
| Google Fonts | Font **Space Grotesk** |

## Desain database

Nama database: **`tp_mvc25`**

| Tabel | Kolom | Keterangan |
|---|---|---|
| `lecturers` | `id`, `name`, `nidn`, `phone`, `join_date` | Tabel dari kode awal |
| `courses` | `id`, `code`, `name`, `credits`, `lecturer_id` | Tabel baru, `lecturer_id` → `lecturers.id` |

Detail relasi:

- `lecturers.id` adalah **primary key**.
- `courses.lecturer_id` adalah **foreign key** yang mengarah ke `lecturers.id`.
- Relasi bersifat **1 : N**: satu dosen dapat mengampu banyak mata kuliah.
- Foreign key menggunakan `ON DELETE CASCADE` dan `ON UPDATE CASCADE`, sehingga perubahan atau penghapusan data dosen ikut diterapkan pada mata kuliahnya.

Skrip `tp_mvc25.sql` juga menyertakan **5 data awal** untuk tabel `lecturers` dan **5 data awal** untuk tabel `courses`. Setiap `courses.lecturer_id` mengacu ke salah satu dosen yang sudah diinsert, sehingga relasi 1 : N langsung terlihat saat aplikasi dijalankan.

## Struktur folder

```text
TP8DPBO2526C2/
├── README.md
├── tp_mvc25.sql
├── Dokumentasi/
│   ├── CRUD Course.mp4
│   ├── CRUD Lecturer.mp4
│   └── Mekanisme Foreign Key.mp4
│
└── Project/
    ├── index.php
    ├── connection.php
    ├── controllers/
    │   ├── CourseController.php
    │   └── LecturerController.php
    ├── models/
    │   ├── Course.php
    │   └── Lecturer.php
    ├── views/
    │   ├── layout/
    │   │   ├── footer.php
    │   │   └── header.php
    │   ├── courses/
    │   │   ├── form.php
    │   │   └── index.php
    │   └── lecturers/
    │       ├── form.php
    │       └── index.php
    └── assets/
        ├── bootstrap.bundle.min.js
        ├── bootstrap.min.css
        └── style.css
```

Keterangan setiap file dan folder:

| Path | Fungsi |
|---|---|
| `README.md` | Dokumentasi utama proyek |
| `tp_mvc25.sql` | Skrip pembuatan database, tabel `lecturers`, tabel `courses`, serta 5 data awal untuk masing-masing tabel |
| `Dokumentasi/` | Tempat menyimpan screen recording hasil program |
| `Project/index.php` | Front controller: memuat dependensi, memvalidasi `page` dan `action`, lalu memanggil controller |
| `Project/connection.php` | Membuat koneksi database MySQLi |
| `Project/controllers/` | Berisi controller yang mengatur alur request |
| `Project/controllers/LecturerController.php` | Menangani aksi index, create, edit, dan delete data dosen |
| `Project/controllers/CourseController.php` | Menangani aksi index, create, edit, dan delete data mata kuliah |
| `Project/models/` | Berisi model yang menangani akses database |
| `Project/models/Lecturer.php` | Query CRUD untuk tabel `lecturers` |
| `Project/models/Course.php` | Query CRUD untuk tabel `courses`, termasuk JOIN ke `lecturers` |
| `Project/views/` | Berisi tampilan HTML |
| `Project/views/layout/header.php` | Bagian atas layout: head, CSS, brand, dan pembuka container |
| `Project/views/layout/footer.php` | Bagian bawah layout: penutup container, navigasi bawah, dan JavaScript |
| `Project/views/lecturers/index.php` | Halaman daftar dosen |
| `Project/views/lecturers/form.php` | Form tambah dan ubah dosen |
| `Project/views/courses/index.php` | Halaman daftar mata kuliah |
| `Project/views/courses/form.php` | Form tambah dan ubah mata kuliah |
| `Project/assets/` | Aset statis aplikasi |
| `Project/assets/bootstrap.min.css` | CSS Bootstrap 5.0.2 (library pihak ketiga) |
| `Project/assets/bootstrap.bundle.min.js` | JavaScript Bootstrap 5.0.2 (library pihak ketiga) |
| `Project/assets/style.css` | CSS kustom untuk tema aplikasi |

## Alur aplikasi

1. Pengguna membuka URL, misalnya `index.php?page=courses&action=create`.
2. `index.php` memuat `connection.php`, kedua model, dan kedua controller.
3. `index.php` memeriksa apakah `page` terdaftar pada array `$controllers` dan apakah `action` termasuk aksi yang diizinkan (`index`, `create`, `edit`, `delete`).
4. Jika tidak valid, aplikasi mengembalikan status **HTTP 404** dengan pesan `Page not found`.
5. Jika valid, `index.php` membuat objek controller sesuai `page`, lalu memanggil method sesuai `action`.
6. Controller memanggil model untuk membaca atau menulis database.
7. Controller mengirim data ke view, lalu view menampilkan HTML.
8. Setelah proses tambah, ubah, atau hapus, controller melakukan redirect kembali ke halaman daftar.

## Routing dan CRUD

Pola URL yang digunakan:

```text
index.php?page={halaman}&action={aksi}&id={id}
```

| Aksi | Dosen | Mata kuliah |
|---|---|---|
| Read | `index.php?page=lecturers` | `index.php?page=courses` |
| Create | `index.php?page=lecturers&action=create` | `index.php?page=courses&action=create` |
| Update | `index.php?page=lecturers&action=edit&id=1` | `index.php?page=courses&action=edit&id=1` |
| Delete | `index.php?page=lecturers&action=delete&id=1` | `index.php?page=courses&action=delete&id=1` |

Catatan:

- `page` menentukan controller yang dipakai.
- `action` menentukan method controller yang dijalankan.
- `id` digunakan pada aksi `edit` dan `delete`.
- Jika `page` atau `action` tidak valid, aplikasi menampilkan halaman 404.

## Pemetaan dari kode awal

| Kode awal | Lokasi baru |
|---|---|
| `index.php` (daftar dosen) | `Project/views/lecturers/index.php` |
| `create.php` dan `edit.php` | `Project/views/lecturers/form.php` |
| `delete.php` | Aksi `delete` pada `LecturerController` |
| Query SQL dosen | `Project/models/Lecturer.php` |

## Dokumentasi

### CRUD Lecturer
![CRUD Lecturer](Dokumentasi/CRUD%20Lecturer.mp4)

### CRUD Course
![CRUD Course](Dokumentasi/CRUD%20Course.mp4)

### ON DELETE CASCADE
![On Delete Cascade](Dokumentasi/Mekanisme%20Foreign%20Key.mp4)



