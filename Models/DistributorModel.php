<?php

namespace App\Models;

use CodeIgniter\Model;


class DistributorModel extends Model
{
    //nama tabel
    protected $table        = 'distributor';
    //atribut yang digunakan menjadi primary key
    protected $primaryKey = 'distributor_id';
    // Atribut untuk menyimpan created_at dan updated_at
    protected $useTimestamps =  true;
    protected $allowedFields = ['name', 'address', 'email', 'phone'];
    protected $returnType = 'App\Entities\DistributorEntity';
}
