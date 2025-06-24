<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function profile()
    {
        $title = 'Admin Profile';

        return view("admin/profile", compact('title'));
    }

    public function index()
    {
        $title = 'Admin Panel';

        return view('admin/index', compact('title'));
    }
}