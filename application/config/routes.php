<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//api
$route['api/test'] = 'api/test';
$route['api/login']['POST'] = 'api/auth/login';

$route['api/users']['GET']    = 'api/users/index';
$route['api/users/(:num)']['GET'] = 'api/users/detail/$1';
$route['api/users']['POST']   = 'api/users/index';
$route['api/users/(:num)']['PUT']    = 'api/users/index/$1';
$route['api/users/(:num)']['DELETE'] = 'api/users/index/$1';

$route['api/parfumes']['GET'] = 'api/parfumes/index';
$route['api/parfumes']['POST'] = 'api/parfumes/index';
$route['api/parfumes/(:num)']['GET'] = 'api/parfumes/detail/$1';
$route['api/parfumes/(:num)']['PUT'] = 'api/parfumes/index/$1';
$route['api/parfumes/(:num)']['DELETE'] = 'api/parfumes/index/$1';

$route['api/categories']['GET'] = 'api/categories/index';
$route['api/categories/(:num)']['GET'] = 'api/categories/detail/$1';
$route['api/categories']['POST'] = 'api/categories/index';
$route['api/categories/(:num)']['PUT'] = 'api/categories/index/$1';
$route['api/categories/(:num)']['DELETE'] = 'api/categories/index/$1';

$route['api/orders']['POST'] = 'api/orders/index';
$route['api/orders']['GET'] = 'api/orders/index';
$route['api/orders']['POST'] = 'api/orders/index';
$route['api/orders/(:num)']['DELETE'] = 'api/orders/index/$1';
$route['api/orders/detail/(:num)']['GET'] = 'api/orders/detail/$1';
$route['api/orders/status/(:num)']['PUT'] = 'api/orders/status/$1';

$route['api/settings']['GET'] = 'api/settings/index';
$route['api/settings']['POST'] = 'api/settings/index';

$route['api/brands']['GET'] = 'api/brands/index';
$route['api/brands']['POST'] = 'api/brands/index';
$route['api/brands/(:num)']['GET'] = 'api/brands/show/$1';
$route['api/brands/update/(:num)']['POST'] = 'api/brands/update/$1';
$route['api/brands/delete/(:num)']['POST']
    = 'api/brands/delete/$1';
$route['api/brands/dropdown']['GET'] = 'api/brands/dropdown';
$route['api/brands/featured']['GET'] = 'api/brands/featured';

$route['api/payments']['GET'] = 'api/payments/index';
$route['api/payments/(:num)']['GET'] = 'api/payments/detail/$1';
$route['api/payments']['POST'] = 'api/payments/index';
$route['api/payments/(:num)']['PUT'] = 'api/payments/index/$1';
$route['api/payments/(:num)']['DELETE'] = 'api/payments/index/$1';

//admin
$route['admin/login'] = 'admin/auth';
$route['admin/dashboard'] = 'admin/dashboard';
$route['users/users'] = 'admin/users';
$route['admin/brands'] = 'admin/brands';
$route['admin/parfumes'] = 'admin/parfumes';