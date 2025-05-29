<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelAdmin;
use App\Models\ModelKeterangan;


class Admin extends BaseController
{
    protected $ModelSetting;
    protected $ModelAdmin;
    protected $ModelKeterangan;

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelKeterangan = new ModelKeterangan();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'v_dashboard',
            'jumlahpenerima' => $this->ModelAdmin->JumlahPenerima(),
            'jumlahwilayah' => $this->ModelAdmin->JumlahWilayah(),
            'keterangan' => $this->ModelKeterangan->AllData(),
        ];
        return view('v_back_end', $data);
    }

    public function Setting(): string
    {
        $data = [
            'judul' => 'Setting',
            'menu' => 'setting',
            'page' => 'v_setting',
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_back_end', $data);
    }

    public function UpdateSetting()
    {
        $data = [
            'id' => 1,
            'nama_web' => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view' => $this->request->getPost('zoom_view'),
        ];
        $this->ModelSetting->UpdateData($data);
        session()->setFlashdata('pesan','Settingan web Telah Di Update !!!');
        return redirect()->to('Admin/Setting');
    }
    
}
