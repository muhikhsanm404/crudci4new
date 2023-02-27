<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="row md-6 pb-4">
<h3>Tampilan Data Mahasiswa</h3>
            <!-- tampilkan status -->
      <?php if (session()->getFlashdata('pesan')) :?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif;?>
    <div class="col-md-6 float-start">
    </div>
   
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
        <?php
        $nomor = 1;
        foreach ($datamahasiswa as $mhs) :
        ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>

                <td>
                    <?= $mhs->nim ?>
                </td>
                <td>
                    <?= $mhs->nama ?>
                </td>
                <td>
                    <?= $mhs->email ?>
                </td>
                <td>
                    <?= $mhs->jurusan ?>
                </td>
                <td>
                    <?= $mhs->alamat ?>
                </td>
                <td>
                    <?= csrf_field();?>
                <a href="<?= base_url()?>ubah/<?=$mhs->nim ?>" class="btn btn-primary btn-sm" onclick="return confirm('Apakah Anda Yakin ingin Edit?');">Edit</a>
                <input type="hidden" name="_method" value="HAPUS">
                <a href="<?= base_url()?>hapus/<?= $mhs->nim?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ingin Hapus?');">Hapus</a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>
    <div class="col-md-6 float-start">
       <a href="<?= base_url()?>tambah"><button class="btn btn-sm btn-success">TAMBAH DATA</button></a>
    </div> 
<?= $this->endSection(); ?>