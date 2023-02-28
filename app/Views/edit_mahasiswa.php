<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="row md-5 pb-4">
    <?php if (isset($pesan)) : ?>
      <div class="alert alert-<?= $pesan['tipe'] ?>" role="alert">
        <?= $pesan['msg'] ?>
      </div>
    <?php endif ?>
    <div class="col-md-6 float-start">
      <h3 class="mb-6 pb-4">Form Edit Data Mahasiswa</h3>
      <div class="container">
        <div class="row">
          <form action="<?= base_url("{$mhs->nim}/update") ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT" />
            <div class="row md-5 pb-4">
              <label for="nim" class="col-sm-2 col-form-label">NIM</label>
              <div class="col-sm-10">
                <input type="id" class="form-control" id="nim" name="nim" autofocus required readonly value="<?= old('nim') ? old('nim') : $mhs->nim ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" required value="<?= old('nama') ? old('nama') : $mhs->nama ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required value="<?= old('email') ? old('email') : $mhs->email ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
              <div class="col-sm-10">
                <select name="jurusan" class="form-select">
                  <option value="Sistem Komputer" <?= $isSelected(old('jurusan'), 'Sistem Komputer') ?>>
                    Sistem Komputer
                  </option>
                  <option value="Sistem Informasi" <?= $isSelected(old('jurusan'), 'Sistem Informasi') ?>>
                    Sistem Informasi
                  </option>
                  <option value="Teknik Informatika" <?= $isSelected(old('jurusan'), 'Teknik Informatika') ?>>
                    Teknik Informatika
                  </option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="address" class="form-control" id="alamat" name="alamat" required value="<?= old('alamat') ? old('alamat') : $mhs->alamat ?>" />
              </div>
            </div>
            <a class="btn btn-secondary" href="<?= base_url() ?>">KEMBALI</a>
            <button type="submit" class="btn btn-primary">Edit Data</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>