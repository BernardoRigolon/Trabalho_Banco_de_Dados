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

    public function formEditarAluno()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("ID do aluno não informado!");
        }

        $aluno = App::get('database')->buscarAlunoPorId($id);
        return view('site/editarAluno', compact('aluno'));
    }


   public function editarAluno()
    {
        try {

            $id = $_POST['id_usuario'];
            // Edita os dados do usuário
            App::get('database')->editarUsuario([
                'nome' => $_POST['nome'],
                'cpf' => $_POST['cpf'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
                'telefone' => $_POST['telefone']
            ], $id);

            // Edita os dados específicos do aluno
            App::get('database')->editarAluno($id, $_POST['objetivo']);

            // Redireciona para a página inicial ou de listagem
            header("Location: /");
            exit;
        } catch (Exception $e) {
            die("Erro ao editar aluno: " . $e->getMessage());
        }
    }

}
