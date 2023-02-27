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
$routes->get('/(:num)/ubah', 'Mahasiswa::edit/$1');
$routes->put('/(:num)/update', 'Mahasiswa::update/$1');
$routes->get('/(:num)/hapus', 'Mahasiswa::delete/$1'); 


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
