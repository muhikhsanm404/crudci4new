<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="row md-6 pb-4">
  <h3>Tampilan Data Mahasiswa</h3>
  <!-- tampilkan status -->
  <?php if (isset($pesan)) : ?>
    <div class="alert alert-<?= $pesan['tipe'] ?>" role="alert">
      <?= $pesan['msg'] ?>
    </div>
  <?php endif ?>
</div>

<table class="table">

  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Jurusan</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $nomor = 1 ?>
    <?php foreach ($mahasiswa as $mhs) : ?>
      <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $mhs->nim ?></td>
        <td><?= $mhs->nama ?></td>
        <td><?= $mhs->email ?></td>
        <td><?= $mhs->jurusan ?></td>
        <td><?= $mhs->alamat ?></td>
        <td>
          <input type="hidden" name="_method" value="DELETE" />
          <a href="<?= base_url("{$mhs->nim}/ubah") ?>" class="btn btn-primary btn-sm" onclick="return confirm('Apakah Anda Yakin ingin Edit?')">
            Edit
          </a>
          <a href="<?= base_url("{$mhs->nim}/hapus") ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin Hapus?')">
            Hapus
          </a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>

</table>

<div class="col-md-6 float-start">
  <a href="<?= base_url('tambah') ?>" class="btn btn-sm btn-success">
    TAMBAH DATA
  </a>
</div>

<?= $this->endSection() ?>