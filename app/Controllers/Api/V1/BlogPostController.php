<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use OpenApi\Annotations as OA;

class BlogPostController extends ResourceController
{
    /**
     * @OA\Get(
     *     path="/api/v1/posts",
     *     summary="Get all the blog posts",
     * )
     */
    public function index()
    {
        /** todo: we have to imeplement this  */
        return $this->response->setJSON([
            'success' => true,
            'todo' => 'Have to make this done :)'
        ]);
    }
}
