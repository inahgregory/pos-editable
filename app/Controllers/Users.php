<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('templates/header', ['title' => 'Users'])
            . view('users/index', [
                'users' => $this->userModel->getAllUsers()
            ])
            . view('templates/footer');
    }

    public function new()
    {
        return view('templates/header', ['title' => 'New User'])
            . view('users/form', [
                'errors' => [],
                'user' => null,
                'action' => site_url('/users/create')
            ])
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'full_name' => 'required'
        ];

        if (! $this->validate($rules)) {
            return view('templates/header', ['title' => 'New User'])
                . view('users/form', [
                    'errors' => $this->validator->getErrors(),
                    'user' => null,
                    'action' => site_url('/users/create')
                ])
                . view('templates/footer');
        }

        $this->userModel->insert([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'avatar' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        return view('templates/header', ['title' => 'Edit User'])
            . view('users/form', [
                'errors' => [],
                'user' => $user,
                'action' => site_url('/users/update/' . $id)
            ])
            . view('templates/footer');
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        $rules = [
            'username' => "required|is_unique[users.username,id,{$id}]",
            'full_name' => 'required',
            'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ];

        if (! $this->validate($rules)) {
            return view('templates/header', ['title' => 'Edit User'])
                . view('users/form', [
                    'errors' => $this->validator->getErrors(),
                    'user' => $user,
                    'action' => site_url('/users/update/' . $id)
                ])
                . view('templates/footer');
        }

        $avatarName = $user['avatar'];
        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/avatars', $avatarName);

            $image = Services::image()
                ->withFile(FCPATH . 'uploads/avatars/' . $avatarName)
                ->fit(200, 200, 'center')
                ->save(FCPATH . 'uploads/avatars/' . $avatarName);
        }

        $this->userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'avatar' => $avatarName,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users');
    }
}