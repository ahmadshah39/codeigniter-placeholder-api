<?php

namespace App\Controllers\Web;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index() 
    {
        echo 'welcome to codeigniter placeholder api';
        exit;
        // return view('welcome_message');
    }
}
