<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;

use App\Models\Tutorias\TutoradoModel;
use App\Entities\Tutorias\Tutorado as TutoradoEntity;
use App\Models\Tutorias\ActividadModel;
use App\Models\Tutorias\AlumnoModel;
use App\Models\Tutorias\TutorModel;
use App\Models\Tutorias\TutoriaModel;
use App\Entities\Tutorias\Tutoria as TutoriaEntity;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class Tutorado extends BaseController
{
    private $tutoradoM;
    public function __construct()
    {
        $this->tutoradoM = new TutoradoModel();
    }

    public function showTutores(): ResponseInterface
    {
        $tutorados = $this->tutoradoM->findTutor();

        $data = [
            'title' => 'Lista de Grupos',
            'tutorados' => $tutorados,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_lista')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Vista del formulario para actualizar los datos del tutor
     * @param int $id ID del tutor
     * @return ResponseInterface
     */
    public function showUpdateTutor(int $id = 0): ResponseInterface
    {
        $model = model(TutorModel::class);

        $data = [
            'title'  => 'Actualiza las fechas',
            'tutor'  => $model->get($id),
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutor_editar')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Actualiza los datos del tutor
     * @param int $id ID del tutor
     * @return ResponseInterface
     */
    public function updateTutor(int $id = 0): ResponseInterface
    {

        $model = model(TutorModel::class);

        $id = $this->request->getpost('Id');
        $data = $this->request->getPost(['Id_Usuario', 'Inicia', 'Termina']);

        $sonValidos = $this->validateData($data, [
            'Id_Usuario'  => 'required|numeric',
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
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showUpdateTutor', $id));
        }

        if (!$model->update($id, $data)) {
            session()->setFlashdata('error', 'Error en el proceso de actualizar los datos del tutor.');
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showUpdateTutor', $id));
        }

        session()->setFlashdata('mensaje', 'Datos actualizados correctamente.');
        return $this->response->redirect(url_to('\\' . Tutor::class . '::showListaTutores'));
    }

    /**
     * Muestra las tutorias del asesor
     * @param int $id_grupo ID grupo asesor
     * @return ResponseInterface
     */
    public function showTutorias(int $id_grupo): ResponseInterface
    {
        $model = model(TutoriaModel::class);
        $tutorias = $model->findTutorias($id_grupo);
        $grupo      = $this->tutoradoM->grupoIdTutoria($id_grupo);

        $data = [
            'title' => 'Tutorias del Grupo',
            'tutorias' => $tutorias,
            'grupo'     => $grupo,
            'ID_Grupo_A' => $id_grupo, //Grupo del asesor
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_mostrar')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * MUestra el formulario para crear una nueva tutoria
     * @param int $idGrupo
     * @return ResponseInterface
     */
    public function showCreateTutoria(int $idGrupo): ResponseInterface
    {
        $grupo = $this->tutoradoM->grupoId($idGrupo);

        $amodel       = model(ActividadModel::class);
        $actividad    = $amodel->findActividad();
        $nactividad = [];
        foreach ($actividad as $a) {
            $nactividad[$a->Id] = $a->Descripcion;
        }

        $data = [
            'title'        => 'Crear una nueva tutoría',
            'actividad'    => $nactividad,
            'grupo'        => $grupo,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_crear')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Crea una nueva tutoria
     * @param int $idGrupo
     * @return ResponseInterface|string
     */
    public function createTutoria(int $idGrupo)
    {

        helper('form');
        $post = $this->request->getPost(['Id_Grupo', 'Id_Actividades', 'Horas', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'Id_Grupo'       => 'required|numeric',
            'Id_Actividades' => 'required|numeric',
            'Horas'          => 'required|numeric',
            'Fecha'          => 'required|valid_date',
        ]);

        if (! $sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showCreateTutoria', $idGrupo));
        }

        $model =  model(TutoriaModel::class);

        $tutoria = new TutoriaEntity();
        $tutoria->Id_Grupo        = $post['Id_Grupo'];
        $tutoria->Id_Actividades  = $post['Id_Actividades'];
        $tutoria->Horas           = $post['Horas'];
        $tutoria->Fecha           = $post['Fecha'];

        if (!$model->save($tutoria)) {
            session()->setFlashdata('error', ['error' => 'Error en el proceso de crear la tutoria.']);
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showCreateTutoria', $idGrupo));
        }
        session()->setFlashdata('mensaje', 'Tutoria creada exitosmente.');
        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutorias', $idGrupo));
    }

    public function showAddTutorados(int $idGrupo): ResponseInterface
    {
        $grupo = $this->tutoradoM->grupoId($idGrupo);

        $amodel  = model(AlumnoModel::class);
        $alumnos = $amodel->findAlumn();

        $data = [
            'title' => 'Agregar Alumnos',
            'alumnos'   => $alumnos,
            'grupo'     => $grupo,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_addTutorados')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    public function addTutorados(int $idGrupo): ResponseInterface
    {
        helper('form');

        $post   = $this->request->getPost(['Id_Grupo', 'alumnos']);

        $sonValidos = $this->validateData($post, [
            'Id_Grupo'     => 'required|numeric', // Campo oculto
        ]);

        if (! $sonValidos) {
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showAddTutorados', $idGrupo));
        }

        $this->tutoradoM->guardarTutorados(
            $post['Id_Grupo'],
            $post['alumnos'],
        );

        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutores'));
    }

    public function showTutorados(int $id_grupo): ResponseInterface
    {
        $tutorados = $this->tutoradoM->findTutorado($id_grupo);
        $grupo     = $this->tutoradoM->grupoId($id_grupo);

        $amodel = model(AlumnoModel::class);
        $alumno = $amodel->findAlumn();
        $nalumno = [];
        foreach ($alumno as $a) {
            $nalumno[$a->Id] = $a->Nombre;
        }

        $data = [
            'title' => 'Lista de Tutorados',
            'tutorados' => $tutorados,
            'grupo'     => $grupo,
            'alumno'    => $nalumno,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_tutorados')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    public function addTutorado(): ResponseInterface
    {
        $post = $this->request->getPost(['Id_Alumno', 'Id_Grupo']);

        $sonValidos = $this->validateData($post, [
            'Id_Alumno'    => 'required|numeric',
            'Id_Grupo'     => 'required|numeric',
        ]);

        if (!$sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutorados', $post['Id_Grupo']));
        }

        $tutorado = new TutoradoEntity();
        $tutorado->Id_Alumno   = $post['Id_Alumno'];
        $tutorado->Id_Grupo    = $post['Id_Grupo'];

        $this->tutoradoM->save($tutorado);

        session()->setFlashdata('mensaje', 'Alumno agregado correctamente.');
        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutorados', $post['Id_Grupo']));
    }

    public function dataTutor(int $id)
    {
        $tutor = $this->tutoradoM->dataTutor($id);

        $data = [
            'title' => 'Tutorados',
            'tutor' => $tutor,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_tutor')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    public function findTutorados(int $id): ResponseInterface
    {
        $tutorados = $this->tutoradoM->findTutorados($id);
        $grupo     = $this->tutoradoM->grupoAlum($id);

        if (empty($tutorados)) {
            throw new PageNotFoundException('No se encontro un grupo' . $id);
        }

        $data = [
            'title' => 'Tutorados',
            'grupo'     => $grupo,
            'tutorados' => $tutorados,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_participantes')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    ///ELIMINAR
    public function findTutoria(int $idGrupo): ResponseInterface
    {
        $model     = model(TutoriaModel::class);
        $tutoria = $model->showTutorias($idGrupo);

        $data = [
            'title'   => 'Tutorias',
            'tutoria' =>  $tutoria,
        ];

        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_tutorias')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    public function tutoradosTutor(int $id, int $id_grupo): ResponseInterface
    {
        $tutorados = $this->tutoradoM->grupoId($id_grupo);

        $amodel     = model(AlumnoModel::class);
        $alumno     = $amodel->findAlumn();
        $nalumno    = [];
        foreach ($alumno as $a) {
            $nalumno[$a->Id] = $a->Nombre;
        }

        $data = [
            'title'     => 'Tutorados',
            'tutorados' => $tutorados,
            'alumno'    => $nalumno,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutorado_tutorados')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Muestra las asistencias del grupo
     * @param int $id ID Tutoria Grupal
     * @return ResponseInterface
     */
    public function showTutoriaAsistencia(int $id): ResponseInterface
    {
        $model = model(TutoriaModel::class);

        $tutoria = $model->findTutoria($id);
        $tgrupal = $model->tutoriaGrupal($id);


        $asistencia = $this->tutoradoM->showAsistencia($id);

        $data = [
            'title' => 'Asistencia Alumnos',
            'tutoria'   => $tutoria,
            'tgrupal'   => $tgrupal,
            'listaAsistencia' => $asistencia,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_asistencia')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Guarda las asistencias del grupo
     * @param int $id ID Tutoria Grupal
     * @return ResponseInterface|string
     */
    public function tutoriaAsistencia(int $id): ResponseInterface
    {
        helper('form');
        $model = model(TutoriaModel::class);
        // Recibiendo datos
        $post   = $this->request->getPost(['Id_Tutoria', 'alumnos', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'Id_Tutoria'   => 'required|numeric', // Campo oculto
            'alumnos'      => 'required',
            'Fecha'        => 'required|valid_date',
        ]);

        if (! $sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutoriaAsistencia', $id));
        }

        if (!$model->guardarTutorados(
            $post['Id_Tutoria'],
            $post['alumnos'],
            $post['Fecha'],
        )) {
            session()->setFlashdata('error', ['error' => 'Error en el proceso de guardar la asistencia.']);
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutoriaAsistencia', $id));
        }

        session()->setFlashdata('mensaje', 'Asistencia del grupo guardada correctamente.');
        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showTutoriaAsistencia', $id));
    }

    /**
     * Muestra la vista de los alumnos acreditados
     * @param int $id ID Tutoria Grupal
     * @return ResponseInterface
     */
    public function showAlumAcreditado(int $id): ResponseInterface
    {
        helper('form');
        $model = model(TutoriaModel::class);

        $tuto = $model->tutoriaGrupal($id);
        $tutoria = $model->findTutoria($id);
        $acreditados = $this->tutoradoM->showAcreditados($id);

        $data = [
            'title'     => 'Acreditar Alumnos',
            'tutoria'   => $tutoria,
            'listaAcreditados' => $acreditados,
            'tuto'      => $tuto,
        ];
        return $this->response
            ->setBody(
                view('templates/header', $data)
                    . view('Tutorias/tutorado/tutoria_acreditar')
                    . view('templates/footer')
            )
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType('text/html');
    }

    /**
     * Funcion para acreditar grupos o alumno
     * @param int $id ID Tutoria Grupal
     * @return ResponseInterface
     */
    public function alumAcreditado(int $id): ResponseInterface
    {
        helper('form');
        $model = model(TutoriaModel::class);

        $post = $this->request->getPost(['alumnos', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'alumnos'      => 'required',
            'Fecha'        => 'required|valid_date',
        ]);

        if (! $sonValidos) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showAlumAcreditado', $id));
        }
        if (!$model->guardarAcreditados(
            $post['alumnos'],
            $post['Fecha'],
        )) {
            session()->setFlashdata('error', 'Error en el proceso de guardar acreditados.');
            return $this->response->redirect(url_to('\\' . Tutorado::class . '::showAlumAcreditado', $id));
        }
        session()->setFlashdata('mensaje', 'Acreditacion guardada correctamente.');
        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showAlumAcreditado', $id));
    }
}
