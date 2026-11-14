CREATE DATABASE IF NOT EXISTS tp_mvc25; -- Membuat database jika belum ada
USE tp_mvc25; -- Menggunakan database tp_mvc25

-- tabel dari kode awal
CREATE TABLE lecturers ( -- Membuat tabel lecturers
  id INT AUTO_INCREMENT PRIMARY KEY, -- ID dosen, auto increment, primary key
  name VARCHAR(100) NOT NULL, -- Nama dosen
  nidn VARCHAR(20) NOT NULL, -- Nomor Induk Dosen Nasional
  phone VARCHAR(20) NOT NULL, -- Nomor telepon dosen
  join_date DATE NOT NULL -- Tanggal bergabung dosen
); 

-- tabel baru: 1 dosen (lecturers) mengampu banyak mata kuliah (courses)
CREATE TABLE courses ( -- Membuat tabel courses
  id INT AUTO_INCREMENT PRIMARY KEY, -- ID mata kuliah, auto increment, primary key
  code VARCHAR(10) NOT NULL, -- Kode mata kuliah
  name VARCHAR(100) NOT NULL, -- Nama mata kuliah
  credits INT NOT NULL, -- Jumlah SKS
  lecturer_id INT NOT NULL, -- ID dosen pengampu (foreign key)
  FOREIGN KEY (lecturer_id) REFERENCES lecturers(id) ON DELETE CASCADE ON UPDATE CASCADE -- Relasi ke tabel lecturers
);

-- 5 data awal untuk tabel lecturers
INSERT INTO lecturers (name, nidn, phone, join_date) VALUES
  ('Dr. Budi Santoso, M.Kom.', '0012048501', '081234567890', '2010-08-15'),
  ('Siti Aminah, M.Kom.', '0025098701', '081323456789', '2012-01-10'),
  ('Ahmad Fauzi, M.T.', '0008119001', '081434567890', '2015-09-01'),
  ('Rina Kartika, M.Cs.', '0031049202', '081545678901', '2018-02-20'),
  ('Dedi Kurniawan, M.Kom.', '0015078802', '081656789012', '2020-07-13');

-- 5 data awal untuk tabel courses (lecturer_id mengacu ke data lecturers di atas)
INSERT INTO courses (code, name, credits, lecturer_id) VALUES
  ('IF101', 'Algoritma dan Pemrograman', 3, 1),
  ('IF102', 'Basis Data', 3, 2),
  ('IF201', 'Pemrograman Web', 3, 3),
  ('IF202', 'Sistem Operasi', 2, 4),
  ('IF301', 'Kecerdasan Buatan', 3, 5);
