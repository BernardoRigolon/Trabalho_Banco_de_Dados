<?php
// Primeiro elemento para pegar dados da ficha e aluno
$fichaInfo = $treino[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha do Aluno</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/site/home.css">
    <link rel="stylesheet" href="/app/views/site/pvi.css">
    <style>
        .body_ficha{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #8283B5;
        }
        .ficha-container {
            width: 90%;
            margin: auto;
            background: #dcdadaff;
            color: black;
            padding: 20px;
            border-radius: 10px;
        }
        .ficha-header {
            margin-bottom: 20px;
        }
        .ficha-header h1 {
            margin: 0;
            font-size: 28px;
        }
        .ficha-detalhes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        .detalhe {
            background: lightgray;
            padding: 10px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: lightgray;
            border-radius: 8px;
            overflow: hidden;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
        }
        table th {
            background: lightgray;
            border-bottom: 2px solid black;
        }
        table tr:nth-child(even) {
            background: lightgray;
        }
        .btns {
            margin-top: 20px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .btns button {
            padding: 15px 20px;
            cursor: pointer;
            border: none;
            font-size: 16px;
            border-radius: 20px;
        }
        .btn-save {
            background: gray;
            color: white;
            text-decoration: none;
        }
        .btn-delete {
            background: red;
            color: white;
        }
    </style>
</head>
<body class="body_ficha">
    <div class="ficha-container">
        <div class="ficha-header">
            <h1>Ficha: <?= htmlspecialchars($fichaInfo->nome_aluno) ?></h1>
        </div>

        <div class="ficha-detalhes">
            <div class="detalhe"><strong>ID Ficha:</strong> <?= $fichaInfo->id_ficha ?></div>
            <div class="detalhe"><strong>Treino:</strong> <?= $fichaInfo->nome_treino ?></div>
            <div class="detalhe"><strong>Instrutor:</strong> <?= $fichaInfo->nome_instrutor ?? 'N/A' ?></div>
            <div class="detalhe"><strong>Data de Criação:</strong> <?= $fichaInfo->data_criacao ?? 'N/A' ?></div>
            <div class="detalhe"><strong>Data de Validade:</strong> <?= $fichaInfo->data_validade ?? 'N/A' ?></div>
        </div>

        <h2>Exercícios</h2>
        <table>
            <thead>
                <tr>
                    <th>Exercício</th>
                    <th>Séries</th>
                    <th>Repetições</th>
                    <th>Carga (kg)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($treino as $linha): ?>
                    <tr>
                        <td><?= htmlspecialchars($linha->nome_exercicio) ?></td>
                        <td><?= htmlspecialchars($linha->series) ?></td>
                        <td><?= htmlspecialchars($linha->repeticoes) ?></td>
                        <td><?= htmlspecialchars($linha->carga) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="btns">
            <button class="btn-save">
                <a href="/ficha" style="text-decoration: none; color:white;">Voltar</a>
            </button>
        </div>
    </div>
</body>
</html>
