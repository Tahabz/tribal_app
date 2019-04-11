<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Manager routes
$route['manager/dashboard'] = 'manager/show';
$route['manager'] = 'manager/index';
$route['manager/decline/(:any)'] = 'manager/decline/$1';
$route['manager/accept/(:any)'] = 'manager/accept/$1';

// Chef Equipe routes
$route['chef/dashboard'] = 'team_chef/show';
$route['chef'] = 'Team_chef/index';
$route['chef/decline/(:any)'] = 'team_chef/decline/$1';
$route['chef/accept/(:any)'] = 'team_chef/accept/$1';

// Shared routes
$route['conge'] = 'users/index';
$route['login'] = 'users/login';

//salaried routes
$route['salaried'] = 'salaried/index';


$route['default_controller'] = 'users/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
