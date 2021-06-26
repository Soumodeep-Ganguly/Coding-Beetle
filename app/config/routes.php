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
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['index'] = 'site/index'; 
$route['programming'] = 'site/programming';
$route['programming/(:any)'] = 'site/program_detail/$1';
$route['programming/(:num)/(:any)/(:any)'] = 'site/program_topic/$1/$2/$3';
$route['about'] = 'site/about';
$route['search'] = 'site/search';
$route['ask-question'] = 'site/ask_question';
$route['questions'] = 'site/questions';
$route['questions/(:num)'] = 'site/questions/$1';
$route['questions/view/(:num)'] = 'site/show_questions/$1';
$route['answer'] = 'site/answer';
$route['my-questions'] = 'site/my_questions';
$route['my-questions/(:num)'] = 'site/my_questions/$1';
$route['my-answers'] = 'site/my_answers';
$route['my-answers/(:num)'] = 'site/my_answers/$1';
$route['delete-question/(:num)'] = 'site/delete_question/$1';
$route['delete-answer/(:num)'] = 'site/delete_answer/$1';

$route['login'] = 'login/index';
$route['logout'] = 'admin/logout';
$route['ulogout'] = 'site/logout';
$route['registration'] = 'registration/index';
$route['admin/registration'] = 'registration/register';

$route['admin/add'] = 'admin/add_data';
$route['admin/my'] = 'admin/my_data';
$route['admin/my/(:num)'] = 'admin/my_data/$1';
$route['admin/view/(:any)'] = 'admin/view_subject/$1';
$route['admin/view/(:num)/(:any)/(:any)'] = 'admin/view_topic/$1/$2/$3';
$route['admin/delete/(:any)'] = 'admin/delete_topic/$1';
$route['admin/edit/(:any)'] = 'admin/edit_topic/$1';

$route['admin/add_subject']['post'] = 'admin/add_subject';