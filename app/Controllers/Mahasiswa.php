<?php

namespace App\Controllers;

use App\Models\ModelMahasiswa;

class Mahasiswa extends BaseController
{
  protected $modelMahasiswa;
  protected $pesan;


  public function __construct()
  {
    $this->modelMahasiswa = new ModelMahasiswa();
  }


  public function index()
  {
    $data = [
      'mahasiswa' => $this->modelMahasiswa->findAll()
    ];
    if ($pesan = session()->getFlashdata('pesan')) {
      $data['pesan'] = $pesan;
    }
    return view('tampil_mahasiswa', $data);
  }


  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Mahasiswa',
      'errors' => session()->getFlashdata('errors'),
    ];

    // fungsi untuk menambahkan class is-invalid bila terdapat error
    $data['isInvalid'] = function ($field) use ($data) {
      return isset($data['errors'][$field]) ? 'is-invalid' : '';
    };
    // $data['isInvalid'] = fn ($field) => isset($data['errors'][$field]) ? 'is-invalid' : '';

    if ($pesan = session()->getFlashdata('pesan')) {
      $data['pesan'] = $pesan;
    }
    return view('tambah_mahasiswa', $data);
  }


  public function save()
  {
    $valid = $this->validate([
      'nama' => [
        'rules' => 'required|alpha',
        'errors' => [
          'required' => 'Nama harus diisi!',
          'alpha' => 'Nama hanya boleh mengandung alfabet!',
        ],
      ],
      'nim' => [
        'rules' => 'required|numeric|is_unique[mahasiswa.nim]',
        'errors' => [
          'required' => 'NIM harus diisi!',
          'numeric' => 'NIM hanya boleh berisi angka!',
          'is_unique' => 'NIM sudah terdaftar!',
        ],
      ],
      'email' => [
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => 'Email harus diisi!',
          'is_unique' => 'Email tidak valid!',
        ],
      ],
    ]);

    if (!$valid) {
      $this->setPesan('danger', 'Maaf Kak!, Data gagal ditambahkan.');
      return redirect()->to(base_url('tambah'))->withInput()
        ->with('pesan', $this->pesan)
        ->with('errors', $this->validator->getErrors());
    }

    if ($this->modelMahasiswa->insert($this->request->getPost())) {
      $this->setPesan('success', 'Selamat Kak!, Data berhasil ditambahkan.');
    } else {
      $this->setPesan('danger', 'Maaf Kak!, Data gagal ditambahkan.');
    }
    return redirect()->to('')
      ->withInput()
      ->with('pesan', $this->pesan);
  }


  public function edit($nim)
  {
    $data = [
      'mhs' => $this->modelMahasiswa->find($nim),
      'errors' => session()->getFlashdata('errors'),
    ];

    $data['isSelected'] = function ($old, $value) use ($data) {
      $selected = $old == $value || $data['mhs']->jurusan == $value;
      return $selected ? 'selected' : '';
    };

    if ($pesan = session()->getFlashdata('pesan')) {
      $data['pesan'] = $pesan;
    }

    return view('edit_mahasiswa', $data);
  }


  public function update($nim)
  {
    $valid = $this->validate([
      'nama' => [
        'rules' => 'required|alpha_space',
        'errors' => [
          'required' => 'Nama harus diisi!',
          'alpha' => 'Nama hanya boleh mengandung alfabet!',
        ],
      ],
      'nim' => [
        'rules' => 'required|numeric|is_unique[mahasiswa.nim,nim,{nim}]',
        'errors' => [
          'required' => 'NIM harus diisi!',
          'numeric' => 'NIM hanya boleh berisi angka!',
          'is_unique' => 'NIM sudah terdaftar!',
        ],
      ],
      'email' => [
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => 'Email harus diisi!',
          'is_unique' => 'Email tidak valid!',
        ],
      ],
    ]);

    if (!$valid) {
      $this->setPesan('danger', 'Maaf Kak!, Data gagal diedit.');
      return redirect()->to(base_url("$nim/ubah"))->withInput()
        ->with('pesan', $this->pesan)
        ->with('errors', $this->validator->getErrors());
    }

    $updated = $this->modelMahasiswa->save($this->request->getPost());
    if ($updated) {
      $this->setPesan('success', 'Selamat Kak!, Data berhasil diedit.');
      return redirect()->to('')->with('pesan', $this->pesan);
    } else {
      $this->setPesan('danger', 'Maaf Kak!, Data gagal diedit.');
      return redirect()->to("/$nim/ubah")
        ->withInput()
        ->with('pesan', $this->pesan);
    }
  }


  public function delete($nim)
  {
    $this->modelMahasiswa->delete(['nim' => $nim]);
    $this->setPesan('success', 'Selamat Kak! Data berhasil dihapus.');
    return redirect()->to('')->with('pesan', $this->pesan);
  }


  public function setPesan($tipe, $msg)
  {
    $this->pesan = compact('tipe', 'msg');
  }
}
