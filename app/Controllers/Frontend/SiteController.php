<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class SiteController extends BaseController
{
    public function changeLang($lang)
    {
        $session = session();
        $session->set('locale', $lang);
        return redirect()->back();
    }
    
    public function home()
    {
        return view('site/home');
    }

    public function contact()
    {
        echo 'contact';
    }


    public function about()
    {
        echo 'About';
    }

}
