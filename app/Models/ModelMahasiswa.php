<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';  
    protected $allowedFields    = ['nama','email','jurusan','alamat'];
    
    
}
