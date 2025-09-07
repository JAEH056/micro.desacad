<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; 

class Page extends BaseController
{
    public function choose(){
        echo view('page');
        
    }
}