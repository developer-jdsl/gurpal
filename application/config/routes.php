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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['cart']			=	'home/cart';
$route['checkout']		=	'home/checkout';
$route['city/(:any)']	=	'home/get_listings_by_city/$1';
$route['city/(:any)']	=	'home/city/$1';

/*  Service Routes */

$route['city/(:any)/service/(:any)']				=	'service/$2/$1';
$route['city/(:any)/services/(:any)/(:num)']		=	'service/list/$1/$2/$3';
$route['city/(:any)/services/(:any)']				=	'service/list/$1/$2/0';
$route['city/(:any)/services']						=	'service/list/$1/all/0';

/* Product Routes */

$route['products/(:any)/(:num)']		=	'product/list/$1/$2';
$route['products/(:any)']				=	'product/list/$1/0';
$route['products']						=	'product/list/all/0';

$route['my-wishlist']					=	'home/my_wishlist';
$route['my-account']					=	'home/my_account';
$route['my-orders']						=	'home/my_orders';
$route['my-orders/(:any)']				=	'home/my_orders/$1';

$route['my-addresses']					=	'home/my_addresses';
$route['add-address']					=	'home/add_address';
$route['edit-address']					=	'home/edit_address';

$route['logout']						=	'home/logout';
