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
    <div class="back">
        <div style="width: 100%; display: flex; justify-content: center; gap:2%; margin-top:50px;">
            <button type="submit" style="background-color: yellow; padding: 15px; cursor: pointer; font-size:30px;"><a href="/" style="text-decoration: none; color: black;">Alunos</a></button>
            <button style="background-color: red; padding: 15px; cursor: pointer; font-size:30px;"><a href="/app/views/site/ficha.view.php" style="text-decoration: none; color: black;">Fichas</a></button>
        </div>
        <h1 class="titulo">Gerenciamento de Fichas</h1>
        <div class="caixona">
        <div style="display: flex; width: 100%; justify-content:space-between; padding-bottom:2%">
        <div style="width: 30%; align-items:center; display:flex;"><input class="pesquisa" placeholder="Pesquisar"/><button style="text-decoration: none; color: black; cursor: pointer;" class="material-icons">search</button></div>
        <button type="submit" style="background-color: yellow; padding: 10px; cursor: pointer; font-size:20px; justify-self:end; display: flex;"><a href="/app/views/site/index.view.php" style="text-decoration: none; color: black;">Criar Ficha</a></button>
        </div>
        <div class="box">
            <table class="table">
                <thead>
                    <tr class="th">
                        <th>ID Ficha</th>
                        <th>ID Aluno</th>
                        <th>Treino</th>
                        <th>Nome do instrutor</th>
                        <th>Data de Criação</th>
                        <th>Data de Validade</th>
                        <th>Gerenciar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tb">
                        <td>1</td>
                        <td>1</td>
                        <td>A</td>
                        <td>Toninho</td>
                        <td>08/08/2025</td>
                        <td>08/08/2026</td>
                        <td><a href="/app/views/site/pvificha.view.php" style="text-decoration: none; color: black;" class="material-icons">settings</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>
</html>