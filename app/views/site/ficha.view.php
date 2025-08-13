<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/site/home.css">
</head>
<body>
    <div class="back-home">
        <div style="width: 80%; display: flex; justify-content: end; gap:2%; margin-top:50px;">
            <button style="background-color: gray; padding: 15px; cursor: pointer; font-size:30px; border-radius:20px;"><a href="/" style="text-decoration: none; color: white;">Alunos</a></button>
            <button style="background-color: black; padding: 15px; cursor: pointer; font-size:30px; border-radius:20px;"><a href="/ficha" style="text-decoration: none; color: white;">Fichas</a></button>
        </div>
        <h1 class="titulo">Fichas Ativas</h1>
        <div class="caixona">
        <div style="display: flex; width: 100%; justify-content:space-between; padding-bottom:2%">
        <div style="width: 30%; align-items:center; display:flex;"><input class="pesquisa" placeholder="Pesquisar"/><button style="text-decoration: none; color: black; cursor: pointer;" class="material-icons">search</button></div>
        </div>
        <div class="box">
            <table class="table">
                <thead>
                    <tr class="th">
                        <th>ID Ficha</th>
                        <th>Nome Aluno</th>
                        <th>Código instrutor</th>
                        <th>Data de Criação</th>
                        <th>Data de Validade</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fichas as $ficha): ?>
                    <tr class="tb">
                        <td><?= $ficha->id_ficha ?> </td>
                        <td><?= $ficha->nome_aluno ?></td>
                        <td><?= $ficha->codigo_instrutor ?></td>
                        <td><?= $ficha->data_criacao ?></td>
                        <td><?= $ficha->data_validade ?></td>
                        <td><a href="/fichaIndividual?id=<?= $ficha->id_ficha ?>" style="text-decoration: none; color: black;" class="material-icons">settings</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>
</html>