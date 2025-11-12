<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\GrupoModel;
use App\Models\Tutorias\PeriodoModel;
use App\Models\Tutorias\TutoradoModel;
use App\Entities\Tutorias\Grupo as GrupoEntity;
use CodeIgniter\HTTP\ResponseInterface;

class Grupo extends BaseController
{
    private $periodo;
    private $tutorado;
    private $grupo;
    private $grupoEntity;

    public function __construct()
    {
        $this->periodo = new PeriodoModel();
        $this->tutorado = new TutoradoModel();
        $this->grupo = new GrupoModel();
        $this->grupoEntity = new GrupoEntity();
    }
    public function index()
    {
        //
    }

    public function showGrupos(int $id): ResponseInterface
    {
        $grupos = $this->tutorado->findGrupo($id);

        $data = [
            'title' => 'Grupos activos',
            'grupos' => $grupos,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_grupos')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Muestra el menu principal de los tutorados
     * @param int $id ID Usuario (Tutor)
     * @param int $id_grupo ID Grupo (del Tutorado)
     * @return string
     */
    public function gruposMenu(int $id, int $id_grupo): ResponseInterface
    {
        $tutorados = $this->tutorado->findTutorado($id_grupo);
        $grupo     = $this->tutorado->grupoAlum($id);

        $data = [
            'title' => 'Tutorados',
            'grupo'     => $grupo,
            'tutorados' => $tutorados,
            'idGrupo'   => $id_grupo,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_grupos_menu')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Muestra la vista para agregar grupo de tutorias
     * @return ResponseInterface
     */
    public function ShowAddGrupo(): ResponseInterface
    {
        helper('form');
        // Variables
        $nPeriodo  = [];
        $nTutor  = [];
        $nEducativo = [];

        $periodo = $this->periodo->findPeriodo();
        foreach ($periodo as $p) {
            $nperiodo[$p->Id] = $p->Nombre;
        }

        $tutor = $this->tutorado->findTutores();
        foreach ($tutor as $t) {
            $ntutor[$t->Id] = $t->Tutor;
        }

        $programa = $this->tutorado->findEducativo();
        foreach ($programa as $e) {
            $neducativo[$e->Id] = $e->Nombre;
        }
        $data = [
            'title'        => 'Crear Nuevo Grupo',
            'periodo'      => $nperiodo,
            'tutor'        => $ntutor,
            'programa'     => $neducativo,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/grupo/grupo_agregar')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Crea un nuevo grupo de tutorias
     * @return ResponseInterface
     */
    public function addGrupo(): ResponseInterface
    {
        helper('form');
        $post = $this->request->getPost(['Id_Periodo', 'Id_Tutor', 'Nombre', 'Id_Programa', 'Fecha', 'Semestre']);

        $sonValidos = $this->validateData($post, [
            'Id_Periodo'    => 'required|numeric',
            'Id_Tutor'      => 'required|numeric',
            'Id_Programa'   => 'required|numeric',
            'Fecha'         => 'required|valid_date',
            'Semestre'      => 'required|max_length[255]|min_length[3]',
            'Nombre'        => 'required|max_length[255]'
        ]);

        if (! $sonValidos) {
            return redirect()->to(url_to('\\' . self::class . '::ShowAddGrupo'))->with('error', $this->validator->getErrors());
        }

        $grupoE = $this->grupoEntity;
        $grupoE->Id_Periodo        = $post['Id_Periodo'];
        $grupoE->Id_Tutor          = $post['Id_Tutor'];
        $grupoE->Id_Programa       = $post['Id_Programa'];
        $grupoE->Fecha             = $post['Fecha'];
        $grupoE->Semestre          = $post['Semestre'];
        $grupoE->Nombre            = $post['Nombre'];

        $this->grupo->insert($grupoE);

        return redirect()->to(url_to('\\' . self::class . '::ShowAddGrupo'))->with('mensaje', 'Grupo creado con exito.');
    }
}
