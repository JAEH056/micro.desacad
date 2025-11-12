<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\ActividadModel;
use App\Entities\Tutorias\Actividad as ActividadEntity;
use CodeIgniter\HTTP\ResponseInterface;

class Actividad extends BaseController
{
    private $actividadM;
    private $actividadEntity;
    public function __construct()
    {
        $this->actividadM = new ActividadModel();
        $this->actividadEntity = new ActividadEntity();
    }
    public function index()
    {
        //
    }

    /**
     * Muestra las actividades creadas
     * @return ResponseInterface
     */
    public function showActividad(): ResponseInterface
    {
        $actividades = $this->actividadM->find();

        $data = [
            'title' => 'Actividades',
            'actividades' => $actividades,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/actividades/actividades_crear')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Crea una nueva actividad
     * @return ResponseInterface
     */
    public function crearActividad(): ResponseInterface
    {
        $actividades = $this->actividadM->find();
        helper('form');

        $data = [
            'title' => 'Agrega una nueva actividad',
            'actividades' => $actividades,
        ];

        $post = $this->request->getPost(['Descripcion']);

        $sonValidos = $this->validateData($post, [
            'Descripcion' => 'required|required|max_length[255]|min_length[3]',
        ]);

        if (! $sonValidos) {
            return redirect()->to(url_to('\\' . self::class . '::showActividad'))->withInput()->with('error', $this->validator->getError('Descripcion'));
        }

        $actividad = $this->actividadEntity;
        $actividad->Descripcion = $post['Descripcion'];

        $this->actividadM->save($actividad);

        return redirect()->to(url_to('\\' . Actividad::class . '::showActividad'))->with('mensaje', 'Actividad creada correctamente.');
    }


    /**
     * Elimina una actividad en especifico
     * @param int $id
     * @return ResponseInterface
     */
    public function delateActividad(int $id): ResponseInterface
    {
        $this->actividadM->delete($id);
        session()->setFlashdata('mensaje', 'Actividad eliminada correctamente.');
        return $this->response->redirect(url_to('\\' . Actividad::class . '::showActividad'));
    }
}
