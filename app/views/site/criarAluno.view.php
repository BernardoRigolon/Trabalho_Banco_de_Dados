<!DOCTYPE html>
<html lang="pt-br">
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
        <h1 class="titulo">Criar Aluno</h1>
        <div style="width: 80%; display: flex; justify-content: start; padding-bottom: 2%;">
        <h2><a href="/" style="text-decoration: none; color: white; display: flex;" class="material-icons">arrow_back</a></h2>
        </div>
            <div class="caixona">
                <form class="box" method="POST" action="" style="flex-direction: column; padding: 20px;">
                    <label class="subtitulo">Nome</label>
                    <input class="input" placeholder="Digite o nome do aluno" type="text" name="nome"/>
                    <label class="subtitulo">Objetivo</label>
                    <input class="input" placeholder="Musculação" type="text" name="objetivo"/>
                    <label class="subtitulo">CPF</label>
                    <input class="input" placeholder="111.111.111-11" type="text" name="cpf"/>
                    <label class="subtitulo">E-mail</label>
                    <input class="input" placeholder="exemplo@email.com" type="email" name="email"/>
                    <label class="subtitulo">Senha</label>
                    <input class="input" placeholder="senah123" type="password" name="senha"/>
                    <label class="subtitulo">Telefone</label>
                    <input class="input" placeholder="(32)99999-9999" type="tel" name="telefone"/>
                    <label class="subtitulo">ID Ficha</label>
                    <input class="input" placeholder="Ficha só pode ser criada pelo instrutor" type="number" name="ficha" disabled/>
                    <label class="subtitulo">ID Dieta</label>
                    <input class="input" placeholder="Dieta só pode ser criada pelo nutricionista" type="number" name="dieta" disabled/>
                    <div style="width: 100%; display: flex; justify-content: center; gap:2%;">
                        <button type="submit" style="background-color: yellow; padding: 5px; cursor: pointer;">CRIAR</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>