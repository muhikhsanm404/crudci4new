<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div clas="container">
    <div class="row md-5 pb-4">
        <div class="col-md-6 float-start">
            <h3 class="mb-6 pb-4">Form Edit Data Mahasiswa</h3>
            <div clas="container">
                <div class="row">
                    <form action="<?= base_url() ?>update" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="EDIT">
                        <div class="row md-5 pb-4">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="id" value="<?= $hasil->nim ?>" class="form-control" id="nim" name="nim" autofocus required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?= $hasil->nama ?>" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" value="<?= $hasil->email ?>" class="form-control" id="inputEmail3" name="email" required>
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
                                <input type="address" value="<?= $hasil->alamat ?>" class="form-control" id="alamat" name="alamat" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>