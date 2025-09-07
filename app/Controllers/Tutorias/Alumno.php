<?php
namespace App\Controllers\Tutorias;

use CodeIgniter\Controller;
use App\Controllers\BaseController;

use App\Models\Tutorias\TutoradoModel;
use App\Entities\Tutorias\Tutorado as TutoradoEntity;
use App\Models\Tutorias\AlumnoModel;
use App\Entities\Tutorias\Alumno as AlumnoEntity;

use CodeIgniter\Exceptions\PageNotFoundException;

class Alumno extends BaseController {

    public function showAlumnos(){
        $model = model(AlumnoModel::class);

        $alumnos = $model->findAlumn();

        $data = [
            'title' => 'Alumnos',
            'alumnos' => $alumnos,
       ];

        return view('templates/header', $data)
            . view('Tutorias/alumnos/alumno_ver', $data)
            . view('templates/footer');
    }

    public function crearAlumno()
    {
        helper('form');

        $data = [
            'title' => 'Crear un nuevo alumno'
        ];
        
        if($this->request->is('get')){
            return view('templates/header', $data)
        .        view('Tutorias/alumnos/alumnos_crear', $data)
        .        view('templates/footer');
        }

        $post= $this->request->getPost(['Id', 'Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Nc', 'Sexo']);

        $sonValidos = $this->validateData($post, [
            'Nombre'            => 'required|max_length[255]|min_length[3]',
            'Primer_Apellido'   => 'required|max_length[255]|min_length[3]',
            'Segundo_Apellido'  => 'required|max_length[255]|min_length[3]',
            'Curp'              => 'required|max_length[19]',
            'Nc'                => 'required|max_length[9]',
            'Sexo'              => 'required|in_list[H,M]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/alumnos/alumnos_crear')
                . view('templates/footer');
        }

        $model =  model(AlumnoModel::class);

        $alumno = new AlumnoEntity();
        $alumno->Nombre            = $post['Nombre'];
        $alumno->Primer_Apellido   = $post['Primer_Apellido'];
        $alumno->Segundo_Apellido  = $post['Segundo_Apellido'];
        $alumno->Curp              = $post['Curp'];
        $alumno->Nc                = $post['Nc'];
        $alumno->Sexo              = $post['Sexo'];

        $model->save($alumno);

        return $this->response->redirect(url_to('\\' . Alumno::class .'::showAlumnos'));

    }
    
}