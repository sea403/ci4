<?php

namespace App\Controllers\Api\V1;

use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public function __construct()
    {
        /** don't forget the load the helper */
        helper('jwt');
    }

    /**
     * Register an user
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function register()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'firstname' => 'permit_empty',
            'lastname' => 'permit_empty'
        ];

        /**
         * Customize the message for email unique
         * @var array
         */
        $messages = [
            'email' => [
                'is_unique' => 'This email already in use'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'error' => $this->validator->getErrors()
                ]);
        }

        $userModel = new User();

        $user = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->save($user);
        $userId = $userModel->getInsertID();

        $user = $userModel->select('id, firstname, lastname, email')->find($userId);

        $token = generateJWT($user);

        return $this->response->setStatusCode(201) // it's better to set use status code
            ->setJSON(
                [
                    'success' => true,
                    'user' => $user,
                    'token' => $token
                ]
            );
    }

    /**
     * Login an user
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'error' => $this->validator->getErrors()
                ]);
        }
        
        $userModel = new User();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'error' => 'Invalid credentials']);
        }

        $token = generateJWT($user);

        return $this->response->setJSON(['user' => $user, 'token' => $token]);
    }

    /**
     * Get the profile of authenticated user
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function profile()
    {
        $userId = $this->request->user->sub;

        $userModel = new User();
        $user = $userModel->find($userId);

        /** hide the passowrd in the reponse */
        unset($user['password']); 
    
        return $this->response->setJSON([
            'user' => $user
        ]);
    }
}