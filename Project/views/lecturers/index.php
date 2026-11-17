<?php include "views/layout/header.php"; ?><!-- Memuat header halaman -->
<a class="btn btn-red my-3" href="index.php?page=lecturers&action=create">Add New</a><!-- Tombol tambah dosen -->
<div class="panel table-responsive"><!-- Panel pembungkus tabel -->
  <table class="table mb-0"><!-- Tabel daftar dosen -->
    <thead><!-- Bagian kepala tabel -->
      <tr><th>ID</th><th>NAME</th><th>NIDN</th><th>PHONE</th><th>JOIN DATE</th><th>ACTIONS</th></tr><!-- Baris judul kolom -->
    </thead><!-- Menutup kepala tabel -->
    <tbody><!-- Bagian isi tabel -->
      <?php foreach ($lecturers as $row): ?><!-- Mulai perulangan data dosen -->
      <tr><!-- Baris data dosen -->
        <th><?= e($row['id']) ?></th><!-- ID dosen -->
        <td><?= e($row['name']) ?></td><!-- Nama dosen -->
        <td><?= e($row['nidn']) ?></td><!-- NIDN dosen -->
        <td><?= e($row['phone']) ?></td><!-- Nomor telepon dosen -->
        <td><?= e($row['join_date']) ?></td><!-- Tanggal bergabung dosen -->
        <td><!-- Kolom aksi -->
          <a class="btn btn-cream btn-sm" href="index.php?page=lecturers&action=edit&id=<?= $row['id'] ?>">Edit</a><!-- Tombol edit dosen -->
          <a class="btn btn-red btn-sm" href="index.php?page=lecturers&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data dosen ini?')">Delete</a><!-- Tombol hapus dosen dengan konfirmasi -->
        </td><!-- Menutup kolom aksi -->
      </tr><!-- Menutup baris data dosen -->
      <?php endforeach; ?><!-- Mengakhiri perulangan dosen -->
    </tbody><!-- Menutup isi tabel -->
  </table><!-- Menutup tabel -->
</div><!-- Menutup panel -->
<?php include "views/layout/footer.php"; ?><!-- Memuat footer halaman -->
