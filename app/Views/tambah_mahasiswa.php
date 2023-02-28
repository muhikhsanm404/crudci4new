<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div clas="container">
  <div class="row md-5 pb-4">
    <?php if (isset($pesan)): ?>
      <div class="alert alert-<?= $pesan['tipe'] ?>" role="alert">
        <?= $pesan['msg'] ?>
      </div>
    <?php endif ?>
    <div class="col-md-6 float-start">
      <h3 class="mb-6 pb-4">Form Tambah Data Mahasiswa</h3>
      <div clas="container">
        <div class="row">
          <form action="<?= base_url('tambah') ?>" method="POST">
          <?= csrf_field(); ?>
            <div class="row md-5 pb-4">
              <label for="nim" class="col-sm-2 col-form-label">NIM</label>
              <div class="col-sm-10">
                <input type="id" class="form-control <?= $isInvalid('nim') ?>"
                  id="nim" name="nim" onkeyup="ceknim()" autofocus
                  value="<?= old('nim') ?>" required />
                <div class="invalid-feedback">
                  <?= $errors['nim'] ?? '' ?>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= $isInvalid('nama') ?>"
                id="nama" name="nama"
                value="<?= old('nama') ?>" required />
                <div class="invalid-feedback">
                  <?= $errors['nama'] ?? '' ?>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control <?= $isInvalid('email') ?>"
                  id="email" name="email" required
                  value="<?= old('email') ?>" />
                  <div class="invalid-feedback">
                  <?= $errors['nama'] ?? '' ?>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
              <div class="col-sm-10">
                <select name="jurusan" class="form-select">
                  <option value="Sistem Komputer">Sistem Komputer</option>
                  <option value="Sistem Informasi">Sistem Informasi</option>
                  <option value="Teknik Informatika">Teknik Informatika</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="address" class="form-control"
                  id="alamat" name="alamat" required
                  value="<?= old('alamat') ?>" />
              </div>
            </div>
            <a class="btn btn-secondary" href="<?= base_url() ?>">KEMBALI</a>
            <button type="submit" id="kirim" class="btn btn-success" disabled>TAMBAH DATA</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
const nim = document.getElementById("nim");
const info_nim = document.querySelector("label[for=nim] ~ div .invalid-feedback");
const kirim = document.getElementById("kirim");

// fungsi validasi nik
function ceknim() {
  if (nim.value.length < 1) {
    nim.classList.add("is-invalid");
    info_nim.innerHTML = "NIM tidak boleh kosong";
    kirim.disabled = true;
  } else {
    nim.classList.remove("is-invalid");
    info_nim.innerHTML = "";
    kirim.disabled = false;
  }
}
//fungsi disable tombol kirim
</script>

<?= $this->endSection() ?>