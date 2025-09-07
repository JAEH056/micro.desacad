<?php

namespace Config;

use App\Controllers\Login;
use App\Controllers\Page;
use App\Controllers\Home;
use App\Controllers\Principal;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultNamespace('App\Controllers\Actualizacion');
$routes->setDefaultNamespace('App\Controllers\Tutorias');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don'st have to scan directories.
$routes->group('da',  function($routes) {
    require('Routes_DA.php');
});

$routes->group('ta', static function($routes) {
    require('Routes_TA.php');
});

$routes->match(['get', 'post'],'/',          [Login::class, 'login']);
$routes->get('login/sesion1',                [Login::class, 'login']);
$routes->get('menu_principal',                [Principal::class, 'index']);

$routes->get('pagina/choose',                [Page::class, 'choose']);

$routes->get('logout',                       [Login::class, 'logout']);
//Ejemplo de ruta con filtro de permisos
$routes->group('rol', ['filter' => 'sessionfilter:asesor'], function($routes) {
    $routes->get('usuarioi/pagina/choose',     [Page::class, 'choose'], ['filter' => 'sessionfilter:asesor']);
});




//$routes->match(['get', 'post'], 'news/create', [News::class, 'create']);
//$routes->get( 'news/update/show/(:num)',       [News::class, 'updateShow']);
//$routes->post('news/update/edit',              [News::class, 'updateEdit']);
//$routes->post('news/editar',                   [News::class, 'update']);
//$routes->get('/',                              [Home::class, 'index']);
//$routes->get('news',                           [News::class, 'index']);
//$routes->get('news/index/delete/(:num)',       [News::class, 'delete']);
//$routes->get('news/(:segment)',              [News::class, 'view']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
//if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
//    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
//}
