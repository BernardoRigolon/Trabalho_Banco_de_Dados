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

  public function editarUsuario($parametros, $id) {
        $sql = "UPDATE Usuario 
                SET nome = :nome, 
                    cpf = :cpf, 
                    email = :email, 
                    senha = :senha, 
                    telefone = :telefone
                WHERE id_usuario = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $parametros['id'] = $id;
            $stmt->execute($parametros);

            // Para UPDATE não há ID novo, então só retorna true/false
            return $stmt->rowCount(); // número de linhas alteradas
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function editarAluno($idUsuario, $objetivo) {
        $sql = "UPDATE Aluno 
                SET objetivo = :objetivo
                WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $idUsuario,
                'objetivo' => $objetivo
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function buscarAlunoPorId($id)
    {
        $sql = "SELECT u.id_usuario, u.nome, u.cpf, u.email, u.telefone,
                    a.objetivo
                FROM Usuario u
                INNER JOIN Aluno a ON u.id_usuario = a.id
                WHERE u.id_usuario = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array associativo
        } catch (Exception $e) {
            die("Erro ao buscar aluno: " . $e->getMessage());
        }
    }

    public function excluirUsuario($id)
    {
        try {
            // Excluir dados dependentes primeiro (exemplo: aluno)
            $sqlAluno = "DELETE FROM Aluno WHERE id = :id";
            $stmtAluno = $this->pdo->prepare($sqlAluno);
            $stmtAluno->execute(['id' => $id]);

            // Depois excluir usuário
            $sqlUsuario = "DELETE FROM Usuario WHERE id_usuario = :id";
            $stmtUsuario = $this->pdo->prepare($sqlUsuario);
            $stmtUsuario->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir usuário: " . $e->getMessage());
        }
    }

}