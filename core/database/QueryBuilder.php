<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $sql = "select * from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectAlunosWithName()
    {
        $sql = "
            SELECT 
                a.*, 
                u.nome AS user_nome,
                f.id_ficha AS id_ficha
            FROM aluno a
            JOIN usuario u 
                ON a.id = u.id_usuario
            LEFT JOIN ficha f 
                ON f.id_aluno = a.id
            ORDER BY a.id ASC
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectFichas(){
        $sql = "SELECT f.*, u.nome AS nome_aluno, i.cod_func AS codigo_instrutor
                FROM ficha f
                JOIN usuario u ON f.id_aluno = u.id_usuario
                JOIN instrutor i ON f.cod_instrutor = i.cod_func
                ORDER BY f.data_criacao ASC
        ";

         try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectTreino($id){
        $sql = "
            SELECT 
            u.nome AS nome_aluno,
            f.id_ficha,
            t.nome AS nome_treino,
            e.nome AS nome_exercicio,
            te.series,
            te.repeticoes,
            te.carga
            FROM Ficha f
            JOIN Usuario u ON u.id_usuario = f.id_aluno
            JOIN Sessao_Treino stt ON stt.id_ficha = f.id_ficha
            JOIN Treino t ON t.id_treino = stt.id_treino
            JOIN Treino_Exercicio te ON te.id_treino = t.id_treino
            JOIN Exercicio e ON e.id_exercicio = te.id_exercicio
            WHERE f.id_ficha = {$id};
        ";

          try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

   public function criarUsuario($parametros) {
        $sql = "INSERT INTO Usuario (nome, cpf, email, senha, telefone) 
                VALUES (:nome, :cpf, :email, :senha, :telefone)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            // retorna o id do usuário criado
            return $this->pdo->lastInsertId();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function criarAluno($idUsuario, $objetivo) {
        $sql = "INSERT INTO Aluno (id, objetivo) VALUES (:id, :objetivo)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $idUsuario,
                'objetivo' => $objetivo
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}