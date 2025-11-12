<?php

use App\Controllers\Tutorias\Actividad;
use App\Controllers\Tutorias\Formatos;
use App\Controllers\Tutorias\Tutorado;
use App\Controllers\Tutorias\Alumno;
use App\Controllers\Tutorias\Canalizacion;
use App\Controllers\Tutorias\Grupo;
use App\Controllers\Tutorias\Menu;
use App\Controllers\Tutorias\Periodo;
use App\Controllers\Tutorias\Tutor;

$routes->group('rol', function ($routes) {

    // --- Menu principal para acceso tutorias ---
    $routes->get('tutorado/inicio',                                [Menu::class, 'index']);

    // --- Rutas de tutorias ---
    $routes->get('tutorado/tutorias/(:num)',                                [Tutorado::class, 'showTutorias']);
    $routes->get('tutorado/tutoria/(:num)',                                 [Tutorado::class, 'showCreateTutoria']);
    $routes->post('tutorado/tutoria/(:num)',                                [Tutorado::class, 'createTutoria']);
    $routes->get('tutorado/add/alumnos/(:num)',                             [Tutorado::class, 'showAddTutorados']);
    $routes->post('tutorado/add/alumnos/(:num)',                            [Tutorado::class, 'addTutorados']);
    $routes->get('tutorado/tutor/(:num)',                                   [Tutorado::class, 'dataTutor']);

    // --- Rutas para acciones tutorados ---
    $routes->get('tutorado/tutorados/(:num)',                               [Tutorado::class, 'showTutorados']);
    $routes->post('tutorado/agregar/tutorado',                              [Tutorado::class, 'addTutorado']);
    $routes->get('tutorados/(:num)',                                        [Tutorado::class, 'findTutorados']);

    // --- Rutas exclusivas asistencia ---
    $routes->get('tutorado/tutoria/asistencia/(:num)',                      [Tutorado::class, 'showTutoriaAsistencia']);
    $routes->post('tutorado/tutoria/asistencia/(:num)',                     [Tutorado::class, 'tutoriaAsistencia']);

    // --- Rutas exclusivas acreditacion ---
    $routes->get('tutorado/tutoria/acreditar/(:num)',                       [Tutorado::class, 'showAlumAcreditado']);
    $routes->post('tutorado/tutoria/acreditar/(:num)',                      [Tutorado::class, 'alumAcreditado']);

    //$routes->get('tutorado/tutoria/tutorias/(:num)',                        [Tutorado::class, 'findTutoria']);

    // --- Rutas exclusivas TUTORES ---
    $routes->get('tutorado/mostrar',                                        [Tutorado::class, 'showTutores']);
    $routes->get('tutorado/actualizar/(:num)',                              [Tutorado::class, 'showUpdateTutor']);
    $routes->post('tutorado/update/(:num)',                                 [Tutorado::class, 'updateTutor']);

    $routes->get('tutorado/tutores',                                       [Tutor::class, 'showListaTutores']);
    $routes->get('tutorado/agregar',                                       [Tutor::class, 'showCreateTutor']);
    $routes->post('tutorado/agregar',                                      [Tutor::class, 'createTutor']);

    $routes->get('tutorado/tutor/grupos/(:num)',                            [Grupo::class, 'showGrupos']);
    $routes->get('tutorado/tutor/grupos/menu/(:num)/(:num)',                [Grupo::class, 'gruposMenu']);
    $routes->get('tutorado/add/grupo',                                      [Grupo::class, 'ShowAddGrupo']);
    $routes->post('tutorado/add/grupo',                                     [Grupo::class, 'addGrupo']);

    $routes->get('tutorado/indiviaduales/(:num)/(:num)',                            [Canalizacion::class, 'showIndividuales']);
    $routes->get('tutorado/add/individual/(:num)',                                  [Canalizacion::class, 'showAddIndividual']);
    $routes->post('tutorado/add/individual/(:num)',                                 [Canalizacion::class, 'addIndividual']);
    $routes->get('tutorado/canalizacion/(:num)/(:num)',                             [Canalizacion::class, 'showCanalizacion']);
    $routes->get('tutorado/canalizacion/alumno/(:num)/(:num)',                      [Canalizacion::class, 'alumnoCanalizacion']);
    $routes->get('tutorado/agregar/canalizacion/(:num)/(:num)',                     [Canalizacion::class, 'showAddCanalizacion']);
    $routes->post('tutorado/agregar/canalizacion/(:num)/(:num)',                    [Canalizacion::class, 'addCanalizacion']);

    $routes->get('tutorado/actividad',                                      [Actividad::class, 'showActividad']);
    $routes->post('tutorado/actividad/crear',                               [Actividad::class, 'crearActividad']);
    $routes->get('tutorado/actividad/delate/(:num)',                        [Actividad::class, 'delateActividad']);

    $routes->get('tutorado/tutorados/Informe/(:num)',                       [Formatos::class, 'impInforme']);
    $routes->get('tutorado/tutorados/Seguimiento/(:num)',                   [Formatos::class, 'impSeguimiento']);

    $routes->get('alumnos',                                                 [Alumno::class, 'showAlumnos']);
    $routes->get('alumnos/crear',                                           [Alumno::class, 'showCrearAlumno'], ['filter' => 'tutoriafilter:SuperUsuario']);
    $routes->post('alumnos/crear',                                          [Alumno::class, 'crearAlumno']);
    //$routes->get('alumnos/delate/(:num)',                                   [Alumno::class, 'delateAlumno']); --- NO EXISTE

    $routes->get('periodos',                                                [Periodo::class, 'showPeriodos']);
    $routes->get('periodos/agregar',                                        [Periodo::class, 'showAddPeriodo'], ['filter' => 'tutoriafilter:SuperUsuario']);
    $routes->post('periodos/agregar',                                       [Periodo::class, 'addPeriodo']);
    $routes->get('periodos/actualizar/(:num)',                              [Periodo::class, 'updatePeriodo'], ['filter' => 'tutoriafilter:SuperUsuario']);
    $routes->post('periodos/update',                                        [Periodo::class, 'updatePeriodo']);
});

/// Grupo de rutas para tutores
$routes->group('rol', ['filter' => 'sessionfilter:Docente'], function ($routes) {});
