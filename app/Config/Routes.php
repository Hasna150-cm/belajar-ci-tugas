<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->post('penjualan/updateStatus/(:any)', 
'TransaksiController::updateStatus/$1', ['filter' => 'auth']); 
$routes->get('penjualan', 'Home::penjualan', ['filter' => 'auth']); 

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);

$routes->post('transaksi/uploadBukti/(:num)', 'TransaksiController::uploadBukti/$1', ['filter' => 'auth']);
$routes->get('laporan/pendapatan', 'LaporanController::pendapatan', ['filter' => 'auth']);
$routes->get('laporan/exportExcel', 'LaporanController::exportExcel', ['filter' => 'auth']);
$routes->get('laporan/exportPDF', 'LaporanController::exportPDF', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);
