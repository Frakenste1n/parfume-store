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
$route['api/login']['POST'] = 'api/auth/login';
$route['api/register']['POST'] = 'api/auth/register';

$route['api/users']['GET'] = 'api/users/index';
$route['api/users']['POST'] = 'api/users/index';
$route['api/users/(:num)']['GET'] = 'api/users/index/$1';
$route['api/users/(:num)']['PUT'] = 'api/users/index/$1';
$route['api/users/(:num)']['DELETE'] = 'api/users/index/$1';

$route['api/brands']['GET'] = 'api/brands/index';
$route['api/brands']['POST'] = 'api/brands/store';
$route['api/brands/(:num)']['GET'] = 'api/brands/show/$1';
$route['api/brands/(:num)']['PUT'] = 'api/brands/update/$1';
$route['api/brands/(:num)']['DELETE'] = 'api/brands/delete/$1';

$route['api/categories']['GET'] = 'api/categories/index';
$route['api/categories']['POST'] = 'api/categories/store';
$route['api/categories/(:num)']['GET'] = 'api/categories/show/$1';
$route['api/categories/(:num)']['PUT'] = 'api/categories/update/$1';
$route['api/categories/(:num)']['DELETE'] = 'api/categories/delete/$1';

$route['api/products']['GET'] = 'api/products/index';
$route['api/products']['POST'] = 'api/products/store';
$route['api/products/(:num)']['GET'] = 'api/products/show/$1';
$route['api/products/(:num)']['PUT'] = 'api/products/update/$1';
$route['api/products/(:num)']['DELETE'] = 'api/products/delete/$1';

$route['api/product-images']['POST'] = 'api/product_images/store';
$route['api/product-images/(:num)']['DELETE'] = 'api/product_images/delete/$1';

$route['api/banners']['GET'] = 'api/banners/index';
$route['api/banners']['POST'] = 'api/banners/store';
$route['api/banners/(:num)']['GET'] = 'api/banners/show/$1';
$route['api/banners/(:num)']['PUT'] = 'api/banners/update/$1';
$route['api/banners/(:num)']['POST'] = 'api/banners/update/$1';
$route['api/banners/(:num)']['DELETE'] = 'api/banners/delete/$1';

$route['api/settings']['GET'] = 'api/settings/index';
$route['api/settings']['PUT'] = 'api/settings/update';
$route['api/settings']['POST'] = 'api/settings/update';

$route['api/payment-methods']['GET'] = 'api/payment_methods/index';
$route['api/payment-methods']['POST'] = 'api/payment_methods/store';
$route['api/payment-methods/(:num)']['GET'] = 'api/payment_methods/show/$1';
$route['api/payment-methods/(:num)']['PUT'] = 'api/payment_methods/update/$1';
$route['api/payment-methods/(:num)']['POST'] = 'api/payment_methods/update/$1';
$route['api/payment-methods/(:num)']['DELETE'] = 'api/payment_methods/delete/$1';

$route['api/cart']['GET'] = 'api/carts/index';
$route['api/cart']['POST'] = 'api/carts/store';

$route['api/orders']['GET'] = 'api/orders/index';
$route['api/orders']['POST'] = 'api/orders/store';
$route['api/orders/(:num)']['GET'] = 'api/orders/show/$1';
$route['api/orders/(:num)']['PUT'] = 'api/orders/update/$1';
$route['api/orders/(:num)']['DELETE'] = 'api/orders/delete/$1';

$route['api/dashboard']['GET'] = 'api/dashboard/index';

//admin
$route['admin/login']='admin/login/index';
$route['admin/login/store']='admin/login/store';
$route['admin/logout']='admin/login/logout';

$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/users'] = 'admin/users/index';
$route['admin/brands'] = 'admin/brands/index';
$route['admin/categories'] = 'admin/categories/index';
$route['admin/parfume'] = 'admin/parfume/index';
$route['admin/banners'] = 'admin/banners/index';
$route['admin/payments'] = 'admin/payments/index';
$route['admin/orders'] = 'admin/orders/index';
$route['admin/setting'] = 'admin/setting/index';

//customer
$route['login'] = 'customer/auth/login';
$route['register'] = 'customer/auth/register';