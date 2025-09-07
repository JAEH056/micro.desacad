<?php
namespace App\Controllers\Actualizacion;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Actualizacion\CursoModel;
use App\Models\Actualizacion\PeriodoModel;
use App\Models\Actualizacion\ImparteModel;
use App\Models\Actualizacion\InscripcionModel;
use App\Models\Actualizacion\UsuarioModel;
use App\Models\Actualizacion\SesionModel;
use App\Models\Actualizacion\SecuenciaModel;
use App\Models\Actualizacion\ReporteModel;
use App\Models\Actualizacion\EncuestaModel;
use App\Models\Actualizacion\EvidenciasModel;
use App\Models\Actualizacion\ConstanciaModel;
use App\Entities\Actualizacion\Curso as CursoEntity;
use App\Entities\Actualizacion\Encuesta as EncuestaEntity;
use App\Entities\Actualizacion\Imparte as ImparteEntity;
use App\Entities\Actualizacion\Sesion as SesionEntity;
use App\Entities\Actualizacion\Secuencia as SecuenciaEntity;
use App\Entities\Actualizacion\Reporte as ReporteEntity;
use App\Entities\Actualizacion\Inscripcion as InscripcionEntity;
use App\Entities\Actualizacion\Evidencias as EvidenciasEntity;
use App\Entities\Actualizacion\Constancia as ConstanciaEntity;


use Dompdf\Dompdf;

//require_once '/vendor/dompdf/dompdf/include/autoload.inc.php';
//require_once "vendor/dompdf/dompdf/dompdf_config.inc.php";
//require 'vendor/autoload.php';
//require_once 'dompdf/autoload.inc.php';
//require_once "vendor/dompdf/autoload.inc.php";



use CodeIgniter\Exceptions\PageNotFoundException;

