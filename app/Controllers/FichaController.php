<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class FichaController
{
    public function index()
    {
        // Busca todos os alunos com o nome do instrutor
        $fichas = App::get('database')->selectFichas();

        // Retorna a view passando os dados
        return view('site/ficha', compact('fichas'));
    }
}
