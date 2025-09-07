<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Do something here
        $rbac = service('rbac');
        $permiso = $arguments[0];
        $IDPuesto = session()->get('iDpuesto');
        // // Ensure $permiso is a string or scalar, not an object
        if (!$rbac->check($permiso, $IDPuesto)) {
            // En caso de que no tenga los permisos redirigir a pagina segura (que no requiera permisos)
            return redirect()->to(base_url('/menu_principal'))->with('mensaje','No cuenta con los permisos suficientes' . $permiso . $IDPuesto);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
