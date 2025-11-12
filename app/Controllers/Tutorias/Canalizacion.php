<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\CanalizacionModel;
use App\Models\Tutorias\IndividualModel;
use App\Models\Tutorias\TutoradoModel;
use App\Entities\Tutorias\Canalizacion as CanalizacionEntity;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class Canalizacion extends BaseController
{
    private $tutoradoM;
    private $individualM;
    private $canalizacionM;
    private $canalizacionEntity;

    public function __construct()
    {
        $this->tutoradoM = new TutoradoModel();
        $this->individualM = new IndividualModel();
        $this->canalizacionM = new CanalizacionModel();
        $this->canalizacionEntity = new CanalizacionEntity();
    }
    public function index()
    {
        //
    }

    /**
     * Muestra la lista de canalizaciones individuales
     * @param int $id
     * @param int $id_grupo
     * @return ResponseInterface
     */
    public function showIndividuales(int $id, int $id_grupo): ResponseInterface
    {
        $canalizaciones = $this->tutoradoM->tutoradosIndividualesRev1($id, $id_grupo);

        $data = [
            'title'          => 'Tutorados',
            'canalizaciones' => $canalizaciones,
            'ID_Grupo'       => $id_grupo,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorados_canalizacion')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Muestra la vista para agregar una canalizacion individual
     * @param int $id_grupo
     * @return ResponseInterface
     */
    public function showAddIndividual(int $id_grupo): ResponseInterface
    {
        $usuario = session_get('usuario');
        $tutorado   = $this->individualM->tutoradosSelect($usuario->Id);
        $ntutorado  = [];
        foreach ($tutorado as $t) {
            $ntutorado[$t->Id_Tutorado] = $t->Alumno;
        }
        $data = [
            'title'        => 'Agregar almuno a tutoría individual',
            'tutorado'     => $ntutorado,
            'grupo'        => $id_grupo,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_agregarIndividual')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Agrega una nueva canalizacion individual
     * @param int $id_grupo
     * @return ResponseInterface
     */
    public function addIndividual(int $id_grupo): ResponseInterface
    {
        helper('form');
        $usuario = session_get('usuario');

        $post = $this->request->getPost(['Id_Tutorado', 'Horas', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'Id_Tutorado'   => 'required|numeric',
            'Horas'         => 'required|numeric',
            'Fecha'         => 'required|valid_date',
        ]);

        if (! $sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Canalizacion::class . '::showAddIndividual', $id_grupo));
        }

        $tutoria = $this->canalizacionEntity;
        $tutoria->Id_Tutorado   = $post['Id_Tutorado'];
        $tutoria->Horas         = $post['Horas'];
        $tutoria->Fecha         = $post['Fecha'];

        $this->individualM->insert($tutoria);
        return $this->response->redirect(url_to('\\' . Canalizacion::class . '::showCanalizacion', $usuario->Id, $id_grupo));
    }

    /**
     * Muestra los grupos de canalizaciones
     * @param int $id ID Tutor
     * @param int $id_grupo
     * @throws PageNotFoundException
     * @return ResponseInterface
     */
    public function showCanalizacion(int $id, int $id_grupo): ResponseInterface
    {
        $canalizaciones = $this->tutoradoM->tutoradosIndividualesRev1($id, $id_grupo);

        $data = [
            'title'          => 'Tutoria Individual',
            'canalizaciones' => $canalizaciones,
            'ID_Grupo'       => $id_grupo,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorados_canalizacion')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Menu para agregar un tutorado a un grupo de canalizacion
     * @param int $idAlumno
     * @param int $idGrupo
     * @return ResponseInterface
     */
    public function showAddCanalizacion(int $idAlumno, int $idGrupo): ResponseInterface
    {
        $tutoria = $this->tutoradoM->tutoradosTutoria($idAlumno, $idGrupo);

        $departamento   = $this->canalizacionM->findDepartamento();
        $ndepartamento  = [];

        foreach ($departamento as $d) {
            $ndepartamento[$d->Id] = $d->Nombre;
        }

        $data = [
            'title'        => 'Crear un nueva canalización',
            'tutoria'      => $tutoria,
            'Id_Alumno'    => $idAlumno,
            'Id_Grupo'      => $idGrupo,
            'departamento' => $ndepartamento,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_canalizacion_add')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Agrega un tutorado a un grupo de canalizacion
     * @param int $idAlumno
     * @param int $idGrupo
     * @return ResponseInterface|string
     */
    public function addCanalizacion(int $idAlumno, int $idGrupo)
    {

        helper('form');
        $post = $this->request->getPost(['Id_Departamento', 'Id_Tutoria', 'Fecha', 'Diagnostico', 'Actividades']);
        $usuario = session_get('usuario');

        $sonValidos = $this->validateData($post, [
            'Id_Departamento'    => 'required|numeric',
            'Id_Tutoria'         => 'required|numeric',
            'Fecha'              => 'required|valid_date',
            'Diagnostico'        => 'required|max_length[255]|min_length[3]',
            'Actividades'        => 'required|max_length[255]|min_length[3]',

        ]);

        if (!$sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Canalizacion::class . '::showAddCanalizacion', $usuario->Id, $idGrupo));
        }

        $tutoria = $this->canalizacionEntity;
        $tutoria->Id_Departamento   = $post['Id_Departamento'];
        $tutoria->Id_Tutoria        = $post['Id_Tutoria'];
        $tutoria->Fecha             = $post['Fecha'];
        $tutoria->Diagnostico       = $post['Diagnostico'];
        $tutoria->Actividades       = $post['Actividades'];

        if (!$this->canalizacionM->save($tutoria)) {
            session()->setFlashdata('error', 'Error a guardar los datos de la canalizacion.');
            return $this->response->redirect(url_to('\\' . Canalizacion::class . '::showAddCanalizacion', $usuario->Id, $idGrupo));
        }

        session()->setFlashdata('mensaje', 'Canalizacion guardada exitosamente.');
        return $this->response->redirect(url_to('\\' . Canalizacion::class . '::alumnoCanalizacion', $idAlumno, $idGrupo));
    }

    /**
     * Muestra los tutorados canalizados por el tutor
     * @param int $idAlumno
     * @param int $idGrupo
     * @return ResponseInterface
     */
    public function alumnoCanalizacion(int $idAlumno, int $idGrupo): ResponseInterface
    {
        $canalizacion = $this->tutoradoM->canalizacionAlumno($idAlumno, $idGrupo);
        $tutoria = $this->tutoradoM->tutoria($idAlumno, $idGrupo);

        $data = [
            'title'             => 'Canalizaciones del alumno',
            'canalizacion'      => $canalizacion,
            'tutoria'           => $tutoria,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_canalizaciones')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }
}
