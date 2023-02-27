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

    $data['isInvalid'] = function($field) use ($data) {
      return isset($data['errors'][$field]) ? 'is-invalid' : '';
    };

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
        'rules' => 'required|is_unique[mahasiswa.nim]',
        'errors' => [
          'required' => 'NIM harus diisi!',
          'is_unique' => 'NIM sudah terdaftar!',
        ],
      ],
    ]);

    if (!$valid) {;
      $this->setPesan('danger', 'Maaf Kak!, Data gagal ditambahkan.');
      return redirect()->to(base_url('tambah'))->withInput()
        ->with('pesan', $this->pesan)
        ->with('errors', $this->validator->getErrors());
    }

    $fields = [
      'nim'  => $this->request->getPost('nim'),
      'nama' => $this->request->getPost('nama'),
      'email'   => $this->request->getPost('email'),
      'jurusan' => $this->request->getPost('jurusan'),
      'alamat'  => $this->request->getPost('alamat'),
    ];

    if ($this->modelMahasiswa->insert($fields)) {
      $this->setPesan('success', 'Selamat Kak!, Data berhasil ditambahkan.');
    } else {
      $this->setPesan('danger', 'Maaf Kak!, Data gagal ditambahkan.');
    }
    return redirect()->to('')
      ->withInput()
      ->with('pesan', $this->pesan);
  }


  public function edit()
  {
      $nim = $this->request->uri->getSegment(2);
      $hasil = $this->modelMahasiswa->find($nim);
      $data = [
          'hasil' => $hasil
      ];
      return view('edit_mahasiswa',$data);
       //dd($nim);
  }
  public function update()
  {
      $this->modelMahasiswa->set('nama', $this->request->getPost('nama'));
      $this->modelMahasiswa->set('email', $this->request->getPost('email'));
      $this->modelMahasiswa->set('jurusan', $this->request->getPost('jurusan'));
      $this->modelMahasiswa->set('alamat', $this->request->getPost('alamat'));
      $this->modelMahasiswa->where('nim', $this->request->getPost('nim'));
      $this->modelMahasiswa->update();
      session()->setFlashdata('pesan','Selamat Kak!, Data berhasil diedit.'); 
      return redirect()->to('/');
  }

  public function delete()
  {
      $nim = $this->request->uri->getSegment(2);
      $this->modelMahasiswa->delete(['nim' => $nim]);
      session()->setFlashdata('pesan','Selamat Kak!, Data berhasil dihapus.'); 
      return redirect()->to('/');
  }


  public function setPesan($tipe, $msg) {
    $this->pesan = compact('tipe', 'msg');
  }
}
