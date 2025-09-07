<?php

namespace App\Controllers\Actualizacion;

use App\Controllers\BaseController;
use App\Models\Actualizacion\UsuarioModel;
use App\Entities\Actualizacion\Usuario as UsuarioEntity;
use App\Models\Actualizacion\GradoModel;
use App\Entities\Actualizacion\Grado as GradoEntity;
use App\Models\Actualizacion\PuestoModel;
use App\Entities\Actualizacion\Puesto as PuestoEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Usuario extends BaseController
{
    public function showAll()
    {
        $model = model(UsuarioModel::class);

        $usuarios = $model->userAll();

        $data = [
            'title' => 'Usuarios',
            'usuarios' => $usuarios,
        ];

        return view('templates/header', $data)
            . view('Actualizacion/usuario/usuario_lista', $data)
            . view('templates/footer');
    }

    public function userShow(int $id = 0)
    {
        $model = model(UsuarioModel::class);

        $usuario = $model->userCuenta($id);

        $data = [
            'title' => 'Usuario',
            'usuario' => $usuario,
            'id_usuario' => $id,
        ];
        $pmodel = model(UsuarioModel::class);
        $puestos = $pmodel->userPuesto();
        $npuestos = [];
        foreach ($puestos as $p) {
            $npuestos[$p->Id] = $p->Nombre;
        }

        $data['puestos'] = $npuestos;
        return view('templates/header', $data)
            . view('Actualizacion/usuario/usuario_show', $data)
            . view('templates/footer');
    }


    /**
     * Crea un nuevo usuario con puesto y rol
     * @return string|\CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\HTTP\ResponseInterface
     */
    public function create()
    {
        helper('form');

        $data = [
            'title' => 'Crear un nuevo usuario'
        ];
        $pmodel = model(UsuarioModel::class);
        $puestos = $pmodel->userPuesto();
        $npuestos = [];
        foreach ($puestos as $p) {
            $npuestos[$p->Id] = $p->Nombre;
        }

        $data['puestos'] = $npuestos;
        if ($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_crear')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['Id', 'Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Rfc', 'Sexo', 'Email', 'Id_Organigrama', 'Nivel', 'Carrera', 'Nombre_C', 'Siglas', 'Password', 'pass_confirm']);

        $sonValidos = $this->validateData($post, [
            'Nombre'            => 'required|max_length[255]|min_length[3]',
            'Primer_Apellido'   => 'required|max_length[255]|min_length[3]',
            'Segundo_Apellido'  => 'required|max_length[255]|min_length[3]',
            'Curp'              => 'required|max_length[18]',
            'Rfc'               => 'required|max_length[13]',
            'Sexo'              => 'required|in_list[H,M]',
            'Email'             => 'required|max_length[254]|valid_email|is_unique[usuario.Email]',
            'Id_Organigrama'    => 'required|numeric',
            'Password'          => 'required|max_length[255]|min_length[10]',
            'pass_confirm'      => 'required|max_length[255]|matches[Password]',
            'Nivel'             => 'required|in_list[Licenciatura,Especialidad,Maestria,Doctorado]',
            'Carrera'           => 'required|max_length[255]|min_length[3]',
            'Nombre_C'          => 'required|max_length[255]|min_length[3]',
            'Siglas'            => 'required|max_length[255]|min_length[1]',
        ]);

        if (! $sonValidos) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_crear')
                . view('templates/footer');
        }

        $model =  model(UsuarioModel::class);
        $modelg = model(GradoModel::class);
        $modelp = model(PuestoModel::class);

        $usuario = new UsuarioEntity();
        $usuario->Nombre            = $post['Nombre'];
        $usuario->Primer_Apellido   = $post['Primer_Apellido'];
        $usuario->Segundo_Apellido  = $post['Segundo_Apellido'];
        $usuario->Curp              = $post['Curp'];
        $usuario->Rfc               = $post['Rfc'];
        $usuario->Email             = $post['Email'];
        $usuario->Sexo              = $post['Sexo'];
        $usuario->Password          = password_hash($post['Password'], PASSWORD_DEFAULT);
        $grado = [];
        $grado['Nivel']             = $post['Nivel'];
        $grado['Carrera']           = $post['Carrera'];
        $grado['Nombre']          = $post['Nombre_C'];
        $grado['Siglas']            = $post['Siglas'];

        $model->save($usuario); // Se guarda al ususario
        $Id_Usuario = $model->insertID();
        $modelg->addGrado($Id_Usuario, $grado);
        // En la función addPuesto usuarioModel para guardar puesto
        $modelp->addPuesto($Id_Usuario, $post['Id_Organigrama']);
        // En la función addGrado usuarioModel para guardar grado
        
        if (!$this->asignarRol($post['Id_Organigrama'], $Id_Usuario)) {
            // Manejar el caso en que no se pudo asignar el rol
            return redirect()->to(url_to('\\' . Usuario::class . '::create'))->withInput()->with('errors', 'No se pudo asignar el rol');
        }

        return $this->response->redirect(url_to('\\' . Usuario::class . '::create'));
    }

    private function obtenerOrganigramaRolID(int $idOrganigrama): int
    {
        /*
        * Nota: En este arreglo sustitiyes los Id que abarcara cada ROL
        * Ejemplo: 'SuperAdmin' => [50, 61, 70] incluye los Id(s) del puesto(s) que podrian considerarse un ADMINISTRADOR
        */
        // Lista de arrays con los IDs del organigrama
        $puestosOrganigrama = [
            'administrador' => [4],
            'docentes'      => [37, 34, 33, 32, 31, 30, 29, 28],
            'instructor'    => [35],
            'empleado'      => [38, 36, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 3],
            'direccion'     => [15, 2, 1],
        ];
        foreach ($puestosOrganigrama as $rol => $ids) {
            if (in_array($idOrganigrama, $ids)) {
                // Usar match para retornar un valor basado en el rol encontrado
                return match ($rol) {
                    'docentes'       => 3, // RoleID para docentes
                    'instructor'     => 4,
                    'direccion'      => 6,
                    'administrador'  => 2,
                    default          => 5, // RoleID por defecto (Empleado)
                };
            }
        }
        return 5;
    }

    /**
     * Asigna el rol a un puesto empleado
     * @param int $idOrganigrama
     * @param int $idEmpleado
     * @return bool
     */
    public function asignarRol(int $idOrganigrama, int $idEmpleado): bool
    {
        $idRol = $this->obtenerOrganigramaRolID($idOrganigrama);
        // obtener id del rol con el idOrganigrama
        return service('rbac')->Users->assign($idRol, $idEmpleado);
    }

    public function update(int $id = 0)
    {

        $model = model(UsuarioModel::class);

        $data = [
            'title'  => 'Actualiza el usuario',
            'usuario' => $model->userCuenta($id),
            'id_usuario' => $id,
        ];
        $pmodel = model(UsuarioModel::class);
        $puestos = $pmodel->userPuesto();
        $npuestos = [];
        foreach ($puestos as $p) {
            $npuestos[$p->Id] = $p->Nombre;
        }

        $data['puestos'] = $npuestos;
        if ($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_update')
                . view('templates/footer');
        }
    }

    public function updateUser()
    {
        $model = model(UsuarioModel::class);
        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Id_Organigrama', 'Nivel', 'Carrera', 'Nombre_C', 'Siglas']);

        $sonValidos = $this->validateData($post, [
            'Id_Organigrama'    => 'required|numeric',
            'Nivel'             => 'required|in_list[Licenciatura,Especialidad,Maestria,Doctorado]',
            'Carrera'           => 'required|max_length[255]|min_length[3]',
            'Nombre_C'          => 'required|max_length[255]|min_length[3]',
            'Siglas'            => 'required|max_length[255]|min_length[1]',
        ]);

        if (! $sonValidos) {
            return redirect()->back()->withInput();
        }

        $model->update($id, $post);
        return $this->response->redirect(url_to('\\' . Usuario::class . '::showAll'));
    }

    public function updateAccount(int $id = 0)
    {

        $model = model(UsuarioModel::class);

        $data = [
            'title'  => 'Actualiza la cuenta usuario',
            'usuario' => $model->userCuenta($id),
            'id_usuario' => $id,
        ];
        $pmodel = model(UsuarioModel::class);
        $puestos = $pmodel->userPuesto();
        $npuestos = [];
        foreach ($puestos as $p) {
            $npuestos[$p->Id] = $p->Nombre;
        }
        $data['puestos'] = $npuestos;
        if ($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_account')
                . view('templates/footer');
        }
    }
    public function actualizarPuesto()
    {
        $model = model(UsuarioModel::class);

        // ID del usuario

        // 1) Obtener datos del formulario
        $Id_Usuario   = $this->request->getPost('Id');
        $New_Puesto = $this->request->getPost('Id_Organigrama');

        // 2) Validar que vengan datos
        if (!$Id_Usuario || !$New_Puesto) {
            return redirect()->back()
                ->withInput()
                ->with('errors', 'Faltan datos para actualizar el puesto');
        }

        // 3) Llamar al modelo para cambiar el puesto
        if (!$model->cambiarPuesto((int)$Id_Usuario, (int)$New_Puesto)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', 'No se pudo actualizar el puesto ni asignar el rol');
        }

        // 4) Redirigir con mensaje de éxito
        return redirect()->to(url_to('\\' . Usuario::class . '::updateAccount'))
            ->with('message', 'Puesto actualizado correctamente');
        
    }

    /**
     * Agegar un puesto extra a un usuario
     */


    public function addNewPuesto()
    {
        $model = model(UsuarioModel::class);

        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Rfc', 'Sexo']);

        $sonValidos = $this->validateData($post, [
            'Nombre'            => 'required|max_length[255]|min_length[3]',
            'Primer_Apellido'   => 'required|max_length[255]|min_length[3]',
        ]);

        if (! $sonValidos) {
            return redirect()->back()->withInput();
        }


        
        $model->update($id, $post);
        return $this->response->redirect(url_to('\\' . Usuario::class . '::showAll'));
    }
    public function updateGrado(int $id = 0)
    {
        helper('form');
        $model = model(UsuarioModel::class);

        $data = [
            'title' => 'Agrega un grupo',
            'usuario' => $model->userCuenta($id),
            'id_usuario' => $id,
        ];

        if ($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_grado')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['Id', 'Nivel', 'Carrera', 'Nombre_C', 'Siglas']);
        $id_organigrama = $post['Id_Organigrama'];

        $sonValidos = $this->validateData($post, [
            'Nivel'             => 'required|in_list[Licenciatura,Especialidad,Maestria,Doctorado]',
            'Carrera'           => 'required|max_length[255]|min_length[3]',
            'Nombre_C'          => 'required|max_length[255]|min_length[3]',
            'Siglas'            => 'required|max_length[255]|min_length[3]',
        ]);

        if (! $sonValidos) {
            return view('templates/header', $data)
                . view('Actualizacion/usuario/usuario_grado')
                . view('templates/footer');
        }

        $model =  model(UsuarioModel::class);

        $usuario = new UsuarioEntity();
        $usuario->Nivel             = $post['Nivel'];
        $usuario->Carrera           = $post['Carrera'];
        $usuario->Nombre            = $post['Nombre_C'];
        $usuario->Siglas            = $post['Siglas'];
        $model->changeGrado($id, $id_organigrama);

        return $this->response->redirect(url_to('\\' . Usuario::class . '::showAll'));
    }
}
