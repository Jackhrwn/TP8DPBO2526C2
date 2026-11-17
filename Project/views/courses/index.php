<?php include "views/layout/header.php"; ?><!-- Memuat header halaman -->
<a class="btn btn-red my-3" href="index.php?page=courses&action=create">Add New</a><!-- Tombol tambah mata kuliah -->
<div class="panel table-responsive"><!-- Panel pembungkus tabel -->
  <table class="table mb-0"><!-- Tabel daftar mata kuliah -->
    <thead><!-- Bagian kepala tabel -->
      <tr><th>ID</th><th>CODE</th><th>NAME</th><th>CREDITS</th><th>LECTURER</th><th>ACTIONS</th></tr><!-- Baris judul kolom -->
    </thead><!-- Menutup kepala tabel -->
    <tbody><!-- Bagian isi tabel -->
      <?php foreach ($courses as $row): ?><!-- Mulai perulangan data mata kuliah -->
      <tr><!-- Baris data mata kuliah -->
        <th><?= e($row['id']) ?></th><!-- ID mata kuliah -->
        <td><?= e($row['code']) ?></td><!-- Kode mata kuliah -->
        <td><?= e($row['name']) ?></td><!-- Nama mata kuliah -->
        <td><?= e($row['credits']) ?></td><!-- Jumlah SKS -->
        <td><?= e($row['lecturer_name']) ?></td><!-- Nama dosen pengampu -->
        <td class="text-end text-nowrap"><!-- Kolom aksi, rata kanan dan tidak terpotong -->
          <a class="btn btn-cream btn-sm" href="index.php?page=courses&action=edit&id=<?= $row['id'] ?>">Edit</a><!-- Tombol edit mata kuliah -->
          <a class="btn btn-red btn-sm" href="index.php?page=courses&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data mata kuliah ini?')">Delete</a><!-- Tombol hapus mata kuliah dengan konfirmasi -->
        </td><!-- Menutup kolom aksi -->
      </tr><!-- Menutup baris data mata kuliah -->
      <?php endforeach; ?><!-- Mengakhiri perulangan mata kuliah -->
    </tbody><!-- Menutup isi tabel -->
  </table><!-- Menutup tabel -->
</div><!-- Menutup panel -->
<?php include "views/layout/footer.php"; ?><!-- Memuat footer halaman -->
