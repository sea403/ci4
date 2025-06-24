<?php

namespace App\Controllers\Api\V1;

use App\Models\User;
use CodeIgniter\RESTful\ResourceController;
use OpenApi\Attributes as OA;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication Endpoints"
 * )
 */
class AuthController extends ResourceController
{
    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     tags={"Auth"},
     *     summary="Register a user",
     *     description="This endpoint allows a user to register with email and password",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="firstname", type="string", example="John"),
     *             @OA\Property(property="lastname", type="string", example="Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *             @OA\Property(property="token", type="string", example="your_jwt_token_here")
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="object")
     *         )
     *     )
     * )
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
     * @OA\Post(
     *     path="/api/v1/login",
     *     tags={"Auth"},
     *     summary="Login a user",
     *     description="This endpoint allows a user to log in with email and password",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User logged in successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *             @OA\Property(property="token", type="string", example="your_jwt_token_here")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
     */
    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
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
     * @OA\Get(
     *     path="/api/v1/profile",
     *     tags={"Auth"},
     *     summary="Get the authenticated user's profile",
     *     description="This endpoint returns the profile of the logged-in user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="User profile retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     )
     * )
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