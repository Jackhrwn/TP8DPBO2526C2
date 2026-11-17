<?php include "views/layout/header.php"; ?><!-- Memuat header halaman -->
<form method="post" class="panel p-3 my-3"><!-- Form tambah/ubah mata kuliah -->
  <h2 class="form-title"><?= e($title) ?></h2><!-- Judul form -->
  <input type="hidden" name="id" value="<?= e($course['id']) ?>"><!-- ID mata kuliah disimpan tersembunyi -->

  <label>CODE:</label><!-- Label kode mata kuliah -->
  <input type="text" name="code" value="<?= e($course['code']) ?>" class="form-control" required><!-- Input kode mata kuliah -->

  <label>NAME:</label><!-- Label nama mata kuliah -->
  <input type="text" name="name" value="<?= e($course['name']) ?>" class="form-control" required><!-- Input nama mata kuliah -->

  <label>CREDITS:</label><!-- Label jumlah SKS -->
  <input type="number" name="credits" value="<?= e($course['credits']) ?>" class="form-control" required><!-- Input jumlah SKS -->

  <label>LECTURER:</label><!-- Label dosen pengampu -->
  <select name="lecturer_id" class="form-select" required><!-- Dropdown pilihan dosen -->
    <option value="">Select lecturer</option><!-- Opsi placeholder -->
    <?php foreach ($lecturers as $l): ?><!-- Mulai perulangan data dosen -->
      <option value="<?= $l['id'] ?>" <?= $course['lecturer_id'] == $l['id'] ? 'selected' : '' ?>><?= e($l['name']) ?></option><!-- Opsi dosen, selected jika sesuai data -->
    <?php endforeach; ?><!-- Mengakhiri perulangan dosen -->
  </select><!-- Menutup dropdown dosen -->

  <div class="mt-3"><!-- Grup tombol aksi -->
    <button class="btn btn-red" type="submit" name="submit">Submit</button><!-- Tombol simpan data -->
    <a class="btn btn-cream" href="index.php?page=courses">Cancel</a><!-- Tombol batal -->
  </div><!-- Menutup grup tombol -->
</form><!-- Menutup form mata kuliah -->
<?php include "views/layout/footer.php"; ?><!-- Memuat footer halaman -->
