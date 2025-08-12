<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/site/home.css">
    <link rel="stylesheet" href="/app/views/site/pvi.css">
</head>
<body>
    <div class="back">
        <h1 class="titulo">Aluno Bernardo Rigolon</h1>
        <div style="width: 80%; display: flex; justify-content: start; padding-bottom: 2%;">
        <h2><a href="/" style="text-decoration: none; color: white; display: flex;" class="material-icons">arrow_back</a></h2>
        </div>
            <div class="caixona">
                <form class="box" method="POST" action="" style="flex-direction: column; padding: 20px;">
                    <label class="subtitulo">ID</label>
                    <input class="input" placeholder="1" />
                    <label class="subtitulo">Nome</label>
                    <input class="input" placeholder="Bernardo Rigolon"/>
                    <label class="subtitulo">Objetivo</label>
                    <input class="input" placeholder="Musculação"/>
                    <label class="subtitulo">ID Ficha</label>
                    <input class="input" placeholder="1"/>
                    <label class="subtitulo">ID Dieta</label>
                    <input class="input" placeholder="1"/>
                    <div style="width: 100%; display: flex; justify-content: center; gap:2%;">
                        <button type="submit" style="background-color: yellow; padding: 5px; cursor: pointer;">SALVAR</button>
                        <button style="background-color: red; padding: 5px; cursor: pointer;">DELETAR</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>