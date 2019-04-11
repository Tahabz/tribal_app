<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$route["getproduct/(:any)/(:num)"]="main/changequestion/$1/$2"

// Manager routes
$route['manager/dashboard'] = 'manager/show';
$route['manager'] = 'manager/index';
$route['manager/decline/'] = 'manager/decline';
$route['manager/accept/(:any)/(:any)'] = 'manager/accept/$1/$2';

// Chef Equipe routes
$route['chef/dashboard'] = 'team_chef/show';
$route['chef'] = 'Team_chef/index';
$route['chef/decline'] = 'team_chef/decline';
$route['chef/accept/(:any)/(:any)'] = 'team_chef/accept/$1/$2';

// Shared routes
$route['conge'] = 'users/index';
$route['login'] = 'users/login';
$route['dashboard'] = 'users/show';
//salaried routes
$route['salaried'] = 'salaried/index';


$route['default_controller'] = 'users/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
