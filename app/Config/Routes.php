<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('admin/', 'AdminLogin::index');
$routes->post('admin/auth', 'AdminLogin::auth');
$routes->get('admin/logout', 'AdminLogin::logout');
$routes->get('admin/calon', 'Calon::index',['filter' => 'authAdmin']);
$routes->get('admin/calon/tambah', 'Calon::tambah',['filter' => 'authAdmin']);
$routes->post('admin/calon/save', 'Calon::save',['filter' => 'authAdmin']);
$routes->get('admin/calon/save', 'Calon::save',['filter' => 'authAdmin']);
$routes->post('admin/calon/update', 'Calon::update',['filter' => 'authAdmin']);
$routes->get('admin/calon/update', 'Calon::update',['filter' => 'authAdmin']);
$routes->get('admin/calon/delete/(:any)', 'Calon::delete/$1',['filter' => 'authAdmin']);
$routes->get('admin/calon/edit/(:any)', 'Calon::edit/$1',['filter' => 'authAdmin']);

$routes->get('admin/pemilih', 'Pemilih::index',['filter' => 'authAdmin']);
$routes->get('admin/pemilih/tambah', 'Pemilih::tambah',['filter' => 'authAdmin']);
$routes->get('admin/pemilih/save', 'Pemilih::save',['filter' => 'authAdmin']);
$routes->post('admin/pemilih/save', 'Pemilih::save',['filter' => 'authAdmin']);
$routes->get('admin/pemilih/edit/(:any)', 'Pemilih::edit/$1',['filter' => 'authAdmin']);

$routes->get('admin/laporan', 'Laporan::index',['filter' => 'authAdmin']);
$routes->get('admin/laporan/export', 'Laporan::export',['filter' => 'authAdmin']);
$routes->get('admin/export', 'Laporan::view',['filter' => 'authAdmin']);

$routes->get('/', 'Login::index');
$routes->get('/voting', 'Voting::index',['filter' => 'auth']);
$routes->get('/voting/profil/(:any)', 'Voting::profil/$1',['filter' => 'auth']);
$routes->get('/voting/(:any)', 'Voting::vote/$1',['filter' => 'auth']);
$routes->get('/perolehan_suara', 'PerolehanSuara::index',['filter' => 'auth']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
