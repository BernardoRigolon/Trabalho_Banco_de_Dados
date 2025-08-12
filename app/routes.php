<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'AlunosController@index');
$router->get('ficha', 'FichaController@index');
$router->get('fichaIndividual', 'FichaIndividualController@mostraFichaIndividual');