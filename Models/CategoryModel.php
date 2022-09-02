<?php

namespace App\Models;

use CodeIgniter\Model;


class CategoryModel extends Model
{
    //Nama Tabel
    protected $table        = 'book_category';
    //atribut yang digunakan sebagai primary key
    protected $primaryKey = 'book_category_id';
}
