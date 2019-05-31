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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['authentication'] = 'authentication/auth';

$route['authentication/logout'] 		= 'authentication/auth/logout';
$route['authentication/admin/reset'] 	= 'authentication/auth/resetpass';
$route['authentication/blocked'] 		= 'authentication/auth/blocked';

$route['backend/user/view-profile'] 			= 'backend/user/profile';
$route['backend/user/view-changepassword'] 		= 'backend/user/changepassword';

$route['backend/user/view-role'] 				= 'backend/user/role';
$route['backend/user/delete-role/(:any)'] 		= 'backend/user/deleterole';
$route['backend/user/edit-role'] 				= 'backend/user/editrole';

$route['backend/menu/view-mastermenu'] 			= 'backend/menu/mastermenu';
$route['backend/menu/delete-mastermenu/(:any)'] = 'backend/menu/deletemastermenu';
$route['backend/menu/edit-mastermenu'] 			= 'backend/menu/editmastermenu';

$route['backend/menu/view-menu'] 				= 'backend/menu';
$route['backend/menu/delete-menu/(:any)'] 		= 'backend/menu/deletemenu';
$route['backend/menu/edit-menu'] 				= 'backend/menu/editmenu';

$route['backend/menu/view-submenu'] 			= 'backend/menu/submenu';
$route['backend/menu/delete-submenu/(:any)'] 	= 'backend/menu/deletesubmenu';
$route['backend/menu/edit-submenu'] 			= 'backend/menu/editsubmenu';