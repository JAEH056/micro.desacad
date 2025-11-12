<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\PeriodoModel;
use App\Entities\Tutorias\Periodo as PeriodoEntity;
use CodeIgniter\HTTP\ResponseInterface;

class Periodo extends BaseController
{
    private $periodoM;
    public function __construct()
    {
        $this->periodoM = new PeriodoModel();
    }
    public function index()
    {
        //...
    }

    /**
     * Muestra la lista de periodos creados
     * @return ResponseInterface
     */
    public function showPeriodos(): ResponseInterface
    {
        $periodos = $this->periodoM->findPeriodo();

        $data = [
            'title' => 'Periodos',
            'periodos' => $periodos,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/periodo/periodo_ver')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Formulario para crear un nuevo periodo
     * @return ResponseInterface
     */
    public function showAddPeriodo(): ResponseInterface
    {
        helper('form');

        $data = [
            'title' => 'Crear un nuevo periodo'
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/periodo/periodo_crear')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Agrega un nuevo periodo
     * @return ResponseInterface
     */
    public function addPeriodo(): ResponseInterface
    {
        helper('form');

        $post = $this->request->getPost(['Nombre', 'Inicia', 'Termina']);

        $sonValidos = $this->validateData($post, [
            'Nombre'   => 'required|max_length[255]|min_length[3]',
            'Inicia'   => 'required|valid_date',
            'Termina'  => 'required|valid_date',
        ]);

        if (! $sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Periodo::class . '::showAddPeriodo'));
        }

        $periodo = new PeriodoEntity();
        $periodo->Nombre   = $post['Nombre'];
        $periodo->Inicia   = $post['Inicia'];
        $periodo->Termina  = $post['Termina'];

        $this->periodoM->save($periodo);

        session()->setFlashdata('mensaje', 'Periodo creado correctamente.');
        return $this->response->redirect(url_to('\\' . Periodo::class . '::showPeriodos'));
    }

    /**
     * Actualiza los datos de un periodo existente
     * @param int $id
     * @return ResponseInterface
     */
    public function updatePeriodo(int $id = 0): ResponseInterface
    {
        $data = [
            'title'  => 'Actualiza las fechas',
            'periodo'  => $this->periodoM->get($id),
        ];

        if ($this->request->is('get')) {
            return $this->response
                ->setBody(
                    view('templates/header', $data)
                        . view('Tutorias/periodo/periodo_editar')
                        . view('templates/footer')
                )
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setContentType('text/html');
        }

        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Nombre', 'Inicia', 'Termina']);

        $sonValidos = $this->validateData($post, [
            'Nombre'      => 'required|numeric',
            'Inicia'      => 'required|valid_date',
            'Termina'     => ['valid_date', static function ($value, $data, &$error, $field) {
                if (empty($value)) return true;

                $inicia =  \DateTime::createFromFormat('Y-m-d', $data['Inicia'])->getTimestamp();
                $termina = \DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();

                if ($termina < $inicia) {
                    $error = 'La fecha final no puede ser anterior a la fecha inicial';
                    return false;
                }
                return true;
            }],
        ]);

        if (! $sonValidos) {
            return redirect()->back()->withInput();
        }

        $this->periodoM->update($id, $post);
        return $this->response->redirect(url_to('\\' . Periodo::class . '::showPeriodos'));
    }
}
