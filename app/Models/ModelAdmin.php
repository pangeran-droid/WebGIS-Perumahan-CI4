<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function JumlahPenerima()
    {
        return $this->db->table('tbl_penerima')
        ->countAll();
    }

    public function JumlahWilayah()
    {
        return $this->db->table('tbl_wilayah')
        ->countAll();
    }
}
