<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Wilayah extends BaseController
{
    protected $ModelWilayah;
    protected $ModelSetting;

    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul'   => 'Wilayah',
            'menu'    => 'wilayah',
            'page'    => 'wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web'     => $this->ModelSetting->DataWeb(),
        ];
        return view('v_back_end', $data);
    }

    public function Input()
    {
        return view('v_back_end', [
            'judul'      => 'Input Wilayah',
            'menu'       => 'wilayah',
            'page'       => 'wilayah/v_input',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna'        => $this->request->getPost('warna'),
                'geojson'      => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('Wilayah');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Wilayah/Input')->withInput('validations', \Config\Services::validation());
        }
    }

    public function Edit($id_wilayah)
    {
        $data = [
            'judul'   => 'Edit Wilayah',
            'menu'    => 'wilayah',
            'page'    => 'wilayah/v_edit',
            'wilayah' => $this->ModelWilayah->DetailData($id_wilayah),
        ];
        return view('v_back_end', $data);
    }

    public function UpdateData($id_wilayah)
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            $data = [
                'id_wilayah'   => $id_wilayah,
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna'        => $this->request->getPost('warna'),
                'geojson'      => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->UpdateData($id_wilayah, $data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!');
            return redirect()->to('Wilayah');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Wilayah/Input')->withInput('validations', \Config\Services::validation());
        }
    }

    public function Delete($id_wilayah)
    {
        $this->ModelWilayah->DeleteData($id_wilayah);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!');
        return redirect()->to('Wilayah');
    }
}
