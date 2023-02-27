<?php

namespace App\Controllers;
use App\Models\ModelMahasiswa;
class Mahasiswa extends BaseController
{
    protected $modelMahasiswa;
    
    public function __construct()
    {
        $this->modelMahasiswa = new ModelMahasiswa();
    }
    public function index()
    {
        $data=[
            'datamahasiswa'=>$this->modelMahasiswa->findAll()
        ];
        return view('tampil_mahasiswa',$data);
    }
    public function create()
    {
        
        if($this->request->getPost()){
            $fields=[
                'nim'=>$this->request->getPost('nim'),
                'nama'=>$this->request->getPost('nama'),
                'email'=>$this->request->getPost('email'),
                'jurusan'=>$this->request->getPost('jurusan'),
                'alamat'=>$this->request->getPost('alamat')
                // 'validation' => \Config\Services::validation()
            ];
            $this->modelMahasiswa->insert($fields);
            session()->setFlashdata('pesan','Selamat Kak!, Data berhasil ditambahkan.'); 
            return redirect()->to('');

                                 //validasi input
                                 if (!$this->validate([
                                    'nim' => [
                                        'rules' => 'required|is_unique[number.nim]',
                                        'errors' => [
                                            'required' => '{field} data harus diisi',
                                            'is_unique' => '{field} data sudah terdaftar'
                                        ]
                                        ]         
                        
                                 ])) 

                                   {
                                
                                    //     dd($validation);
                                    $validation = \Config\Services::validation();
                                   return redirect()->to('/tambah')->withInput()->with('validation',$validation);
                                   }
        
    

        }
        // session();
        $data=[
            'title'=> 'Form Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation()
        ];
       
        return view('tambah_mahasiswa',$data);
   

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
}
