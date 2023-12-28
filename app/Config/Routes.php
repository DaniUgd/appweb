<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/register', 'Home::register');
$routes->get('/cuenta_no_valida', 'Home::cuenta_no_valida');
$routes->get('/homepage', 'Home::homepage');

//Controlar existencia de correo escrito en vista register
$routes->post('email/check', 'Home::checkEmail');

//Registrar usuario
$routes->post('home/insert_usuario', 'Home::insert_usuario');

//Validar correo electronico
$routes->post('home/validar_email', 'Home::validar_email');
$routes->get('home/confirmar_mail', 'Home::confirmar_mail');

//Controlar inicio de sesion
$routes->post('home/iniciar_sesion', 'Home::iniciar_sesion');
$routes->post('home/cerrar_sesion', 'Home::cerrar_sesion');

//Modificar datos del perfil
$routes->get('home/cargar_datos', 'Home::cargar_datos');
$routes->post('home/guardar_datos', 'Home::guardar_datos');

//Consultas de peliculas
$routes->get('home/consult_recomendadas', 'Home::consult_recomendadas');
$routes->get('home/consult_peliculaID', 'Home::consult_peliculaID');
$routes->get('home/consult_comentarioID', 'Home::consult_comentarioID');
$routes->get('home/consult_peliculaNAME', 'Home::consult_peliculaNAME');
$routes->get('home/consult_peliculaCATEGORIA', 'Home::consult_peliculaCATEGORIA');

$routes->post('home/insert_pelicula', 'Home::insert_pelicula');
$routes->get('home/select_pelicula', 'Home::select_pelicula');
$routes->delete('home/delete_pelicula', 'Home::delete_pelicula');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
