<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\TutorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Menu extends BaseController
{
    public function index(): ResponseInterface
    {
        $TutorM = new TutorModel();
        $dataTutor = $TutorM->getTutorId(session()->get('usuario')->Id);
        $data = [
            'title' => 'Menu Principal Tutorias',
            'tutor' => $dataTutor,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/dashboard_TA')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }
}
