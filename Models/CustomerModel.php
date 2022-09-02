<?php

namespace App\Models;

use App\Controllers\Penjualan;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useTimestamps = true;
}
