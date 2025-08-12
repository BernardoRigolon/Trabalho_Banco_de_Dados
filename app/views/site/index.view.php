<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=visibility" />
    <link rel="stylesheet" href="/app/views/site/home.css">
</head>
<body>
    <div class="back">
        <div style="width: 100%; display: flex; justify-content: center; gap:2%; margin-top:50px;">
            <button type="submit" style="background-color: yellow; padding: 15px; cursor: pointer; font-size:30px;"><a href="/" style="text-decoration: none; color: black;">Alunos</a></button>
            <button style="background-color: red; padding: 15px; cursor: pointer; font-size:30px;"><a href="/ficha" style="text-decoration: none; color: black;">Fichas</a></button>
        </div>
        <h1 class="titulo">Gerenciamento de Alunos</h1>
        <div class="caixona">
        <div style="display: flex; width: 100%; justify-content:space-between; padding-bottom:2%">
        <div style="width: 30%; align-items:center; display:flex;"><input class="pesquisa" placeholder="Pesquisar"/><button style="text-decoration: none; color: black; cursor: pointer;" class="material-icons">search</button></div>
        <button type="submit" style="background-color: yellow; padding: 10px; cursor: pointer; font-size:20px; justify-self:end; display: flex;"><a href="/adicionarAluno" style="text-decoration: none; color: black;">Criar Aluno</a></button>
        </div>
        <div class="box">
            <table class="table">
                <thead>
                    <tr class="th">
                        <th>ID Aluno</th>
                        <th>Nome</th>
                        <th>Objetivo</th>
                        <th>Visualizar Ficha</th>   <!--Ai leva para aquela página de gerenciamento de ficha, e não ter o id dela porque quem guarda é a ficha e não o aluno-->
                        <th>ID Dieta</th>
                        <th>Gerenciar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos as $aluno): ?>
                    <tr class="tb">
                        <td> <?php echo $aluno->id; ?></td>
                        <td><?php echo $aluno->user_nome; ?></td>
                        <td><?php echo $aluno->objetivo; ?></td>
                        <td>
                            <?php if ($aluno->id_ficha === null): ?>
                                <span class="material-symbols-outlined" style="color: gray; cursor: not-allowed;">visibility</span>
                            <?php else: ?>
                                <a href="/fichaIndividual?id=<?= $aluno->id_ficha ?>" 
                                style="text-decoration: none; color: black;" 
                                class="material-symbols-outlined">visibility</a>
                            <?php endif; ?>
                        </td>
                        <td>1</td>
                        <td><a href="/app/views/site/pvi.view.php" style="text-decoration: none; color: black;" class="material-icons">settings</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>
</html>

<script>
  const alunos = <?php echo json_encode($alunos); ?>;
  console.log(alunos);
</script>