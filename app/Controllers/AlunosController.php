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

    public function criarAluno() {
    $usuarioId = App::get('database')->criarUsuario([
        'nome'=> $_POST['nome'],
        'cpf' => $_POST['cpf'],
        'email'=> $_POST['email'],
        'senha'=> $_POST['senha'], 
        'telefone' => $_POST['telefone']
    ]);

    App::get('database')->criarAluno($usuarioId, $_POST['objetivo']);

    header("Location: /");
    }

    public function formAdicionarAluno() {
        return view('site/criarAluno');
    }
}
