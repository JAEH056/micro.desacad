<?php

namespace App\Filters;

use App\Controllers\Login;
use App\Controllers\Tutorias\Menu;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TutoriasFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Do something here
        $rbac = service('rbac');
        $permiso = $arguments[0];
        $IDPuesto = session()->get('iDpuesto');
        if (empty($IDPuesto)) {
            // En caso de que no haya una sesion se retorna al login
            return redirect()->to(url_to('\\' . Login::class .'::login'))->with('error','No ha iniciado sesion.');
        }
        // // Ensure $permiso is a string or scalar, not an object
        if (!$rbac->check($permiso, $IDPuesto)) {
            // En caso de que no tenga los permisos redirigir a pagina segura (que no requiera permisos)
            return redirect()->to(url_to('\\' . Menu::class . '::index'))->with('mensaje','No cuenta con los permisos suficientes.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
