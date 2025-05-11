<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class SiteController extends BaseController
{
    public function home()
    {
        return view('site/home');
    }

    public function contact()
    {
        echo 'contact';
        // return view('site/home');
    }


    public function about()
    {
        echo 'About';
    }

}
