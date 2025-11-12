<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Actualizacion\UsuarioModel;
use App\Controllers\Actualizacion\Curso;

class Login extends BaseController
{


    public function login()
    {
        $rbac = service('rbac');

        if ($this->request->is('get')) {
            return view('Login/Login_Inicio', []);
        }
        $post = $this->request->getPost(['user', 'password']);
        $sonValidos = $this->validateData($post, [
            'user'        => 'required|max_length[254]|valid_email',
            'password'    => 'required|max_length[255]|min_length[6]',
        ]);
        if (! $sonValidos) {
            return view('Login/Login_Inicio', []);
        }
        $model = model(UsuarioModel::class);

        $email    = $post['user'];
        $password = $post['password'];

        $usuario = $model->validar($email, $password);

        if (empty($usuario)) {
            session()->setFlashdata('error', 'Usuario o contraseña incorrectos');
            return view('Login/Login_Inicio');
            //echo "Datos incorrectos";
            //die();
        }
        $puesto  = $model->puesto($usuario->Id);

        session()->set(
            'usuario',
            $usuario
        );
        session()->set(
            'iDpuesto',
            $puesto
        );
        return $this->response->redirect(url_to('\\' . Principal::class . '::index'));
    }

    public function logout()
    {
        session()->destroy();

        // Mostrar la vista de login directamente
        session()->setFlashdata('mensaje', 'Has cerrado sesión correctamente');
        return redirect()->to(base_url('/'));
    }
}
