<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class AlunosController
{
    public function index()
    {
        // Busca todos os alunos com o nome do instrutor
        $alunos = App::get('database')->selectAlunosWithName();

        // Retorna a view passando os dados
        return view('site/index', compact('alunos'));
    }
}
