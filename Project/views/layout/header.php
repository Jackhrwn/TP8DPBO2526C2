<!doctype html><!-- Deklarasi dokumen HTML5 -->
<html lang="en"><!-- Awal dokumen HTML dengan bahasa Inggris -->
<head><!-- Bagian head halaman -->
  <meta charset="utf-8"><!-- Encoding karakter UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1"><!-- Pengaturan tampilan responsive -->
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet"><!-- Memuat font Google Space Grotesk -->
  <link href="assets/bootstrap.min.css" rel="stylesheet"><!-- Memuat CSS Bootstrap -->
  <link href="assets/style.css" rel="stylesheet"><!-- Memuat CSS custom -->
  <title><?= $active == 'courses' ? 'Courses' : 'Lecturers' ?></title><!-- Judul halaman sesuai menu aktif -->
</head><!-- Menutup bagian head -->
<body><!-- Awal bagian body -->
  <div class="container app my-4"><!-- Container utama halaman -->
    <div class="brand"><!-- Area brand dan judul -->
      <svg width="40" height="48" viewBox="0 0 48 56" fill="none" stroke="#8E2418" stroke-width="3"><path d="M4 52V22C4 10 12 3 24 3s20 7 20 19v30z"/><path d="M14 52V24c0-6 4-10 10-10s10 4 10 10v28M24 14v38"/></svg><!-- Ikon logo -->
      <h1><?= $active == 'courses' ? 'Courses' : 'Lecturers' ?></h1><!-- Judul halaman sesuai menu aktif -->
    </div><!-- Menutup area brand -->
