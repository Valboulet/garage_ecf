<?php
require '../vendor/autoload.php';

$router = new App\Router(dirname(__DIR__) . '/views');
$router
  ->get('/', 'post/index', 'home')
  ->get('/vehicles', 'post/vehicles', 'vehicles')
  ->get('/vehicle/[*:make]-[i:ad_number]', 'post/vehicle', 'vehicle')
  ->get('/contact', 'post/contact', 'contact')
  ->get('/admin', 'admin/post/index', 'admin')
  ->get('/admin/accounts', 'admin/post/accounts', 'accounts')
  ->get('/admin/messages', 'admin/post/messages', 'messages')
  ->get('/admin/services', 'admin/post/services', 'services')
  ->get('/admin/testimonials', 'admin/post/testimonials', 'testimonials')
  ->get('/admin/cars', 'admin/post/cars', 'cars')
  ->run('layouts/default-front.php');