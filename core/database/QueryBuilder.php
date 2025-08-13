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
        $this->pdo->beginTransaction();

        // 1. Verifica se é aluno
        $stmtCheckAluno = $this->pdo->prepare("SELECT COUNT(*) FROM aluno WHERE id = :id");
        $stmtCheckAluno->execute(['id' => $id]);
        $isAluno = $stmtCheckAluno->fetchColumn();

        if (!$isAluno) {
            throw new Exception("Apenas alunos podem ser excluídos por esta função.");
        }

        // 2. Verifica se é gerente (bloqueia a exclusão de usuário)
        $stmtCheckGerente = $this->pdo->prepare("SELECT COUNT(*) FROM gerente WHERE cod_func = :id");
        $stmtCheckGerente->execute(['id' => $id]);
        $isGerente = $stmtCheckGerente->fetchColumn();

        if ($isGerente) {
            throw new Exception("Este usuário também é um gerente e não pode ser excluído por esta função.");
        }

        // 3. Verifica e exclui ficha (e relacionamentos)
        $stmtFicha = $this->pdo->prepare("SELECT id_ficha FROM ficha WHERE id_aluno = :id");
        $stmtFicha->execute(['id' => $id]);
        $ficha = $stmtFicha->fetch(PDO::FETCH_OBJ);

        if ($ficha) {
            $stmtSessoes = $this->pdo->prepare("SELECT id_sessao FROM sessaotreino WHERE id_ficha = :id_ficha");
            $stmtSessoes->execute(['id_ficha' => $ficha->id_ficha]);
            $sessoes = $stmtSessoes->fetchAll(PDO::FETCH_OBJ);

            foreach ($sessoes as $sessao) {
                $stmtDelSessaoTreino = $this->pdo->prepare("DELETE FROM sessao_treino WHERE id_sessao = :id_sessao");
                $stmtDelSessaoTreino->execute(['id_sessao' => $sessao->id_sessao]);
            }

            $stmtDelSessoes = $this->pdo->prepare("DELETE FROM sessaotreino WHERE id_ficha = :id_ficha");
            $stmtDelSessoes->execute(['id_ficha' => $ficha->id_ficha]);

            $stmtDelFicha = $this->pdo->prepare("DELETE FROM ficha WHERE id_ficha = :id_ficha");
            $stmtDelFicha->execute(['id_ficha' => $ficha->id_ficha]);
        }

        // 4. Exclui dieta
        $stmtDieta = $this->pdo->prepare("DELETE FROM dieta WHERE id_aluno = :id");
        $stmtDieta->execute(['id' => $id]);

        // 5. Exclui aluno
        $stmtDelAluno = $this->pdo->prepare("DELETE FROM aluno WHERE id = :id");
        $stmtDelAluno->execute(['id' => $id]);

        // 6. Exclui usuário
        $stmtDelUsuario = $this->pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
        $stmtDelUsuario->execute(['id' => $id]);

        $this->pdo->commit();
    } catch (Exception $e) {
        $this->pdo->rollBack();
        throw new Exception("Erro ao excluir usuário: " . $e->getMessage());
    }
}

    public function selectAllSearch($table, array $param, $inicio = null, $contagem_linhas = null){
        $key=null;
        $value=null;
        foreach($param as $keyB=>$valueB){
              $key=$keyB;
              $value=$valueB;
        }
        $sql ="SELECT * FROM {$table} WHERE $key LIKE ?";

        if ($inicio >=0 && $contagem_linhas > 0) {
            $sql .= " LIMIT {$inicio}, {$contagem_linhas}";
        }

        $titleValue='%'.$value.'%';
        try{
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$titleValue);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (Exception $e) {
            die($e->getMessage());
           }
    }

    public function selectAlunosComNomeSearch($param)
{
    $sql = "SELECT 
                a.*, 
                u.nome AS user_nome,
                f.id_ficha AS id_ficha
            FROM aluno a
            INNER JOIN usuario u ON a.id = u.id_usuario
            LEFT JOIN ficha f ON f.id_aluno = a.id
            WHERE u.nome LIKE :nome
            ORDER BY a.id ASC";

    $statement = $this->pdo->prepare($sql);
    $statement->execute([
        'nome' => '%' . $param['nome'] . '%'
    ]);

    return $statement->fetchAll(PDO::FETCH_OBJ);
}





}