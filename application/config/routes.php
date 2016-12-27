<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Auth Route
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['recover'] = 'auth/recover';

//Properties Route
$route['properties'] = 'properties/index';
$route['properties/create'] = 'properties/create';
$route['properties/order'] = 'properties/order';
$route['properties/edit/(:any)'] = 'properties/edit/$1';
$route['properties/update'] = 'properties/update';
$route['properties/delete/(:any)'] = 'properties/destroy/$1';
$route['properties/(:any)'] = 'properties/view/$1';

//Oders Route
$route['orders/create'] = 'orders/create';
$route['orders'] = 'orders/index';

//Static Pages Route
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

//Default Route
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
