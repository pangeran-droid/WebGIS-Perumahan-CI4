<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Auth extends BaseController
{
    protected $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function Login()
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('auth/v_login', $data);
    }

    public function Register()
    {
        $data = [
            'judul' => 'Register',
        ];
        return view('auth/v_register', $data);
    }

    public function saveRegister()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required|min_length[3]|is_unique[tbl_user.username]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'is_unique'  => '{field} sudah digunakan.'
                ]
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'valid_email' => 'Format {field} tidak valid.',
                    'is_unique'   => '{field} sudah terdaftar.'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 6 karakter.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->ModelUser->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('Auth/Login')->with('success', 'Berhasil daftar, silakan login!');
    }

    public function CekLogin()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'valid_email' => 'Format {field} tidak valid.'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->ModelUser->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'logged_in'      => true,
                'user_email'     => $user['email'],
                'user_username'  => $user['username'],
            ]);
            return redirect()->to('Admin');
        }

        return redirect()->back()->withInput()->with('errors', ['Login' => 'Email atau password salah.']);
    }

    public function LogOut()
    {
        session()->remove(['logged_in', 'user_email', 'user_username']);
        session()->setFlashdata('success', 'Berhasil logout.');
        return redirect()->to('Auth/Login');
    }
}
