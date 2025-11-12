<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Principal extends BaseController
{

    public function index()
    {
        if (!session()->has('iDpuesto')) {
            return redirect()->to(base_url())->with('error', 'No ha iniciado sesion');
        }
        return view('inicio');
    }
}