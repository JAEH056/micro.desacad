<?php

use App\Controllers\Tutorias\Tutorado;
use App\Controllers\Tutorias\Alumno;
use App\Controllers\Tutorias\Periodo;

$routes->get('tutorado/mostrar',                                        [Tutorado::class, 'showTutores']);
$routes->get('tutorado/tutorias/(:num)/(:num)',                         [Tutorado::class, 'showTutorias']);
$routes->match(['get','post'],'tutorado/tutoria/(:num)',                [Tutorado::class, 'createTutoria']);
$routes->match(['get','post'],'tutorado/add/grupo',                     [Tutorado::class, 'addGrupo']);
$routes->match(['get','post'],'tutorado/add/alumnos/(:num)',            [Tutorado::class, 'addTutorados']);
$routes->get('tutorado/tutores',                                        [Tutorado::class, 'tutores']);
$routes->get('tutorado/actualizar/(:num)',                              [Tutorado::class, 'updateTutor']);
$routes->post('tutorado/update',                                        [Tutorado::class, 'updateTutor']);
$routes->match(['get','post'],'tutorado/agregar',                       [Tutorado::class, 'createTutor']);
$routes->get('tutorado/tutor/(:num)',                                   [Tutorado::class, 'dataTutor']);
$routes->get('tutorado/tutor/grupos/(:num)',                            [Tutorado::class, 'showGrupos']);
$routes->get('tutorado/tutor/grupos/menu/(:num)/(:num)',                [Tutorado::class, 'gruposMenu']);
$routes->get('tutorado/tutorados/(:num)',                        [Tutorado::class, 'showTutorados']);
$routes->get('tutorado/indiviaduales/(:num)/(:num)',                    [Tutorado::class, 'showIndividuales']);
$routes->match(['get', 'post'],'tutorado/agregar/tutorado',             [Tutorado::class, 'addTutorado']);
$routes->get('tutorados/(:num)',                                        [Tutorado::class, 'findTutorados']);
$routes->match(['get', 'post'],'tutorado/add/individual/(:num)',        [Tutorado::class, 'addIndividual']);
$routes->get('tutorado/canalizacion/(:num)/(:num)',                     [Tutorado::class, 'showCanalizacion']);
$routes->get('tutorado/canalizacion/alumno/(:num)/(:num)',              [Tutorado::class, 'alumnoCanalizacion']);
$routes->match(['get', 'post'],'tutorado/agregar/canalizacion/(:num)/(:num)', [Tutorado::class, 'addCanalizacion']);
$routes->get('tutorado/actividad',                                      [Tutorado::class, 'showActividad']);
$routes->post('tutorado/actividad/crear',                               [Tutorado::class, 'crearActividad']);
$routes->get('tutorado/actividad/delate/(:num)',                        [Tutorado::class, 'delateActividad']);
$routes->get('tutorado/tutoria/tutorias/(:num)',                        [Tutorado::class, 'findTutoria']);
$routes->match(['get', 'post'],'tutorado/tutoria/asistencia/(:num)',    [Tutorado::class, 'tutoriaAsistencia']);
$routes->match(['get', 'post'],'tutorado/tutoria/acreditar/(:num)',     [Tutorado::class, 'alumAcreditado']);

$routes->get('tutorado/tutorados/Informe/(:num)',                       [Tutorado::class, 'impInforme']);
$routes->get('tutorado/tutorados/Seguimiento/(:num)',                   [Tutorado::class, 'impSeguimiento']);

$routes->get('alumnos',                                                 [Alumno::class, 'showAlumnos']);
$routes->match(['get', 'post'],'alumnos/crear',                         [Alumno::class, 'crearAlumno']);
$routes->get('alumnos/delate/(:num)',                                   [Alumno::class, 'delateAlumno']);

$routes->get('periodos',                                                [Periodo::class, 'showPeriodos']);
$routes->match(['get', 'post'],'periodos/agregar',                      [Periodo::class, 'addPeriodo']);
$routes->get('periodos/actualizar/(:num)',                              [Periodo::class, 'updatePeriodo']);
$routes->post('periodos/update',                                        [Periodo::class, 'updatePeriodo']);

