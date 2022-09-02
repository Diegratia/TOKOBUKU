<?php

namespace App\Models;

use CodeIgniter\Model;


class BuyModel extends Model
{
    // Nama Tabel
    protected $table  = 'buy';
    protected $useTimestamps  = true;
    protected $allowedFields  = ['buy_id', 'user_id', 'supplier_id'];

    public function getReport()
    {
        return $this->db->table('buy_detail as sd')
            ->select('s.buy_id, s.created_at tgl_transaksi, us.id user_id, us.firstname,
             us.lastname, , us.username, a.supplier_id, a.name name_supp, 
             SUM(sd.total_price) total')
            ->join('buy s', 'buy_id')
            ->join('users us', 'us.id = s.user_id')
            ->join('supplier a', 'supplier_id', 'left')
            ->groupBy('s.buy_id')
            ->get()->getResultArray();
    }
}
