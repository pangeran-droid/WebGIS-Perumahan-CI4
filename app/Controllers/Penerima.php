<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenerima;
use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelKeterangan;

class Penerima extends BaseController
{
    protected $ModelPenerima;
    protected $ModelSetting;
    protected $ModelWilayah;
    protected $ModelKeterangan;

    public function __construct()
    {
        $this->ModelPenerima = new ModelPenerima();
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelKeterangan = new ModelKeterangan();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Daftar Penerima Bantuan Pemerintah',
            'menu'      => 'penerima',
            'page'      => 'penerima/v_index',
            'penerima'  => $this->ModelPenerima->AllData(),
        ];
        return view('v_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul'     => 'Input Penerima',
            'menu'      => 'penerima',
            'page'      => 'penerima/v_input',
            'web'       => $this->ModelSetting->DataWeb(),
            'provinsi'  => $this->ModelPenerima->allProvinsi(),
            'wilayah'   => $this->ModelWilayah->AllData(),
            'keterangan'=> $this->ModelKeterangan->AllData(),
        ];
        return view('v_back_end', $data);
    }

    public function InsertData()
    {
        $validation = $this->validate([
            'nama_penerima' => [
                'label' => 'Nama Penerima',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'nomor_ktp' => [
                'label' => 'Nomor KTP',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'coordinat' => [
                'label' => 'Koordinat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'jenis_atap' => [
                'label' => 'Jenis Atap',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'jenis_dinding' => [
                'label' => 'Jenis Dinding',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'jenis_lantai' => [
                'label' => 'Jenis Lantai',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'jenis_bantuan' => [
                'label' => 'Jenis Bantuan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'id_wilayah' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'foto' => [
                'label' => 'Foto Rumah',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !!',
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in' => 'Format {field} harus JPG, JPEG, atau PNG !!'
                ]
            ],
        ]);

        if (!$validation) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Penerima/Input')->withInput();
        }

        $foto = $this->request->getFile('foto');
        $nama_file_foto = $foto->getRandomName();


        $data = [
            'nama_penerima' => $this->request->getPost('nama_penerima'),
            'nomor_ktp'        => $this->request->getPost('nomor_ktp'),
            'alamat'        => $this->request->getPost('alamat'),
            'coordinat'     => $this->request->getPost('coordinat'),
            'id_keterangan' => $this->request->getPost('id_keterangan'),
            'id_provinsi'   => $this->request->getPost('id_provinsi'),
            'id_kabupaten'  => $this->request->getPost('id_kabupaten'),
            'id_kecamatan'  => $this->request->getPost('id_kecamatan'),
            'jenis_atap'    => $this->request->getPost('jenis_atap'),
            'jenis_dinding' => $this->request->getPost('jenis_dinding'),
            'jenis_lantai'  => $this->request->getPost('jenis_lantai'),
            'jenis_bantuan'  => $this->request->getPost('jenis_bantuan'),
            'id_wilayah'    => $this->request->getPost('id_wilayah'),
            'foto'          => $nama_file_foto,
        ];

        $foto->move('foto', $nama_file_foto);

        $this->ModelPenerima->InsertData($data);
        session()->setFlashdata('insert', 'Data Berhasil Di Tambahkan !!');
        return redirect()->to('Penerima');
    }

    // Ambil kabupaten berdasarkan provinsi
    public function Kabupaten()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $dataKabupaten = $this->ModelPenerima->allKabupaten($id_provinsi);
        echo '<option value="">--Pilih Kabupaten--</option>';
        foreach ($dataKabupaten as $row) {
            echo '<option value="' . $row['id_kabupaten'] . '">' . $row['nama_kabupaten'] . '</option>';
        }
    }

    // Ambil kecamatan berdasarkan kabupaten
    public function Kecamatan()
    {
        $id_kabupaten = $this->request->getPost('id_kabupaten');
        $dataKecamatan = $this->ModelPenerima->allKecamatan($id_kabupaten);
        echo '<option value="">--Pilih Kecamatan--</option>';
        foreach ($dataKecamatan as $row) {
            echo '<option value="' . $row['id_kecamatan'] . '">' . $row['nama_kecamatan'] . '</option>';
        }
    }

    public function Edit($id_penerima)
    {
        $data = [
            'judul'     => 'Edit Data Penerima',
            'menu'      => 'penerima',
            'page'      => 'penerima/v_edit',
            'web'       => $this->ModelSetting->DataWeb(),
            'provinsi'  => $this->ModelPenerima->allProvinsi(),
            'wilayah'   => $this->ModelWilayah->AllData(),
            'keterangan'=> $this->ModelKeterangan->AllData(),
            'penerima'  => $this->ModelPenerima->DetailData($id_penerima),
        ];
        return view('v_back_end', $data);
    }

    public function UpdateData($id_penerima)
    {
        if ($this->validate([
            'nama_penerima' => ['label' => 'Nama Penerima', 'rules' => 'required'],
            'nomor_ktp' => ['label' => 'Nomor KTP', 'rules' => 'required'],
            'alamat' => ['label' => 'Alamat', 'rules' => 'required'],
            'coordinat' => ['label' => 'Koordinat', 'rules' => 'required'],
            'id_keterangan' => ['label' => 'Keterangan', 'rules' => 'required'],
            'id_provinsi' => ['label' => 'Provinsi', 'rules' => 'required'],
            'id_kabupaten' => ['label' => 'Kabupaten', 'rules' => 'required'],
            'id_kecamatan' => ['label' => 'Kecamatan', 'rules' => 'required'],
            'jenis_atap' => ['label' => 'Jenis Atap', 'rules' => 'required'],
            'jenis_dinding' => ['label' => 'Jenis Dinding', 'rules' => 'required'],
            'jenis_lantai' => ['label' => 'Jenis Lantai', 'rules' => 'required'],
            'jenis_bantuan' => ['label' => 'Jenis Bantuan', 'rules' => 'required'],
            'id_wilayah' => ['label' => 'Wilayah Administrasi', 'rules' => 'required'],
            'foto' => [
                'label' => 'Foto Rumah',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} maksimal 1024 KB !!',
                    'mime_in' => 'Format {field} harus JPG, JPEG, atau PNG !!',
                ]
            ],
        ])) {
            $penerima = $this->ModelPenerima->DetailData($id_penerima);
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                $nama_file_foto = $penerima['foto'];
            } else {
                $nama_file_foto = $foto->getRandomName();
                $foto->move('foto', $nama_file_foto);
            }

            $data = [
                'id_penerima'   => $id_penerima,
                'nama_penerima' => $this->request->getPost('nama_penerima'),
                'nomor_ktp'     => $this->request->getPost('nomor_ktp'),
                'alamat'        => $this->request->getPost('alamat'),
                'coordinat'     => $this->request->getPost('coordinat'),
                'id_keterangan' => $this->request->getPost('id_keterangan'),
                'id_provinsi'   => $this->request->getPost('id_provinsi'),
                'id_kabupaten'  => $this->request->getPost('id_kabupaten'),
                'id_kecamatan'  => $this->request->getPost('id_kecamatan'),
                'jenis_atap'    => $this->request->getPost('jenis_atap'),
                'jenis_dinding' => $this->request->getPost('jenis_dinding'),
                'jenis_lantai'  => $this->request->getPost('jenis_lantai'),
                'jenis_bantuan'  => $this->request->getPost('jenis_bantuan'),
                'id_wilayah'    => $this->request->getPost('id_wilayah'),
                'foto'          => $nama_file_foto,
            ];
            
            $this->ModelPenerima->UpdateData($id_penerima, $data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!');
            return redirect()->to('Penerima');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('Penerima/Edit/' . $id_penerima)->withInput();
        }
    }

    public function Delete($id_penerima)
    {
        $penerima = $this->ModelPenerima->DetailData($id_penerima);
    
        if (!empty($penerima['foto'])) {
            $fotoPath = FCPATH . 'foto/' . $penerima['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }
    
        $this->ModelPenerima->DeleteData($id_penerima);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!');
        return redirect()->to('Penerima');
    }    

    public function Detail($id_penerima)
    {
        $data = [
            'judul'     => 'Detail Penerima Bantuan',
            'menu'      => 'penerima',
            'page'      => 'penerima/v_detail',
            'web'       => $this->ModelSetting->DataWeb(),
            'penerima'  => $this->ModelPenerima->DetailData($id_penerima),
        ];
        return view('v_back_end', $data);
    }

}
