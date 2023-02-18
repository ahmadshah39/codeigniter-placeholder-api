<?php

namespace App\Controllers\Web;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index() 
    {
        phpinfo();
        exit;
        return view('welcome_message');
    }
    public function data()
    {
        echo 'hello';
    }
}
