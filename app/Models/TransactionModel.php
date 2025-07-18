<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status', 'created_at', 'updated_at', 'bukti_bayar'
    ];

    public function updateStatus($id, $status) 
    { 
        return $this->update($id, ['status' => $status]); 
    }
}