class Curso extends BaseController {

    
     public function showAll()
    {
        $model = model(CursoModel::class);

        $cursos = $model->findAll();

        $data = [
            'title' => 'Cursos',
            'cursos' => $cursos,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_lista', $data)
            . view('templates/footer');
    }

    public function show(int $id){
        $model = model(CursoModel::class);

        $curso = $model->find($id);

        if ( empty($curso) ) {
            throw new PageNotFoundException('No encontré el curso ' . $id);
        }

        $data = [
            'title' => 'Detalles del Curso: ' . $curso->Nombre,
            'curso' => $curso,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_detalle', $data)
            . view('templates/footer');

    }

    public function create() {
        helper('form');
 
        $data = [
            'title' => 'Crear un nuevo curso'
        ];
        
        $pmodel = model(PeriodoModel::class);
        $periodos = $pmodel->findActuales();
        $nperiodos = [];
        foreach ($periodos as $p) {
            $nperiodos[$p->Id] = $p->Nombre;
        }

        $data['periodos'] = $nperiodos;
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Actualizacion/curso/curso_crear')
		        . view('templates/footer');
        }
         
        $post = $this->request->getPost(['Id_Periodo', 'Capacidad', 'Nombre', 'Inicia', 'Termina', 'Objetivo', 'Lugar', 'Requerimiento', 'Perfil', 'Duracion', 'Horario', 'Clave', 'Folio']);

        $sonValidos = $this->validateData($post, [
            'Id_Periodo'    => 'required|numeric',
            'Capacidad'     => 'required|numeric',
            'Nombre'        => 'required|max_length[255]|min_length[3]',
            'Inicia'        => 'required|valid_date',
            'Termina'       => ['valid_date', static function ($value, $data, &$error, $field) {
                if( empty($value) ) return true;

                $inicia =  \DateTime::createFromFormat('Y-m-d', $data['Inicia'])->getTimestamp();
                $termina = \DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();

                if( $termina < $inicia){
                    $error = 'La fecha final no puede ser anterior a la fecha inicial';
                    return false;
                }
                return true;
            }],
            'Objetivo'      => 'required|max_length[500]|min_length[3]',
            'Lugar'         => 'required|max_length[255]|min_length[3]',
            'Requerimiento' => 'required|max_length[255]|min_length[3]',
            'Perfil'        => 'required|max_length[255]|min_length[3]',
            'Duracion'      => 'required|max_length[5]|alpha_numeric_space|min_length[1]',
            'Horario'       => 'required|max_length[30]|min_length[3]',
            'Clave'         => 'required|max_length[255]|min_length[3]',
            'Folio'         => 'max_length[255]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Actualizacion/curso/curso_crear')
                . view('templates/footer');
        }
        
        $model =  model(CursoModel::class);
        
        $curso = new CursoEntity();
        $curso->Id_Periodo   = $post['Id_Periodo'];
        $curso->Capacidad    = $post['Capacidad'];
        $curso->Nombre       = $post['Nombre'];
        $curso->Inicia       = $post['Inicia'];
        $curso->Termina      = $post['Termina'];
        $curso->Objetivo     = $post['Objetivo'];
        $curso->Lugar        = $post['Lugar'];
        $curso->Requerimento = $post['Requerimiento'];
        $curso->Perfil       = $post['Perfil'];
        $curso->Duracion     = $post['Duracion'];
        $curso->Horario      = $post['Horario'];
        $curso->Clave        = $post['Clave'];
        $curso->Folio        = $post['Folio']??NULL;

        $model->save($curso);
       
        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));

    }

    public function update(int $id=0){
        $model = model(CursoModel::class);

        $data = [
            'title'  => 'Actualiza el curso',
            'curso' => $model->get($id),
        ];

        $pmodel = model(PeriodoModel::class);
        $periodos = $pmodel->findActuales();
        $nperiodos = [];
        foreach ($periodos as $p) {
            $nperiodos[$p->Id] = $p->Nombre;
        }
        
        $data['periodos'] = $nperiodos;
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_editar', $data)
            . view('templates/footer');
    }
    public function actualizar() {
        $model = model(CursoModel::class);
        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Id_Periodo', 'Capacidad', 'Nombre', 'Inicia', 'Termina', 'Objetivo', 'Lugar', 'Requerimiento', 'Perfil', 'Duracion', 'Horario', 'Clave', 'Folio']);
        
        $sonValidos = $this->validateData($post, [
            'Capacidad'     => 'required|numeric',
            'Nombre'        => 'required|max_length[255]|min_length[3]',
            'Inicia'        => 'required|valid_date',
            'Termina'       => ['valid_date', static function ($value, $data, &$error, $field) {
                if( empty($value) ) return true;

                $inicia =  \DateTime::createFromFormat('Y-m-d', $data['Inicia'])->getTimestamp();
                $termina = \DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();

                if( $termina < $inicia){
                    $error = 'La fecha final no puede ser anterior a la fecha inicial';
                    return false;
                }
                return true;
            }],
            'Objetivo'      => 'required|max_length[500]|min_length[3]',
            'Lugar'         => 'required|max_length[255]|min_length[3]',
            'Requerimiento' => 'required|max_length[255]|min_length[3]',
            'Perfil'        => 'required|max_length[255]|min_length[3]',
            'Duracion'      => 'required|max_length[5]|numeric|greater_than[0]',
            'Horario'       => 'required|max_length[30]|min_length[3]',
            'Clave'         => 'required|max_length[255]|min_length[3]',
            'Folio'         => 'max_length[255]',
            'Id_Periodo'    => 'required|numeric'
        ]);

        if (! $sonValidos ) {
            return redirect()->back()->withInput();
        }

        $model->update($id, $post);
        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));

    }

    public function inscritos(int $id_curso){
        $model                = model(CursoModel::class);
        $curso                = $model->find($id_curso);
        $puedeInscribir       = $model->contCapacidad($id_curso);
        log_message('debug', 'Valor de puedeInscribir: ' . ($puedeInscribir ? 'Sí' : 'No'));
        $umodel               = model(UsuarioModel::class);
        $usua                 = [];
        $usuariosInscritos    = $umodel->enrrolledParti($id_curso);
        $idsInscritos = array_map(fn($usuario) => (int)$usuario->Id, $usuariosInscritos);
   

        $umodel               = model(UsuarioModel::class);
        $usua                 = [];

        foreach ($umodel -> userAdd() as $u) {
            if(!in_array((int)$u->Id, $idsInscritos)){
                $usua[$u->Id] = $u->Nombre;
            }
        }
        $data = [
            'title'             => 'Participantes',
            'curso'             => $curso,
            'puedeInscribir'    => $puedeInscribir,
            'usuarios'          => $usuariosInscritos,
            'usua'              => $usua,
            'concluido'         => $model->yaConcluido($id_curso),
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_participantes', $data)
            . view('templates/footer');
    }

    public function inscribirParti()  {
        helper('form');
        
        $post = $this->request->getPost(['Id_Curso', 'Id_Usuario']);

        $sonValidos = $this->validateData($post, [
            'Id_Curso'      => 'required|numeric',
            'Id_Usuario'    => 'required|numeric',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header')
                . view('Actualizacion/curso/curso_participantes')
                . view('templates/footer');
        }
        
        $model = model(InscripcionModel::class);
        
        $ins = new InscripcionEntity();
        $ins->Id_Curso   = $post['Id_Curso'];
        $ins->Id_Usuario = $post['Id_Usuario'];
        
        $model->save($ins);
        $Id_Curso = $post['Id_Curso'];
        return $this->response->redirect(url_to('\\' . Curso::class .'::inscritos', $Id_Curso ));
    }

    public function concluirCurso(int $id_curso){
        $model    = model(CursoModel::class);
        
        $fecha = date('Y-m-d');
        $model->concluir($id_curso, $fecha);

        return $this->response->redirect(url_to('\\' . Curso::class .'::acreditarCurso',$id_curso));
    }

    public function acreditarCurso(int $id_curso){
        $model                = model(InscripcionModel::class);
        $cmodel               = model(CursoModel::class);
        $constancia           = model(ConstanciaModel::class); 

        $curso                = $cmodel->find($id_curso);
        $usuarios             = $cmodel->enrrolledUsers($id_curso);
        
        $data = [
            'title'             => 'Acreditación',
            'curso'             => $curso,
            'usuarios'          => $usuarios,
        ];

        if($this->request->is('get')) {
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_acreditar', $data)
            . view('templates/footer');
        }

        if ($this->request->is('post')) {
            $post   = $this->request->getPost(['usuarios', 'Id_Curso']);
            
            $sonValidos = $this->validateData($post, [
                'usuarios'      => 'required',
            ]);
            if (!empty($post['usuarios']) && !empty($post['Id_Curso'])) {
                
                $year = date('Y');//Año actual

                 foreach ($post['usuarios'] as $usuarioId) {
                    
                    $existingRecord = $model->where('id', $usuarioId)  // Aquí 'id' es id_inscripcion
                                            ->where('id_curso', $post['Id_Curso'])
                                            ->first();  // Obtenemos el primer registro que coincida
                
                    if ($existingRecord && empty($existingRecord->Acreditado)) {
                        // Actualizar acreditado 
                        $model->set(['Acreditado' => 1])
                                ->where('Id', $usuarioId)
                                ->where('Id_Curso', $post['Id_Curso'])
                                ->update();
                        $lastConsecutive = $constancia->where('Anio', $year)
                                                      ->orderBy('Consecutivo', 'DESC')
                                                      ->first();  // Obtener el último número consecutivo

                        $numeroConsecutivo = $lastConsecutive ? $lastConsecutive->Consecutivo + 1 : 1;  // Incrementamos el número

                        $consecutivoFormateado = str_pad($numeroConsecutivo, 3, '0', STR_PAD_LEFT);
                        // Guardamos el registro de acreditación
                        $constancia->insert([
                            'Id_Inscripcion'     => $usuarioId,
                            'Fecha'              => date('Y-m-d'),
                            'Anio'               => $year,
                            'Consecutivo'        => $consecutivoFormateado
                        ]);
                        
                    }
                }
            }
            return $this->response->redirect(url_to('\\' . Curso::class .'::inscritos', $id_curso ));
        } else {
          // Si no se seleccionaron usuarios
          session()->setFlashdata('error', 'No se seleccionaron docentes para acreditar.');
        }
    }

    public function listInscritos(int $id_curso) {
       
        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);

        $curso    = $model->find($id_curso);
        $usuarios = $model->enrrolledUsers($id_curso);

        $data = [
            'title' => 'Participantes',
            'curso'     => $curso,
            'usuarios'  => $usuarios,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/lista', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();

    }
    public function userCedula(int $id_curso, int $id_usuario){

        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);
        $models = model(UsuarioModel::class);

        $curso    = $model->find($id_curso);
        
        $usuarios = $models->alumnInfo($id_usuario);
        $data = [
            'title' => 'Cedula',
            'curso'     => $curso,
            'usuarios'  => $usuarios,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/cedula', $data));
        $dompdf->setPaper('Letter','portrait');
        $dompdf->render();
        $dompdf->stream();
        
    }
    public function constancias(int $id_curso){

        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);
        $models = model(UsuarioModel::class);

        $curso      = $model->constancias($id_curso);
        $data = [
            'title' => 'Constancia',
            'curso'     => $curso,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/constancia', $data));
        $dompdf->setPaper('Letter','portrait');
        $dompdf->render();
        $dompdf->stream();
        
    }

    public function cursoDelete(int $id){
        $model = model(CursoModel::class);
        $model->delete($id);

        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));
    }

    public function inscritoDelete(int $id){
        $model = model(InscripcionModel::class);
        $model->delete($id);

        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));
    }

    public function mostrarInstructor(int $id_curso){
        $model = model(ImparteModel::class);
        $cmodel = model(CursoModel::class);
        $umodel = model(UsuarioModel::class);

        $usuarios = [];
        foreach ($umodel->userAll() as $u) {
            $usuarios[$u->Id] = $u->Nombre;
        }
        
        $data = [
            'title'        => 'Curso',
            'curso'        => $cmodel->get($id_curso),
            'instructores' => $model->findInstructor($id_curso),
            'usuarios'     => $usuarios,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_instructor', $data)
            . view('templates/footer');
    }

    public function insertarInstructor(){
        
        helper('form');
 
        $data = [
            'title' => 'Elije un instructor',
        ];
        
        $post = $this->request->getPost(['Id_Curso', 'Id_Usuario']);

        $sonValidos = $this->validateData($post, [
            'Id_Curso'      => 'required|numeric',
            'Id_Usuario'    => 'required|numeric',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Actualizacion/curso/curso_instructor')
                . view('templates/footer');
        }
        
        $model =  model(ImparteModel::class);
        
        $imparte = new ImparteEntity();
        $imparte->Id_Usuario  = $post['Id_Usuario'];
        $imparte->Id_Curso    = $post['Id_Curso'];
    
        $model->save($imparte);
       
        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));
    }

    public function deleteInstructor(int $id_curso, int $id_usuario){
        $model = model(ImparteModel::class);
        $model->deleteInstructor($id_curso,$id_usuario);

        return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));
    }

    public function cursoConcluido(int $id_usuario){
        $model = model(CursoModel::class);

        $cursos = $model->misCursos($id_usuario);

        $data = [
            'title' => 'Mis cursos',
            'cursos' => $cursos,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_misCursos', $data)
            . view('templates/footer');

    }

    public function encuesta(int $id_inscripcion){
        $encuesta = model(EncuestaModel::class);
      
        $encuestaLlena = $this->verificarEncuestaLlena($id_inscripcion);
    
        if ($encuestaLlena) {
            session()->setFlashdata('mensaje', 'La encuesta ya ha sido completada.');
            $usuario = session_get('usuario');
            return $this->response->redirect(url_to('\\' . Curso::class .'::cursoConcluido', $usuario->Id));
        }

        $data = [
            'title'          => 'Encuesta',
            'preguntas'      => $encuesta->findPreguntas(),
            'id_inscripcion' => $id_inscripcion,
        ];

        return view('templates/header', $data)
        . view('Actualizacion/curso/curso_encuesta', $data)
        . view('templates/footer');

    }

    private function verificarEncuestaLlena($id_inscripcion) {
        $encuestaModel = model(EncuestaModel::class);
        
        return $encuestaModel->isEncuestaCompleta($id_inscripcion);
    }
    
    public function saveEncuesta(int $id_inscripcion){
        $encuesta = model(EncuestaModel::class);

        if( $encuesta->completa($id_inscripcion) ) {
            $usuario = session_get('usuario');
            return $this->response->redirect(url_to('\\' . Curso::class .'::cursoConcluido', $usuario->Id));
        }
      
        $campos_preguntas  = [];
        $reglas_respuestas = [];
        $preguntas = $encuesta->findPreguntas();

        foreach ($preguntas as $pregunta) {
            $preguntaNombre = 'p' . $pregunta['Id'];
            $campos_preguntas[] = $preguntaNombre;
            $reglas_respuestas[$preguntaNombre] = 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]';
        }
        
        $campos = array_merge($campos_preguntas, ['Id_Inscripcion', 'Comentarios']);
        $post = $this->request->getPost($campos);

        $sonValidos = $this->validateData($post, [
            'Comentarios'      => 'max_length[255]',
            'Id_Inscripcion'   => 'required|numeric', // Campo oculto
        ] + $reglas_respuestas);
        
        if (! $sonValidos ) {
            $data = [
                'title'          => 'Encuesta',
                'preguntas'      => $encuesta->findPreguntas(),
                'id_inscripcion' => $id_inscripcion,
            ];

		    return view('templates/header', $data)
               . view('Actualizacion/curso/curso_encuesta')
               . view('templates/footer');
        }
        
        $idEncuesta = $encuesta->guardarRespuesta(
            $post['Id_Inscripcion'],
            $post['Comentarios'],
            $preguntas,
            $this->request->getPost($campos_preguntas)
        );

        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Curso::class .'::cursoConcluido', $usuario->Id));
    }

    public function userEncuesta(int $id_curso, int $id_usuario){
        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);
        
        $curso    = $model->find($id_curso);
        $encuesta = $model->resultEncuesta($id_curso, $id_usuario);
        
        $data = [  
            'title' => 'Encuesta',
            'curso'     => $curso,
            'encuesta'  => $encuesta,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/encuesta', $data));
        $dompdf->setPaper('Letter','portrait');
        $dompdf->render();
        $dompdf->stream();
    }

    public function cursos(int $id_usuario) {
        $model = model(CursoModel::class);

        $cursos = $model->cursosActuales($id_usuario);

        $data = [
            'title' => 'Cursos',
            'cursos' => $cursos,
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_cursos', $data)
            . view('templates/footer');
    }

    public function inscripcionCurso(int $id_curso,int $id_usuario)  {
        $model = model(CursoModel::class);

        $data = [
            'title'     => 'Detalles del Curso',
            'curso'     => $model->find($id_curso),
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_inscripcion', $data)
            . view('templates/footer');
    }

    public function inscribir(int $id_curso,int $id_usuario)  {
        $model = model(InscripcionModel::class);
        
        $ins = new InscripcionEntity();
        $ins->Id_Curso   = $id_curso;
        $ins->Id_Usuario = $id_usuario;
        
        $model->save($ins);
        return $this->response->redirect(url_to('\\' . Curso::class .'::cursoConcluido', $id_usuario));
    }

    public function cursoInstructor(int $id_usuario){
        $model = model(CursoModel::class);

        $cursos = $model->imparUsuario($id_usuario);

        $data = [
            'title' => 'Mis cursos',
            'cursos' => $cursos,
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_deinstructor', $data)
            . view('templates/footer');
    }
    
    public function actividadCurso(int $id_curso){
        $model        = model(CursoModel::class);
        $reporteModel = model(ReporteModel::class);

        $curso = $model->find($id_curso);

        $reporteExistente = $reporteModel->where('Id_Curso', $id_curso)->first();

        $data = [
            'title'             => 'Mis Cursos',
            'curso'             => $model->find($id_curso),
            'reporteExistente'  => $reporteExistente, 
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_actividades', $data)
            . view('templates/footer');
    }
    
    public function createSesion(int $id_curso){
        helper('form'); 

        $model = model(CursoModel::class);
        $curso    = $model->find($id_curso);
        $data = [
            'title' => 'Crear Carta Descriptiva',
            'curso' => $curso,
        ];
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Actualizacion/curso/curso_sesion')
		        . view('templates/footer');
        }
        
        $post = $this->request->getPost(['Id_Curso', 'Tema', 'Contenido', 'Objetivo', 'Tecnicas', 'Actividades', 'Evaluacion', 'Materiales', 'Duracion']);

        $sonValidos = $this->validateData($post, [
            'Id_Curso'      => 'required|numeric',
            'Tema'          => 'required|max_length[255]|min_length[3]',
            'Contenido'     => 'required|max_length[255]|min_length[3]',
            'Objetivo'      => 'required|max_length[255]|min_length[3]',
            'Tecnicas'      => 'required|max_length[255]|min_length[3]',
            'Actividades'   => 'required|max_length[255]|min_length[3]',
            'Evaluacion'    => 'required|max_length[255]|min_length[3]',
            'Materiales'    => 'required|max_length[255]|min_length[3]',
            'Duracion'      => 'required|max_length[5]|numeric|greater_than[0]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Actualizacion/curso/curso_sesion')
                . view('templates/footer');
        }
        
        $model =  model(SesionModel::class);
        
        $sesion = new SesionEntity();
        $sesion->Id_Curso    = $post['Id_Curso'];
        $sesion->Tema        = $post['Tema'];
        $sesion->Contenido   = $post['Contenido'];
        $sesion->Objetivo    = $post['Objetivo'];
        $sesion->Tecnicas    = $post['Tecnicas'];
        $sesion->Actividades = $post['Actividades'];
        $sesion->Evaluacion  = $post['Evaluacion'];
        $sesion->Materiales  = $post['Materiales'];
        $sesion->Duracion    = $post['Duracion'];

        $idSesion = $model->insert($sesion);
        return $this->response->redirect(url_to('\\' . Curso::class .'::createSecuencia', $idSesion));
    }

    public function impCarta(int $id_curso){

        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);
        $smodel = model(SesionModel::class);

        $curso    = $model->find($id_curso);
        $sesion  = $smodel->find($id_curso);
        $participantes = $model->contParticipantes($id_curso);

        $data = [
            'title' => 'Carta',
            'curso'     => $curso,
            'sesion'    => $sesion,
            'participantes' => $participantes,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/carta', $data));
        $dompdf->setPaper('Letter','landscape');
        $dompdf->render();
        $dompdf->stream();
    }
    
    public function createSecuencia(int $idSesion, int $id_curso){
        helper('form');
        $model = model(CursoModel::class);
        $curso    = $model->find($id_curso);
        $model = model(SesionModel::class);
        $sesion    = $model->sesionId($idSesion);

        $data = [
            'title' => 'Crear Plan de Sesión',
            'sesion'=> $sesion, 
            'curso' => $curso,       
        ];

        if($this->request->is('get')) {
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_plan')
            . view('templates/footer');
        }
        $post = $this->request->getPost(['Id_Sesion', 'Id_Fase', 'Temas', 'Objetivos', 'Tecnicas', 'Actividades', 'Duracion', 'Evaluacion', 'Materiales','Id_Sesion2', 'Id_Fase2', 'Temas2', 'Objetivos2', 'Tecnicas2', 'Actividades2', 'Duracion2', 'Evaluacion2', 'Materiales2', 'Id_Sesion3', 'Id_Fase3', 'Temas3', 'Objetivos3', 'Tecnicas3', 'Actividades3', 'Duracion3', 'Evaluacion3', 'Materiales3']);
        
        $sonValidos = $this->validateData($post, [
            'Id_Sesion'     => 'required|numeric',
            'Id_Fase'       => 'required|numeric',
            'Temas'         => 'required|max_length[255]|min_length[3]',
            'Objetivos'     => 'required|max_length[255]|min_length[3]',
            'Tecnicas'      => 'required|max_length[255]|min_length[3]',
            'Actividades'   => 'required|max_length[255]|min_length[3]',
            'Duracion'      => 'required|max_length[5]|numeric|greater_than[0]',
            'Evaluacion'    => 'required|max_length[255]|min_length[3]',
            'Materiales'    => 'required|max_length[255]|min_length[3]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Actualizacion/curso/curso_plan')
                . view('templates/footer');
        }
        
        $model =  model(SecuenciaModel::class);
        
        $plan = new SecuenciaEntity();
        $plan->Id_Sesion   = $post['Id_Sesion'];
        $plan->Id_Fase     = $post['Id_Fase'];
        $plan->Temas       = $post['Temas'];
        $plan->Objetivos   = $post['Objetivos'];
        $plan->Tecnicas    = $post['Tecnicas'];
        $plan->Actividades = $post['Actividades'];
        $plan->Duracion    = $post['Duracion'];
        $plan->Evaluacion  = $post['Evaluacion'];
        $plan->Materiales  = $post['Materiales'];
        $plan2 = new SecuenciaEntity();
        $plan2->Id_Sesion   = $post['Id_Sesion2'];
        $plan2->Id_Fase     = $post['Id_Fase2'];
        $plan2->Temas       = $post['Temas2'];
        $plan2->Objetivos   = $post['Objetivos2'];
        $plan2->Tecnicas    = $post['Tecnicas2'];
        $plan2->Actividades = $post['Actividades2'];
        $plan2->Duracion    = $post['Duracion2'];
        $plan2->Evaluacion  = $post['Evaluacion2'];
        $plan2->Materiales  = $post['Materiales2'];
        $plan3 = new SecuenciaEntity();
        $plan3->Id_Sesion   = $post['Id_Sesion3'];
        $plan3->Id_Fase     = $post['Id_Fase3'];
        $plan3->Temas       = $post['Temas3'];
        $plan3->Objetivos   = $post['Objetivos3'];
        $plan3->Tecnicas    = $post['Tecnicas3'];
        $plan3->Actividades = $post['Actividades3'];
        $plan3->Duracion    = $post['Duracion3'];
        $plan3->Evaluacion  = $post['Evaluacion3'];
        $plan3->Materiales  = $post['Materiales3'];
        
        $model->save($plan);
        $model->save($plan2);
        $model->save($plan3);

        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Curso::class .'::createSesion', $curso->Id));
    }
    public function impPlan(int $id_curso){

        $dompdf = new Dompdf();
        
        $model = model(CursoModel::class);
        $smodel = model(SecuenciaModel::class);

        $curso    = $model->find($id_curso);
        $secuencia  = $smodel->find($id_curso);
        $secu  = $smodel->findTema($id_curso);
        $participantes = $model->contParticipantes($id_curso);

        $dompdf->set_option('defaultFont', 'Montserrat-Black.ttf');
        $data = [
            'title'         => 'Plan de sesión',
            'curso'         => $curso,
            'secuencia'     => $secuencia,
            'secu'          => $secu,
            'participantes' => $participantes,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/plan', $data));
        $dompdf->setPaper('Letter','landscape');
        $dompdf->render();
        $dompdf->stream();
        
    } 
    public function createReporte(int $id_curso){
        helper('form'); 
    
        $model = model(CursoModel::class);
        $curso      = $model->find($id_curso);
        $data = [
            'title'       => 'Crear Reporte Final',
            'curso'       => $curso,
        ];
         
        if($this->request->is('get')) {
        return view('templates/header', $data)
        . view('Actualizacion/curso/curso_reporte', $data)
        . view('templates/footer');
        }
        
        $post = $this->request->getPost(['Id_Curso', 'Objetivos', 'Porcentaje_Obj', 'Comentarios_Obj', 'Expectativas', 'Porcentaje_Exp', 'Comentarios_Exp', 'Dinamica', 'Areas', 'Practicas', 'Contingencia', 'Accion', 'Ajustes', 'Evaluaciones', 'Resultado']);

        $sonValidos = $this->validateData($post, [

            'Id_Curso'          => 'required|numeric',
            'Objetivos'         => 'required|max_length[255]|min_length[3]',
            'Porcentaje_Obj'    => 'required|max_length[2]|numeric[1]',
            'Comentarios_Obj'   => 'required|max_length[255]|min_length[3]',
            'Expectativas'      => 'required|max_length[255]|min_length[3]',
            'Porcentaje_Exp'    => 'required|max_length[2]|numeric[1]',
            'Comentarios_Exp'   => 'required|max_length[255]|min_length[3]',
            'Dinamica'          => 'required|max_length[255]|min_length[3]',
            'Areas'             => 'required|max_length[255]|min_length[3]',
            'Practicas'         => 'required|max_length[255]|min_length[3]',
            'Contingencia'      => 'required|max_length[255]|min_length[3]',
            'Accion'            => 'required|max_length[255]|min_length[3]',
            'Ajustes'           => 'required|max_length[255]|min_length[3]',
            'Evaluaciones'      => 'required|max_length[255]|min_length[3]',
            'Resultado'         => 'required|max_length[255]|min_length[3]',
  
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Actualizacion/curso/curso_sesion')
                . view('templates/footer');
        }
        
        $model =  model(ReporteModel::class);
        
        $curso = new ReporteEntity();
        $curso->Id_Curso        = $post['Id_Curso'];
        $curso->Objetivos       = $post['Objetivos'];
        $curso->Porcentaje_Obj  = $post['Porcentaje_Obj'];
        $curso->Comentarios_Obj = $post['Comentarios_Obj'];
        $curso->Expectativas    = $post['Expectativas'];
        $curso->Porcentaje_Exp  = $post['Porcentaje_Exp'];
        $curso->Comentarios_Exp = $post['Comentarios_Exp'];
        $curso->Dinamica        = $post['Dinamica'];
        $curso->Areas           = $post['Areas'];
        $curso->Practicas       = $post['Practicas'];
        $curso->Contingencia    = $post['Contingencia'];
        $curso->Accion          = $post['Accion'];
        $curso->Ajustes         = $post['Ajustes'];
        $curso->Evaluaciones    = $post['Evaluaciones'];
        $curso->Resultado       = $post['Resultado'];

        $model->save($curso);
       
        $usuario = session_get('usuario');
        return $this->response->redirect(url_to('\\' . Curso::class .'::cursoInstructor', $usuario->Id));
    }
    public function impReporte(int $id_curso){
        $dompdf = new Dompdf();
        $dompdf->set_option("enable_remote", true);
        $model = model(CursoModel::class);
        $rmodel = model(ReporteModel::class);

        $curso    = $model->find($id_curso);
        $reporte  = $rmodel->find($id_curso);
        $participantes = $model->contParticipantes($id_curso);
        $data = [
            'title'         => 'REPORTE',
            'curso'         => $curso,
            'reporte'       => $reporte,
            'participantes' => $participantes,
        ];
        $dompdf->loadHtml(view('Actualizacion/pdf/reporte', $data));
        $dompdf->setPaper('Letter', 'landscape');
        $dompdf->render();
        $dompdf->stream();

    } 
    public function evidenciaCurso(int $id_curso){
        $model = model(CursoModel::class);

        $data = [
            'title' => 'Cargar Evidencia',
            'curso' => $model->find($id_curso),
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_evidencia', $data)
            . view('templates/footer');
    }

    public function guardarImg(){
        $model = new EvidenciasModel();

        $validationRule = [
            //'Iuserfile' => [
            'Imagen' => [
                'label'  => 'Image File',
                'rules'  => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];
    
        $file = $this->request->getFile('Imagen');
       
        if ($file->isValid()) {
            
            // Configurar la biblioteca de carga de archivos
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/evidencias/', $newName);

            // Obtener el ID del curso desde el formulario
            $id_curso = $this->request->getPost('Id_Curso');
    
            // Crear una nueva entidad
            $data = new EvidenciasEntity();
    
            // Establecer los datos en la entidad
            $data->Id_Curso = $id_curso;
            $data->Imagen = $file->getName(); // Nombre del archivo
    
            // Guardar la entidad en el modelo
            $model->save($data);
    
            // Puedes realizar otras acciones después de la carga de la imagen y el guardado en la base de datos
            // ...
        
            $usuario = session_get('usuario');
            return $this->response->redirect(url_to('\\' . Curso::class .'::cursoInstructor', $usuario->Id));
        } else {
            // Manejar el caso en que no se haya enviado un archivo válido
            //$error = $uploader->getErrorString(); // Corregir la variable a $uploader
            
                return redirect()->back()->withInput();
        }
        
    }

    public function evidenciaVer(int $id_curso){

        $model = model(EvidenciasModel::class);
        $modelCurso = model(CursoModel::class);
        $curso      = $modelCurso->find($id_curso);

        $data = [
            'title'     => 'Evidencias',
            'imagenes'  => $model->obtenerImagenes($id_curso),
            'curso'     => $curso
        ];
        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_evidenciaVer', $data)
            . view('templates/footer');
    }

    public function evidenciaDelete(int $id, int $id_curso){

        $model = model(EvidenciasModel::class);

        if ($model->imagenDelete($id)) {
            return $this->response->redirect(url_to('\\' . Curso::class .'::evidenciaVer', $id_curso));
        } else {
            
            return redirect()->back()->withInput();
        }
    }

    //Editar logos de constancias
    public function logoShow(){

        $model = model(CursoModel::class);

        $data = [
            'title'     => 'Logos',
        ];

        return view('templates/header', $data)
            . view('Actualizacion/curso/curso_logos', $data)
            . view('templates/footer');
    }

    public function logoUpdate1(){
        // Obtener el archivo subido
    $archivo = $this->request->getFile('Imagen');
    $nombreArchivo = 'logo1.png'; // Ya que este método es específico para logo1

    // Validamos el archivo
    if (!$archivo->isValid()) {
        return redirect()->back()->with('error', 'Archivo inválido o no enviado');
    }

    // Verificamos tipo de imagen permitido
    $mime = $archivo->getClientMimeType();
    if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
        return redirect()->back()->with('error', 'Tipo de imagen no permitido (solo JPG, PNG o WEBP)');
    }

    // Tamaño máximo: 2MB
    if ($archivo->getSize() > 2 * 1024 * 1024) {
        return redirect()->back()->with('error', 'La imagen supera el tamaño permitido (2MB)');
    }

    // Definimos la ruta donde se va a guardar
    $rutaDestino = WRITEPATH . '../public/logos/' . $nombreArchivo;

    // Movemos el archivo (sobrescribiendo si ya existe)
    try {
        $archivo->move(dirname($rutaDestino), $nombreArchivo, true); // true = sobrescribe
        return redirect()->back()->with('mensaje', 'Imagen "logo1" actualizada con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
    }
    }

    public function logoUpdate2(){
        // Obtener el archivo subido
    $archivo = $this->request->getFile('Imagen');
    $nombreArchivo = 'logo2.png'; // Ya que este método es específico para logo1

    // Validamos el archivo
    if (!$archivo->isValid()) {
        return redirect()->back()->with('error', 'Archivo inválido o no enviado');
    }

    // Verificamos tipo de imagen permitido
    $mime = $archivo->getClientMimeType();
    if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
        return redirect()->back()->with('error', 'Tipo de imagen no permitido (solo JPG, PNG o WEBP)');
    }

    // Tamaño máximo: 2MB
    if ($archivo->getSize() > 2 * 1024 * 1024) {
        return redirect()->back()->with('error', 'La imagen supera el tamaño permitido (2MB)');
    }

    // Definimos la ruta donde se va a guardar
    $rutaDestino = WRITEPATH . '../public/logos/' . $nombreArchivo;

    // Movemos el archivo (sobrescribiendo si ya existe)
    try {
        $archivo->move(dirname($rutaDestino), $nombreArchivo, true); // true = sobrescribe
        return redirect()->back()->with('mensaje', 'Imagen "logo2" actualizada con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
    }
    }

    public function logoUpdate3(){
        // Obtener el archivo subido
    $archivo = $this->request->getFile('Imagen');
    $nombreArchivo = 'logo3.png'; // Ya que este método es específico para logo1

    // Validamos el archivo
    if (!$archivo->isValid()) {
        return redirect()->back()->with('error', 'Archivo inválido o no enviado');
    }

    // Verificamos tipo de imagen permitido
    $mime = $archivo->getClientMimeType();
    if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
        return redirect()->back()->with('error', 'Tipo de imagen no permitido (solo JPG, PNG o WEBP)');
    }

    // Tamaño máximo: 2MB
    if ($archivo->getSize() > 2 * 1024 * 1024) {
        return redirect()->back()->with('error', 'La imagen supera el tamaño permitido (2MB)');
    }

    // Definimos la ruta donde se va a guardar
    $rutaDestino = WRITEPATH . '../public/logos/' . $nombreArchivo;

    // Movemos el archivo (sobrescribiendo si ya existe)
    try {
        $archivo->move(dirname($rutaDestino), $nombreArchivo, true); // true = sobrescribe
        return redirect()->back()->with('mensaje', 'Imagen "logo3" actualizada con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
    }
    }

    public function logoUpdate4(){
        // Obtener el archivo subido
    $archivo = $this->request->getFile('Imagen');
    $nombreArchivo = 'logo4.png'; // Ya que este método es específico para logo1

    // Validamos el archivo
    if (!$archivo->isValid()) {
        return redirect()->back()->with('error', 'Archivo inválido o no enviado');
    }

    // Verificamos tipo de imagen permitido
    $mime = $archivo->getClientMimeType();
    if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
        return redirect()->back()->with('error', 'Tipo de imagen no permitido (solo JPG, PNG o WEBP)');
    }

    // Tamaño máximo: 2MB
    if ($archivo->getSize() > 2 * 1024 * 1024) {
        return redirect()->back()->with('error', 'La imagen supera el tamaño permitido (2MB)');
    }

    // Definimos la ruta donde se va a guardar
    $rutaDestino = WRITEPATH . '../public/logos/' . $nombreArchivo;

    // Movemos el archivo (sobrescribiendo si ya existe)
    try {
        $archivo->move(dirname($rutaDestino), $nombreArchivo, true); // true = sobrescribe
        return redirect()->back()->with('mensaje', 'Imagen "logo4" actualizada con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
    }
    }

    public function logoUpdate5(){
        // Obtener el archivo subido
        $archivo = $this->request->getFile('Imagen');
        $nombreArchivo = 'logo5.png'; // Ya que este método es específico para logo1

        // Validamos el archivo
        if (!$archivo->isValid()) {
            return redirect()->back()->with('error', 'Archivo inválido o no enviado');
        }

        // Verificamos tipo de imagen permitido
        $mime = $archivo->getClientMimeType();
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
            return redirect()->back()->with('error', 'Tipo de imagen no permitido (solo JPG, PNG o WEBP)');
        }

        // Tamaño máximo: 2MB
        if ($archivo->getSize() > 2 * 1024 * 1024) {
            return redirect()->back()->with('error', 'La imagen supera el tamaño permitido (2MB)');
        }

        // Definimos la ruta donde se va a guardar
        $rutaDestino = WRITEPATH . '../public/logos/' . $nombreArchivo;

        // Movemos el archivo (sobrescribiendo si ya existe)
        try {
            $archivo->move(dirname($rutaDestino), $nombreArchivo, true); // true = sobrescribe
            return redirect()->back()->with('mensaje', 'Imagen "logo5" actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
        }
    }

    public function toggleBloqueo($id){

        $cursoModel = model(CursoModel::class);
            
        // Obtener el curso actual
        $curso = $cursoModel->find($id);

        if ($curso) {
            $nuevoEstado = $curso->Bloqueado ? 0 : 1;

            $cursoModel->save([
                'Id' => $curso->Id,
                'Bloqueado' => $nuevoEstado
            ]);
        }
    return $this->response->redirect(url_to('\\' . Curso::class .'::showAll'));
    }
}
    