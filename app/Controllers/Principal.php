<?php
namespace App\Controllers;

use App\Controllers\BaseController;


class Principal extends BaseController {

    public function index() {
        return view('inicio');
    }
}