<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new User();

        $users = $userModel->findAll();

        $title = 'Users';

        return view("admin/user/index", compact("title", "users"));
    }

    public function add()
    {
        $title = 'Add New User';

        return view("admin/user/add", compact("title"));
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User with ID $id not found");
        }

        $title = 'Edit User';

        return view('admin/user/edit', compact('title', 'user'));
    }

    public function delete($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User with ID $id not found");
        }

        $userModel->delete($id);

        return redirect()->to('/admin/user/index')->with('success', 'User deleted successfully');
    }

    public function update($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User with ID $id not found");
        }

        $request = service('request');

        $validation = \Config\Services::validation();

        $rules = [
            'firstname' => 'required|min_length[2]',
            'lastname' => 'required|min_length[2]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
        ];

        // Only validate password if it's filled (user can skip password update)
        if ($request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$validation->setRules($rules)->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'firstname' => $request->getPost('firstname'),
            'lastname'  => $request->getPost('lastname'),
            'email'     => $request->getPost('email'),
        ];

        if ($request->getPost('password')) {
            $data['password'] = password_hash($request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/admin/user/index')->with('success', 'User updated successfully!');
    }

    public function store()
    {
        $request = service('request');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'firstname'         => 'required|min_length[2]',
            'lastname'          => 'required|min_length[2]',
            'email'             => 'required|valid_email|is_unique[users.email]',
            'password'          => 'required|min_length[6]',
            'password_confirm'  => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new User();

        $userModel->insert([
            'firstname' => $request->getPost('firstname'),
            'lastname'  => $request->getPost('lastname'),
            'email'     => $request->getPost('email'),
            'password'  => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/admin/user/index')->with('success', 'User created successfully!');
    }
}
