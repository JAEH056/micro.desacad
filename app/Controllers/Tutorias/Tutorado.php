<?php
namespace App\Controllers\Tutorias;

use CodeIgniter\Controller;
use App\Controllers\BaseController;

use App\Models\Tutorias\TutoradoModel;
use App\Entities\Tutorias\Tutorado as TutoradoEntity;
use App\Models\Tutorias\ActividadModel;
use App\Entities\Tutorias\Actividad as ActividadEntity;
use App\Models\Tutorias\AlumnoModel;
use App\Entities\Tutorias\Alumno as AlumnoEntity;
use App\Models\Tutorias\PeriodoModel;
use App\Entities\Tutorias\Periodo as PeriodoEntity;
use App\Models\Tutorias\CanalizacionModel;
use App\Entities\Tutorias\Canalizacion as CanalizacionEntity;
use App\Models\Tutorias\IndividualModel;
use App\Entities\Tutorias\Individual as IndividualEntity;
use App\Models\Tutorias\GrupoModel;
use App\Entities\Tutorias\Grupo as GrupoEntity;
use App\Models\Tutorias\TutorModel;
use App\Entities\Tutorias\Tutor as TutorEntity;
use App\Models\Tutorias\TutoriaModel;
use App\Entities\Tutorias\Tutoria as TutoriaEntity;
use App\Models\Tutorias\DepartamentoModel;
use App\Entities\Tutorias\Departamento as DepartamentoEntity;
use Dompdf\Dompdf;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tutorado extends BaseController {

    public function showTutores()
    {
        $model = model(TutoradoModel::class);

        $tutorados = $model->findTutor();

        $data = [
            'title' => 'Tutores',
            'tutorados' => $tutorados,
       ];

        return view('templates/header', $data)
            . view('Tutorias/tutorado/tutorado_lista', $data)
            . view('templates/footer');
    }

    public function tutores(){
        $model = model(TutorModel::class);

        $tutores = $model->findTutores();

        $data = [
            'title' => 'Tutorados',
            'tutores' => $tutores,
       ];

        return view('templates/header', $data)
            . view('Tutorias/tutorado/tutorado_tutores', $data)
            . view('templates/footer');
    }

    public function updateTutor(int $id=0){

        $model = model(TutorModel::class);

        $data = [
            'title'  => 'Actualiza las fechas',
            'tutor'  => $model->get($id),
        ];

        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/tutorado/tutor_editar')
		        . view('templates/footer');
        }

        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Id_Usuario', 'Inicia', 'Termina']);
        
        $sonValidos = $this->validateData($post, [
            'Id_Usuario'  => 'required|numeric',
            'Inicia'      => 'required|valid_date',
            'Termina'     => ['valid_date', static function ($value, $data, &$error, $field) {
                if( empty($value) ) return true;

                $inicia =  \DateTime::createFromFormat('Y-m-d', $data['Inicia'])->getTimestamp();
                $termina = \DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();

                if( $termina < $inicia){
                    $error = 'La fecha final no puede ser anterior a la fecha inicial';
                    return false;
                }
                return true;
            }],
        ]);

        if (! $sonValidos ) {
            return redirect()->back()->withInput();
        }
    
        $model->update($id, $post);
        return $this->response->redirect(url_to('\\' .Tutorado::class .'::tutor'));
    }

    public function showTutorias(int $id, int $id_grupo){
        $model = model(TutoriaModel::class);
        $tutorias = $model->findTutorias($id_grupo);
        $gmodel     = model(TutoradoModel::class);
        $grupo      = $gmodel->grupoId($id_grupo);

        $data = [
            'title' => 'Tutorias del grupo',
            'tutorias' => $tutorias,
            'grupo'     => $grupo,
       ];
       return view('templates/header', $data)
            . view('Tutorias/tutorado/tutoria_mostrar', $data)
            . view('templates/footer');
    }

    public function createTutoria(int $idGrupo){

        $model = model(TutoradoModel::class);
        $grupo = $model->grupoId($idGrupo);

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
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/tutorado/tutoria_crear')
		        . view('templates/footer');
        }
        helper('form');
        $post = $this->request->getPost(['Id_Grupo', 'Id_Actividades', 'Horas', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'Id_Grupo'       => 'required|numeric',
            'Id_Actividades' => 'required|numeric',
            'Horas'          => 'required|numeric',
            'Fecha'          => 'required|valid_date',    
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/tutorado/tutoria_crear')
                . view('templates/footer');
        }
        
        $model =  model(TutoriaModel::class);
        
        $tutoria = new TutoriaEntity();
        $tutoria->Id_Grupo        = $post['Id_Grupo'];
        $tutoria->Id_Actividades  = $post['Id_Actividades'];
        $tutoria->Horas           = $post['Horas'];
        $tutoria->Fecha           = $post['Fecha'];
      
        $model->save($tutoria);
        $usuario = session_get('usuario');
        $id_grupo = $post['Id_Grupo'];
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showTutorias', $usuario->Id, $id_grupo));
        
    }
    public function addGrupo(){
        $pmodel    = model(PeriodoModel::class);
        $periodo   = $pmodel->findPeriodo();
        $nPeriodo  = [];
        foreach ($periodo as $p) {
            $nperiodo[$p->Id] = $p->Nombre;
        }

        $tmodel    = model(TutoradoModel::class);
        $tutor   = $tmodel->findTutores();
        $nTutor  = [];
        foreach ($tutor as $t) {
            $ntutor[$t->Id] = $t->Tutor;
        }

        $emodel     = model(TutoradoModel::class);
        $programa  = $emodel->findEducativo();
        $nEducativo = [];
        foreach ($programa as $e) {
            $neducativo[$e->Id] = $e->Nombre;
        }

        $data = [
            'title'        => 'Crear un nueva canalización',
            'periodo'      => $nperiodo,
            'tutor'        => $ntutor,
            'programa'     => $neducativo,
        ];
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/grupo/grupo_agregar')
		        . view('templates/footer');
        }
        helper('form');
        $post = $this->request->getPost(['Id_Periodo', 'Id_Tutor', 'Id_Programa', 'Fecha', 'Semestre']);

        $sonValidos = $this->validateData($post, [
            'Id_Periodo'    => 'required|numeric',
            'Id_Tutor'      => 'required|numeric',
            'Id_Programa'   => 'required|numeric',
            'Fecha'         => 'required|valid_date',
            'Semestre'      => 'required|max_length[255]|min_length[3]',
            
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/grupo/grupo_agregar')
                . view('templates/footer');
        }
        
        $model =  model(GrupoModel::class);
        
        $grupo = new GrupoEntity();
        $grupo->Id_Periodo        = $post['Id_Periodo'];
        $grupo->Id_Tutor          = $post['Id_Tutor'];
        $grupo->Id_Programa       = $post['Id_Programa'];
        $grupo->Fecha             = $post['Fecha'];
        $grupo->Semestre          = $post['Semestre'];

        
        $idGrupo = $model->insert($grupo);
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::addTutorados', $idGrupo));
        
    }

    public function addTutorados(int $idGrupo){
        helper('form');

        $model = model(TutoradoModel::class);
        $grupo = $model->grupoId($idGrupo);

        $amodel  = model(AlumnoModel::class);
        $alumnos = $amodel->findAlumn();

        $data = [
            'title' => 'Agregar Alumnos',
            'alumnos'   => $alumnos, 
            'grupo'     => $grupo,       
        ];
        if($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Tutorias/tutorado/tutorado_addTutorados')
                . view('templates/footer');
        }
        $tutorados = $model->showTutorados();
        // Recibiendo datos
        $post   = $this->request->getPost(['Id_Grupo', 'alumnos']);
       //var_dump($post);
       //die;
       
        $sonValidos = $this->validateData($post, [
            'Id_Grupo'     => 'required|numeric', // Campo oculto
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_addTutorados', $data)
        . view('templates/footer');
        }
        //var_dump($post);
        //die;
        $tutorado  =   $model->guardarTutorados(
            $post['Id_Grupo'],
            $post['alumnos'],
            
        );
        
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showTutores'));

    }

    public function showTutorados(int $id_grupo)
    {
        $model = model(TutoradoModel::class);
        $tutorados = $model->findTutorado($id_grupo);
        $grupo     = $model->grupoId($id_grupo);

        $amodel = model(AlumnoModel::class);
        $alumno = $amodel->findAlumn();
        $nalumno = [];
        foreach ($alumno as $a) {
            $nalumno[$a->Id] = $a->Nombre;
        }

        $data = [
            'title' => 'Tutorados',
            'tutorados' => $tutorados,
            'grupo'     => $grupo,
            'alumno'    => $nalumno,
        ];
        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_tutorados', $data)
        . view('templates/footer');
    }

    public function addTutorado(){
        $post = $this->request->getPost(['Id_Alumno', 'Id_Grupo']);
       
        $sonValidos = $this->validateData($post, [
            'Id_Alumno'    => 'required|numeric',
            'Id_Grupo'     => 'required|numeric',
        ]);

        if (! $sonValidos ) {
            $data = [
                'title'          => 'Agregar Alumnos',
               // 'id_inscripcion' => $id_grupo,
            ];
		    return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_tutorados', $data)
        . view('templates/footer');
        }
        
        $model =  model(TutoradoModel::class);
        
        $tutorado = new TutoradoEntity();
        $tutorado->Id_Alumno   = $post['Id_Alumno'];
        $tutorado->Id_Grupo    = $post['Id_Grupo'];

        $model->save($tutorado);
        $id_grupo = $post['Id_Grupo'];
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showTutorados', $id_grupo));

    }
    
    public function showIndividuales(int $id, int $id_grupo)
    {
        $model          = model(TutoradoModel::class);
        $canalizaciones = $model->tutoradosIndividuales($id, $id_grupo);
        

        $data = [
            'title'          => 'Tutorados',
            'canalizaciones' => $canalizaciones,
        ];
        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorados_canalizacion', $data)
        . view('templates/footer');
    }

    public function dataTutor(int $id){
        $model = model(TutoradoModel::class);

        $tutor = $model->dataTutor($id);

        $data = [
            'title' => 'Tutorados',
            'tutor' => $tutor,
        ];

        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_tutor', $data)
        . view('templates/footer');
    }

    public function findTutorados(int $id)
    {
        $model     = model(TutoradoModel::class);
        $tutorados = $model->findTutorados($id);
        $grupo     = $model->grupoAlum($id);

        if (empty($tutorados) ) {
            throw new PageNotFoundException('No se encontro un grupo' .$id);           
        }

         $data = [
            'title' => 'Tutorados',
            'grupo'     => $grupo,
            'tutorados' => $tutorados,
        ];

        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_participantes', $data)
        . view('templates/footer');
    }
///ELIMINAR
    public function findTutoria(int $idGrupo){
        $model     = model(TutoriaModel::class);
        $tutoria = $model->showTutorias($idGrupo);

         $data = [
            'title'   => 'Tutorias',
            'tutoria' =>  $tutoria,
        ];

        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutoria_tutorias', $data)
        . view('templates/footer');
    }

    public function createTutor(){
        helper('form');

        $umodel    = model(TutorModel::class);
        $usuario   = $umodel->findUsuarios();
        $nusuario  = [];
        foreach ($usuario as $u) {
            $nusuario[$u->Id_Usuario] = $u->Nombre; 
        }
        $data = [
            'title'   => 'Agregar Tutor',
            'usuario' => $nusuario,
        ];

        if($this->request->is('get')){
            return view('templates/header', $data)
                . view('Tutorias/tutorado/tutorado_agregar', $data)
                . view('templates/footer');
        }

        $post= $this->request->getPost(['Id', 'Id_Usuario', 'Inicia', 'Termina']);
        $sonValidos = $this->validateData($post, [
            'Id_Usuario'   => 'required|numeric',
            'Inicia'       => 'required|valid_date',
            'Termina'      => 'valid_date',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/tutorado/tutorado_agregar')
                . view('templates/footer');
        }

        $model =  model(TutorModel::class);

        $tutor = new TutorEntity();
        $tutor->Id_Usuario   = $post['Id_Usuario'];
        $tutor->Inicia       = $post['Inicia'];
        $tutor->Termina      = $post['Termina'];

        $model->save($tutor);

        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showTutores'));
    }

    public function showGrupos(int $id){
        $model = model(TutoradoModel::class);

        $grupos = $model->findGrupo($id);

        $data = [
            'title' => 'Grupos',
            'grupos' => $grupos,
       ];

        return view('templates/header', $data)
            . view('Tutorias/tutorado/tutoria_grupos', $data)
            . view('templates/footer');
    }

    public function gruposMenu(int $id, int $id_grupo){
       
        $model     = model(TutoradoModel::class);
        $tutorados = $model->findTutorado($id, $id_grupo);
        $grupo     = $model->grupoAlum($id);
        $idGrupo   = $model->grupoId($id_grupo);
        


         $data = [
            'title' => 'Tutorados',
            'grupo'     => $grupo,
            'tutorados' => $tutorados,
            'idGrupo'   => $idGrupo,
        ];

        return view('templates/header', $data)
            . view('Tutorias/tutorado/tutoria_grupos_menu', $data)
            . view('templates/footer');
    }

    public function tutoradosTutor(int $id, int $id_grupo)
    {
        $model     = model(TutoradoModel::class);
        $tutorados = $model->grupoId($id_grupo);

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
        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_tutorados', $data)
        . view('templates/footer');
    }

    public function addIndividual(int $id_usuario){
        helper('form');
 
        $tmodel     = model(IndividualModel::class);
        $tutorado   = $tmodel->tutoradosSelect($id_usuario);
        $ntutorado  = [];
        foreach ($tutorado as $t) {
            $ntutorado[$t->Id_Tutorado] = $t->Alumno;
        }
        $data = [
            'title'        => 'Agregar almuno a tutoría individual',
            'tutorado'     => $ntutorado,
        ];
        
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/tutorado/tutorado_agregarIndividual')
		        . view('templates/footer');
        }
         
        $post = $this->request->getPost(['Id_Tutorado', 'Horas', 'Fecha']);

        $sonValidos = $this->validateData($post, [
            'Id_Tutorado'   => 'required|numeric',
            'Horas'         => 'required|numeric',
            'Fecha'         => 'required|valid_date',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/tutorado/tutorado_agregarIndividual')
                . view('templates/footer');
        }
        
        $model =  model(IndividualModel::class);
        
        $tutoria = new CanalizacionEntity();
        $tutoria->Id_Tutorado   = $post['Id_Tutorado'];
        $tutoria->Horas         = $post['Horas'];
        $tutoria->Fecha         = $post['Fecha'];

        $model->save($tutoria);
        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showCanalizacion', $usuario->Id));

    }

    public function showCanalizacion(int $id, int $id_grupo)
    {
        $model = model(TutoradoModel::class);

        $canalizaciones = $model->tutoradosIndividuales($id, $id_grupo);

        if (empty($canalizaciones) ) {
            throw new PageNotFoundException('No se encontro un grupo');   
        }
        $data = [
            'title'          => 'Tutoria Individual',
            'canalizaciones' => $canalizaciones,
        ];

        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorados_canalizacion', $data)
        . view('templates/footer');

    }

    public function addCanalizacion(int $idAlumno, int $idGrupo){
        
 
        $model   = model(TutoradoModel::class);
        $tutoria = $model->tutoradosTutoria($idAlumno,$idGrupo);
        
        $dmodel         = model(CanalizacionModel::class);
        $departamento   = $dmodel->findDepartamento();
        $ndepartamento  = [];
        foreach ($departamento as $d) {
            $ndepartamento[$d->Id] = $d->Nombre;
        }
        $data = [
            'title'        => 'Crear un nueva canalización',
            'tutoria'      => $tutoria,
        ];
        
        $data['departamento'] = $ndepartamento;
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/tutorado/tutorado_canalizacion_add')
		        . view('templates/footer');
        }
        helper('form');
        $post = $this->request->getPost(['Id_Departamento', 'Id_Tutoria', 'Fecha', 'Diagnostico', 'Actividades']);

        $sonValidos = $this->validateData($post, [
            'Id_Departamento'    => 'required|numeric',
            'Id_Tutoria'         => 'required|numeric',
            'Fecha'              => 'required|valid_date',
            'Diagnostico'        => 'required|max_length[255]|min_length[3]',
            'Actividades'        => 'required|max_length[255]|min_length[3]',
            
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/tutorado/tutorado_canalizacion_add')
                . view('templates/footer');
        }
        
        $model =  model(CanalizacionModel::class);
        
        $tutoria = new CanalizacionEntity();
        $tutoria->Id_Departamento   = $post['Id_Departamento'];
        $tutoria->Id_Tutoria        = $post['Id_Tutoria'];
        $tutoria->Fecha             = $post['Fecha'];
        $tutoria->Diagnostico       = $post['Diagnostico'];
        $tutoria->Actividades       = $post['Actividades'];

        $model->save($tutoria);
        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showCanalizacion', $usuario->Id));

    }

    public function alumnoCanalizacion(int $idAlumno, int $idGrupo){
        $model = model(TutoradoModel::class);

        $canalizacion = $model->canalizacionAlumno($idAlumno,$idGrupo);
        $tutoria = $model->tutoria($idAlumno,$idGrupo);

        $data = [
            'title'             => 'Canalizaciones del alumno',
            'canalizacion'      => $canalizacion,
            'tutoria'           => $tutoria,
        ];
        
        return view('templates/header', $data)
        . view('Tutorias/tutorado/tutorado_canalizaciones', $data)
        . view('templates/footer');
    }

    public function showActividad()
    {
        $model = model(ActividadModel::class);

        $actividades = $model->find();

        $data = [
            'title' => 'Actividades',
            'actividades' => $actividades,
        ];

        return view('templates/header', $data)
        . view('Tutorias/actividades/actividades_crear', $data)
        . view('templates/footer');
    }


    public function crearActividad() {
        $model = model(ActividadModel::class);

        $actividades = $model->find();
        helper('form');

        $data = [
            'title' => 'Agrega una nueva actividad',
            'actividades' => $actividades,
        ];

        $post = $this->request->getPost(['Descripcion']);

        $sonValidos = $this->validateData($post, [
            'Descripcion'      => 'required|required|max_length[255]|min_length[3]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/actividades/actividades_crear', $data)
                . view('templates/footer');
        }

        $model =  model(ActividadModel::class);

        $actividad = new ActividadEntity();
        $actividad -> Descripcion = $post['Descripcion'];

        $model->save($actividad);

        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showActividad'));

    }
    public function delateActividad(int $id) {
        $model = model(ActividadModel::class);
        $model ->delete($id);

        return $this->response->redirect(url_to('\\' . Tutorado::class . '::showActividad'));

    }

    public function tutoriaAsistencia(int $id){
        helper('form');
        $tmodel = model(TutoradoModel::class);
        $model = model(TutoriaModel::class);
       
        $tutoria = $model->findTutoria($id);
        $grupo   = $model->showGrupo($id);
        $tgrupal = $model->tutoriaGrupal($id);


        $amodel = model(AlumnoModel::class);
        $alumnos = $amodel->findTutorados($id);

        $data = [
            'title' => 'Agregar Alumnos',
            'grupo'     => $grupo,
            'alumnos'   => $alumnos, 
            'tutoria'   => $tutoria,
            'tgrupal'   => $tgrupal,    
        ];
        if($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Tutorias/tutorado/tutoria_asistencia')
                . view('templates/footer');
        }
        $tutorados = $tmodel->showTutorados();
        // Recibiendo datos
        $post   = $this->request->getPost(['Id_Tutoria', 'alumnos', 'Fecha']);
       //var_dump($post);
       //die;
       
        $sonValidos = $this->validateData($post, [
            'Id_Tutoria'   => 'required|numeric', // Campo oculto
            'alumnos'      => 'required',
            'Fecha'        => 'required|valid_date',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
        . view('Tutorias/tutorado/tutoria_asistencia', $data)
        . view('templates/footer');
        }
        //var_dump($post);
        //die;
        $tutorado  =   $model->guardarTutorados(
            $post['Id_Tutoria'],
            $post['alumnos'],
            $post['Fecha'],
            
        );
        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::findTutorados', $usuario->Id));

    }

    public function showAsistencia(int $id){
        $model = model(TutoradoModel::class);

        $asistencia = $model->showAsistencia($id);

        $data = [
            'title' => 'Asistencia',
            'asistencia' => $asistencia,
       ];

        return view('templates/header', $data)
            . view('Tutorias/tutorado/tutorado_show_asistencia', $data)
            . view('templates/footer');
    }

    public function alumAcreditado(int $id){
        helper('form');
        $model = model(TutoriaModel::class);
        $tuto = $model->tutoriaGrupal($id);

        $amodel = model(AlumnoModel::class);
        $alumnos = $amodel->findTutorados($id);

        $data = [
            'title'     => 'Agregar Alumnos',
            'alumnos'   => $alumnos,
            'tuto'      => $tuto,   
        ];
        if($this->request->is('get')) {
            return view('templates/header', $data)
                . view('Tutorias/tutorado/tutoria_acreditar')
                . view('templates/footer');
        }
        // Recibiendo datos
        $post   = $this->request->getPost(['alumnos', 'Fecha']);
       //var_dump($post);
       //die;
       
        $sonValidos = $this->validateData($post, [
            'alumnos'      => 'required',
            'Fecha'        => 'required|valid_date',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
        . view('Tutorias/tutorado/tutoria_acreditar', $data)
        . view('templates/footer');
        }
        //var_dump($post);
        //die;
        $tutorado  =   $model->guardarAcreditados(
            $post['alumnos'],
            $post['Fecha'],
            
        );
        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Tutorado::class .'::showTutorias', $usuario->Id));

    }

    public function impInforme(int $id_grupo){
        $dompdf = new Dompdf();

        $model          = model(TutoradoModel::class);
        $actividades    = $model->actividad($id_grupo);
        $tutorados      = $model->informe($id_grupo);
        $grupo          = $model->grupoTutoria($id_grupo);
        $participantes  = $model->contParticipantes($id_grupo);
        $mujeres        = $model->contMujeres($id_grupo);
        $hombres        = $model->contHombres($id_grupo);

        $dompdf->set_option("enable_remote", true);
        $data = [
            'title'         => 'INFORME',
            'actividades'     => $actividades,
            'tutorados'     => $tutorados,
            'grupo'         => $grupo,
            'participantes' => $participantes,
            'mujeres'       => $mujeres,
            'hombres'       => $hombres,
        ];
        $dompdf->loadHtml(view('Tutorias/Pdf/informe', $data));
        $dompdf->setPaper('Letter', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    public function impSeguimiento(int $id_canalizacion){
        $dompdf = new Dompdf();

        $model      = model(TutoradoModel::class);
        $cana       = $model->seguimiento($id_canalizacion);
        $dmodel     = model(DepartamentoModel::class);
        $depas      = $dmodel->findDepartamento();

        $dompdf->set_option("enable_remote", true);
        $data = [
            'title'         => 'SEGUIMIENTO',
            'cana'          => $cana,
            'depas'         => $depas,
            ];
        $dompdf->loadHtml(view('Tutorias/Pdf/seguimiento', $data));
        $dompdf->setPaper('Letter', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
