<?php include "views/layout/header.php"; ?><!-- Memuat header halaman -->
<form method="post" class="panel p-3 my-3"><!-- Form tambah/ubah dosen -->
  <h2 class="form-title"><?= e($title) ?></h2><!-- Judul form -->
  <input type="hidden" name="id" value="<?= e($lecturer['id']) ?>"><!-- ID dosen disimpan tersembunyi -->

  <label>NAME:</label><!-- Label nama dosen -->
  <input type="text" name="name" value="<?= e($lecturer['name']) ?>" class="form-control" required><!-- Input nama dosen -->

  <label>NIDN:</label><!-- Label NIDN dosen -->
  <input type="text" name="nidn" value="<?= e($lecturer['nidn']) ?>" class="form-control" required><!-- Input NIDN dosen -->

  <label>PHONE:</label><!-- Label nomor telepon -->
  <input type="text" name="phone" value="<?= e($lecturer['phone']) ?>" class="form-control" required><!-- Input nomor telepon -->

  <label>JOIN DATE:</label><!-- Label tanggal bergabung -->
  <input type="date" name="join_date" value="<?= e($lecturer['join_date']) ?>" class="form-control" required><!-- Input tanggal bergabung -->

  <div class="mt-3"><!-- Grup tombol aksi -->
    <button class="btn btn-red" type="submit" name="submit">Submit</button><!-- Tombol simpan data -->
    <a class="btn btn-cream" href="index.php?page=lecturers">Cancel</a><!-- Tombol batal -->
  </div><!-- Menutup grup tombol -->
</form><!-- Menutup form dosen -->
<?php include "views/layout/footer.php"; ?><!-- Memuat footer halaman -->
