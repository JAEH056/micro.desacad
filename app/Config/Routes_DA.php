<?php
use App\Controllers\Actualizacion\News;
use App\Controllers\Actualizacion\Pages;
use App\Controllers\Actualizacion\Periodo;
use App\Controllers\Actualizacion\Curso;
use App\Controllers\Actualizacion\Usuario;


$routes->group('rol',['filter' => 'sessionfilter:SuperUsuario'], function($routes) {
   
    //Administrador
    $routes->get('curso/mostrar',                             [Curso::class, 'showAll']);
    $routes->get('curso/mostrar/(:num)',                      [Curso::class, 'show']);
    $routes->match(['get', 'post'], 'curso/crear',            [Curso::class, 'create']);
    $routes->get('curso/update/(:num)',                       [Curso::class, 'update']);
    $routes->post('curso/actualizar',                         [Curso::class, 'actualizar']);
    $routes->get('curso/eliminar/(:num)',                     [Curso::class, 'cursoDelete']);
    $routes->get('curso/deleteins/(:num)',                    [Curso::class, 'inscritoDelete']);
    $routes->get('curso/participantes/(:num)',                [Curso::class, 'inscritos']);
    $routes->match(['get', 'post'],'curso/acreditar/(:num)',  [Curso::class, 'acreditarCurso']);
    $routes->post('curso/acreditar/guardar/(:num)',           [Curso::class, 'saveAcreditacion']);
    $routes->post('curso/agregar',                            [Curso::class, 'inscribirParti']);
    $routes->get('curso/lista/(:num)',                        [Curso::class, 'listInscritos']);
    $routes->get('curso/concluir/(:num)',                     [Curso::class, 'concluirCurso']);
    $routes->get('curso/cedula/(:num)/(:num)',                [Curso::class, 'userCedula']);
    $routes->get('curso/constancia/(:num)/(:num)',            [Curso::class, 'usuarioConstancia']);
    $routes->get('curso/constancias/(:num)',                  [Curso::class, 'constancias']);
    $routes->get('curso/instructor/(:num)',                   [Curso::class, 'mostrarInstructor']);
    $routes->get('curso/ins/eliminar/(:num)/(:num)',          [Curso::class, 'deleteInstructor']);
    $routes->post('curso/insertar',                           [Curso::class, 'insertarInstructor']);
    
    $routes->get('curso/encuesta/ver/(:num)',                 [Curso::class, 'encuesta']);
    //Adminiatrador
    $routes->get('curso/constancia/(:num)',                   [Curso::class, 'cursoConstancia']);
    
    $routes->get('curso/datos/(:num)/(:num)',                 [Curso::class, 'inscripcionCurso']);
    $routes->get('curso/ins/(:num)/(:num)',                   [Curso::class, 'inscribir']);
    $routes->get('curso/logos',                               [Curso::class, 'logoShow']);
    $routes->post('curso/logo/actualizar/1/',                 [Curso::class, 'logoUpdate1']);
    $routes->post('curso/logo/actualizar/2/',                 [Curso::class, 'logoUpdate2']);
    $routes->post('curso/logo/actualizar/3/',                 [Curso::class, 'logoUpdate3']);
    $routes->post('curso/logo/actualizar/4/',                 [Curso::class, 'logoUpdate4']);
    $routes->post('curso/logo/actualizar/5/',                 [Curso::class, 'logoUpdate5']);
    $routes->get('curso/bloqueo/(:num)',                      [Curso::class, 'toggleBloqueo']);


    $routes->get('periodo/mostrar',                         [Periodo::class, 'showAll']);
    $routes->get('periodo/mostrar/(:num)',                  [Periodo::class, 'show']);
    $routes->match(['get', 'post'], 'periodo/crear',        [Periodo::class, 'create']);
    $routes->post('periodo/actualizar',                     [Periodo::class, 'update']);
    $routes->get('periodo/update/(:num)',                   [Periodo::class, 'update']);
    $routes->get('periodo/delete/(:num)',                   [Periodo::class, 'delete']);
    
    //Administrador
    $routes->get('usuario/mostrar',                                 [Usuario::class, 'showAll']);
    //$routes->get('usuario/mostrar/(:num)',                  [Usuario::class, 'show']);
    $routes->get('usuario/mostrar/(:num)',                          [Usuario::class, 'userShow']);
    $routes->match(['get', 'post'], 'usuario/crear',                [Usuario::class, 'create']);
    $routes->get('usuario/update/(:num)',                           [Usuario::class, 'update']);
    $routes->post('usuario/actualizar/cuenta',                      [Usuario::class, 'updateUser']);
    $routes->get('usuario/cuenta/(:num)',                           [Usuario::class, 'updateAccount']);
    $routes->post('usuario/actualizar',                             [Usuario::class, 'actualizar']);
    $routes->match(['get', 'post'], 'usuario/agregar/grado/(:num)', [Usuario::class, 'updateGrado']);
    $routes->get('usuario/delete/(:num)',                           [Usuario::class, 'delete']);
    
    $routes->get('curso/resultado/(:num)/(:num)',             [Curso::class, 'userEncuesta']);
});
$routes->group('rol', ['filter' => 'sessionfilter:Docente'], function($routes) {
    //Docentes
    $routes->get('curso/concluido/(:num)',                    [Curso::class, 'cursoConcluido']);
    $routes->post('curso/encuesta/guardar/(:num)',            [Curso::class, 'saveEncuesta']);//
    //$routes->get('curso/resultado/(:num)/(:num)',             [Curso::class, 'userEncuesta']);
    $routes->get('curso/visualizar/(:num)',                   [Curso::class, 'cursos']);
});
$routes->group('rol', ['filter' => 'sessionfilter:Invitado'], function($routes) {
    //Instructor
    $routes->get('curso/imparte/(:num)',                        [Curso::class, 'cursoInstructor']);
    $routes->get('curso/actividad/(:num)',                      [Curso::class, 'actividadCurso']);
    $routes->match(['get', 'post'], 'curso/sesion/(:num)',      [Curso::class, 'createSesion']);
    $routes->get('curso/carta/(:num)',                          [Curso::class, 'impCarta']);
    $routes->match(['get', 'post'], 'curso/plan/(:num)/(:num)', [Curso::class, 'createSecuencia']);
    $routes->get('curso/plan/imp/(:num)',                       [Curso::class, 'impPlan']);
    $routes->match(['get', 'post'], 'curso/reporte/(:num)',     [Curso::class, 'createReporte']);
    $routes->get('curso/final/(:num)',                          [Curso::class, 'impReporte']);
    $routes->get('curso/img/(:num)',                            [Curso::class, 'evidenciaCurso']);
    $routes->post('curso/img/guardar',                          [Curso::class, 'guardarImg']);
    $routes->get('curso/img/ver/(:num)',                        [Curso::class, 'evidenciaVer']);
    $routes->get('curso/img/eliminar/(:num)/(:num)',            [Curso::class, 'evidenciaDelete']);
});





