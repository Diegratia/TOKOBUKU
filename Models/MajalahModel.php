<?php

namespace App\Models;

use CodeIgniter\Model;


class MajalahModel extends Model
{
    //nama tabel
    protected $table        = 'majalah';
    //atribut yang digunakan menjadi primary key
    protected $primaryKey = 'majalah_id';
    // Atribut untuk menyimpan created_at dan updated_at
    protected $useTimestamps =  true;
    protected $allowedFields = [
        'judul', 'slug', 'penerbit', 'tahun', 'harga', 'diskon',
        'stok', 'cover', 'majalah_category_id'
    ];

    protected $useSoftDeletes = true;

    public function getMajalah($slug = false)
    {
        $query = $this->table('majalah')
            ->join('majalah_category', 'majalah_category_id')
            ->where('deleted_at is null');


        if ($slug == false)
            return $query->get()->getResultArray();
        return $query->where(['slug' => $slug])->first();
    }
}
