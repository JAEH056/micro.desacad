<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\AlumnoModel;
use App\Entities\Tutorias\Alumno as AlumnoEntity;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Alumno extends BaseController
{

    private $alumnoM;
    public function __construct()
    {
        $this->alumnoM = new AlumnoModel();
    }
    public function index()
    {
        // ...
    }

    /**
     * Muestra una lista de alumnos en tutorias
     * @return ResponseInterface
     */
    public function showAlumnos(): ResponseInterface
    {
        $alumnos = $this->alumnoM->findAlumn();

        $data = [
            'title' => 'Alumnos',
            'alumnos' => $alumnos,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/alumnos/alumno_ver')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }


    /**
     * Muestra la vista de crear alumno
     * @return ResponseInterface
     */
    public function showCrearAlumno(): ResponseInterface
    {
        helper('form');
        $data = [
            'title' => 'Crear nuevo alumno'
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/alumnos/alumnos_crear')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Crea un nuevo alumno
     * @return RedirectResponse
     */
    public function crearAlumno(): RedirectResponse
    {
        helper('form');

        $post = $this->request->getPost(['Id', 'Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Nc', 'Sexo']);

        $sonValidos = $this->validateData($post, [
            'Nombre'            => 'required|max_length[255]|min_length[3]',
            'Primer_Apellido'   => 'required|max_length[255]|min_length[3]',
            'Segundo_Apellido'  => 'required|max_length[255]|min_length[3]',
            'Curp'              => 'required|max_length[19]',
            'Nc'                => 'required|max_length[9]',
            'Sexo'              => 'required|in_list[H,M]',
        ]);

        if (! $sonValidos) {
            return redirect()->to(url_to('\\' . self::class . '::showCrearAlumno'))->withInput()->with('error', $this->validator->getErrors());
        }

        $alumno = new AlumnoEntity();
        $alumno->Nombre            = $post['Nombre'];
        $alumno->Primer_Apellido   = $post['Primer_Apellido'];
        $alumno->Segundo_Apellido  = $post['Segundo_Apellido'];
        $alumno->Curp              = $post['Curp'];
        $alumno->Nc                = $post['Nc'];
        $alumno->Sexo              = $post['Sexo'];

        $this->alumnoM->save($alumno);

        return redirect()->to(url_to('\\' . self::class . '::showAlumnos'))->with('mensaje', 'Alumno creado con exito.');
    }
}
