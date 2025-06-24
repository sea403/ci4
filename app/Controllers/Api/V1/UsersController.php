<?php

namespace App\Controllers\Api\V1;

use App\Models\User;
use CodeIgniter\RESTful\ResourceController;


class UsersController extends ResourceController
{
    public function index()
    {
        $userModel = new User();

        $users = $userModel->findAll();

        return $this->response->setJSON($users);
    }
}
