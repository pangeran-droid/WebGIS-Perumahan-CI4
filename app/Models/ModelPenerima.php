<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenerima extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_penerima')
        ->join('tbl_keterangan', 'tbl_keterangan.id_keterangan = tbl_penerima.id_keterangan', 'left')
            ->get()->getResultArray();
    }

    public function AllDataPerWilayah($id_wilayah)
    {
        return $this->db->table('tbl_penerima')
        ->join('tbl_keterangan', 'tbl_keterangan.id_keterangan = tbl_penerima.id_keterangan', 'left')
        ->where('id_wilayah', $id_wilayah)
            ->get()->getResultArray();
    }

    public function AllDataPerKeterangan($id_keterangan)
    {
        return $this->db->table('tbl_penerima')
        ->join('tbl_keterangan', 'tbl_keterangan.id_keterangan = tbl_penerima.id_keterangan', 'left')
        ->where('tbl_penerima.id_keterangan', $id_keterangan)
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_penerima')->insert($data);
    }

    public function DetailData($id_penerima)
    {
    return $this->db->table('tbl_penerima')
        ->join('tbl_keterangan', 'tbl_keterangan.id_keterangan = tbl_penerima.id_keterangan', 'left')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_penerima.id_provinsi', 'left')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_penerima.id_kabupaten', 'left')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_penerima.id_kecamatan', 'left')
        ->join('tbl_wilayah', 'tbl_wilayah.id_wilayah = tbl_penerima.id_wilayah', 'left')
        ->where('id_penerima', $id_penerima)
        ->get()->getRowArray();
    }

    public function UpdateData($id_penerima, $data)
    {
    $this->db->table('tbl_penerima')
        ->where('id_penerima', $id_penerima)
        ->update($data);
    }

    public function DeleteData($id_penerima)
    {
    $this->db->table('tbl_penerima')
        ->where('id_penerima', $id_penerima)
        ->delete();
    }

    //provinsi
    public function allProvinsi()
    {
        return $this->db->table('tbl_provinsi')
            ->orderBy('id_provinsi', 'ASC')
            ->get()->getResultArray();
    }

    public function allKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
            ->where('id_provinsi', $id_provinsi)
            ->get()->getResultArray();
    }

    public function allKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')
            ->where('id_kabupaten', $id_kabupaten)
            ->get()->getResultArray();
    }

}
