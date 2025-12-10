<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend Routes
$routes->get('/', 'Site::index');
$routes->get('site/kanal/(:any)', 'Site::kanal/$1');
$routes->get('site/detail/(:num)/(:any)', 'Site::detail/$1/$2');
$routes->get('site/studio_detail/(:num)', 'Site::studio_detail/$1');

// Auth Routes
$routes->get('auth', 'Auth::index');
$routes->get('auth/index', 'Auth::index');
$routes->get('auth/registrasi', 'Auth::registrasi');
$routes->get('auth/waiting_list', 'Auth::waiting_list');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('auth/booking/(:num)', 'Auth::booking/$1');
$routes->get('auth/booking/(:num)', 'Auth::booking/$1');
$routes->get('auth/invoice/(:num)', 'Auth::invoice/$1');
$routes->post('auth/proses_konfirmasi', 'Auth::proses_konfirmasi');

// Admin Dashboard Routes
$routes->group('administrator', function ($routes) {
    $routes->get('/', 'Administrator::index');
    $routes->get('activation_account/(:num)', 'Administrator::activation_account/$1');
    $routes->get('activation_news', 'Administrator::activation_news');
    $routes->get('activation_event', 'Administrator::activation_event');
    $routes->get('studio', 'Administrator::studio');
    $routes->get('jadwal', 'Administrator::jadwal');
    $routes->get('booking', 'Administrator::booking');
    $routes->get('booking_history', 'Administrator::booking_history');
    $routes->get('event', 'Administrator::event');
    $routes->get('add_event', 'Administrator::add_event');
    $routes->get('edit_event/(:num)', 'Administrator::edit_event/$1');
    $routes->get('news', 'Administrator::news');
    $routes->get('add_news', 'Administrator::add_news');
    $routes->get('edit_news/(:num)', 'Administrator::edit_news/$1');
    $routes->get('profile/(:num)', 'Administrator::profile/$1');
    $routes->get('about', 'Administrator::about');
    $routes->get('edit_about/(:num)', 'Administrator::edit_about/$1');
    $routes->get('gallery', 'Administrator::gallery');
    $routes->get('advertise', 'Administrator::advertise');
    $routes->get('report_profile', 'Administrator::report_profile');
    $routes->get('report_studio', 'Administrator::report_studio');
    $routes->get('report_berita', 'Administrator::report_berita');
    $routes->get('report_event', 'Administrator::report_event');
    $routes->get('user', 'Administrator::user');
    $routes->get('category', 'Administrator::category');
    $routes->get('chart/(:any)', 'Administrator::chart/$1');
    $routes->get('pengaduan', 'Administrator::pengaduan');
    $routes->get('user_booking', 'Administrator::user_booking');
});

// Config Routes - Public registration
$routes->post('configs/proses_registrasi', 'Configs::proses_registrasi');

// Config Routes - Protected operations
$routes->group('configs', function ($routes) {
    // Gallery
    $routes->get('add_galeri', 'Configs::add_galeri');
    $routes->post('add_galeri', 'Configs::add_galeri');
    $routes->get('delete_galeri/(:num)', 'Configs::delete_galeri/$1');
    $routes->get('edit_galeri/(:num)', 'Configs::edit_galeri/$1');
    $routes->post('edit_galeri', 'Configs::edit_galeri');
    
    // News
    $routes->post('add_berita', 'Configs::add_berita');
    $routes->get('delete_berita/(:num)', 'Configs::delete_berita/$1');
    $routes->post('update_berita', 'Configs::update_berita');
    
    // Events
    $routes->post('add_event', 'Configs::add_event');
    $routes->post('update_event', 'Configs::update_event');
    $routes->get('delete_event/(:num)', 'Configs::delete_event/$1');
    
    // Complaints
    $routes->post('add_keluhan', 'Configs::add_keluhan');
    $routes->get('delete_keluhan/(:num)', 'Configs::delete_keluhan/$1');
    
    // Equipment
    $routes->post('add_alat', 'Configs::add_alat');
    $routes->post('update_alat', 'Configs::update_alat');
    $routes->get('delete_alat/(:num)', 'Configs::delete_alat/$1');
    
    // Studios
    $routes->get('add_studio', 'Configs::add_studio');
    $routes->post('add_studio', 'Configs::add_studio');
    $routes->post('update_studio', 'Configs::update_studio');
    
    // Activations
    $routes->get('aktivasi_akun/(:any)/(:num)', 'Configs::aktivasi_akun/$1/$2');
    $routes->get('aktivasi_konten/(:any)/(:num)', 'Configs::aktivasi_konten/$1/$2');
    
    // About
    $routes->post('add_tentang', 'Configs::add_tentang');
    $routes->post('update_tentang', 'Configs::update_tentang');
    
    // User
    $routes->post('update_user', 'Configs::update_user');
    
    // Schedules
    $routes->get('add_jadwal', 'Configs::add_jadwal');
    $routes->post('add_jadwal', 'Configs::add_jadwal');
    $routes->get('update_jadwal/(:num)', 'Configs::update_jadwal/$1');
    
    // Bookings
    $routes->post('proses_booking', 'Configs::proses_booking');
    $routes->get('book_persetujuan/(:num)', 'Configs::book_persetujuan/$1');
    $routes->get('rekomendasi_studio/(:num)', 'Configs::rekomendasi_studio/$1');
});

// API Routes
$routes->group('api', function ($routes) {
    // Profile resource routes (RESTful)
    $routes->resource('profile', [
        'controller' => 'Api\Profile',
        'except'     => 'new,edit'
    ]);
    
    // Additional profile routes
    $routes->get('profile/all', 'Api\Profile::all');
    $routes->get('profile/search/(:any)/(:any)', 'Api\Profile::search/$1/$2');
});

