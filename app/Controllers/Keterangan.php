<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelKeterangan;

class Keterangan extends BaseController
{
    protected $ModelKeterangan;

    public function __construct()
    {
        $this->ModelKeterangan = new ModelKeterangan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Keterangan',
            'menu' => 'keterangan', 
            'page' => 'v_keterangan',
            'keterangan' => $this->ModelKeterangan->AllData(),
        ];
        return view('v_back_end', $data);
    }

    public function UpdateData($id_keterangan)
    {
        $marker = $this->request->getFile('marker');
        $name_file = $marker->getRandomName();
        $data = [
            'id_keterangan'=> $id_keterangan,
            'marker' => $name_file,
        ];

        $marker->move('marker', $name_file);
        $this->ModelKeterangan->UpdateData($id_keterangan, $data);
        session()->setFlashdata('update', 'Marker Berhasil Di Tambahkan !!');
            return redirect()->to('Keterangan');
    }
}