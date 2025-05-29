<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeterangan extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_keterangan')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_keterangan')->insert($data);
    }

    public function UpdateData($id_keterangan, $data)
    {
    $this->db->table('tbl_keterangan')
        ->where('id_keterangan', $id_keterangan)
        ->update($data);
    }

    public function DeleteData($id_keterangan)
    {
    $this->db->table('tbl_keterangan')
        ->where('id_keterangan', $id_keterangan)
        ->delete();
    }
}
