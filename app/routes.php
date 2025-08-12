<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'AlunosController@index');
$router->get('ficha', 'FichaController@index');
$router->get('fichaIndividual', 'FichaIndividualController@mostraFichaIndividual');
$router->get('adicionarAluno', 'AlunosController@formAdicionarAluno');
$router->get('editarAluno', 'AlunosController@formEditarAluno');
$router->post('editarAluno', 'AlunosController@editarAluno');
$router->post('adicionarAluno', 'AlunosController@criarAluno');