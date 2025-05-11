<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class BlogPostController extends ResourceController
{
    /**
     * Get all blog posts
     * @return \CodeIgniter\HTTP\ResponseInterface
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
