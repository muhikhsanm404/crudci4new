<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Mahasiswa::index');
$routes->get('/tambah', 'Mahasiswa::create');
$routes->post('/tambah', 'Mahasiswa::save');
$routes->get('/update', 'Mahasiswa::update');
$routes->get('/ubah/(:num)', 'Mahasiswa::edit');
$routes->get('/hapus/(:num)', 'Mahasiswa::delete'); 


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
