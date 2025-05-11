<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function test()
    {
        $staticFile = WRITEPATH . 'static-site/test.html';

        if (file_exists($staticFile)) {
            return $this->response
                ->setContentType('text/html')
                ->setBody(file_get_contents($staticFile));
        }

        $items = [
            ['id' => 1, 'name' => 'Mr Saikat'],
            ['id' => 2, 'name' => 'Monir']
        ];

        return view('test', compact('items'));
    }
}
