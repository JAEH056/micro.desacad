<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\TutorModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Tutor extends BaseController
{
    private $tutorM;

    public function __construct()
    {
        $this->tutorM = new TutorModel();
    }
    public function index()
    {
        //
    }

    /**
     * Muestra la lista de tutores creados
     * @return string
     */
    public function showListaTutores(): ResponseInterface
    {
        $tutores = $this->tutorM->findTutores();

        $data = [
            'title' => 'Lista de Tutores',
            'tutores' => $tutores,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_tutores')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Muestra la vista para crear un nuevo tutor
     * @return ResponseInterface|string
     */
    public function showCreateTutor(): ResponseInterface
    {
        $usuario   = $this->tutorM->findUsuarios();
        $nusuario  = [];
        foreach ($usuario as $u) {
            $nusuario[$u->Id_Usuario] = $u->Nombre;
        }
        $data = [
            'title'   => 'Agregar Tutor',
            'usuario' => $nusuario,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_agregar')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Obtiene los datos del formulario para crear un nuevo tutor
     * @return RedirectResponse
     */
    public function createTutor(): RedirectResponse
    {
        helper('form');

        $post = $this->request->getPost(['Id', 'Id_Usuario', 'Inicia', 'Termina']);
        $sonValidos = $this->validateData($post, [
            'Id_Usuario'   => 'required|numeric',
            'Inicia'       => 'required|valid_date',
            'Termina'      => 'valid_date',
        ]);

        if (! $sonValidos) {
            return redirect()->to(url_to('\\' . self::class . '::showCreateTutor'))->with('error', $this->validator->getErrors());
        }

        $tutor = new \App\Entities\Tutorias\Tutor();
        $tutor->Id_Usuario   = $post['Id_Usuario'];
        $tutor->Inicia       = $post['Inicia'];
        $tutor->Termina      = $post['Termina'];

        $this->tutorM->save($tutor);

        return redirect()->to(url_to('\\' . self::class . '::showListaTutores'))->with('mensaje', 'Tutor creado con exito.');
    }
}
