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
        <h1 class="titulo">Editar Aluno</h1>
        <div style="width: 80%; display: flex; justify-content: start; padding-bottom: 2%;">
        <h2><a href="/" style="text-decoration: none; color: white; display: flex;" class="material-icons">arrow_back</a></h2>
        </div>
            <div class="caixona">
                <form class="box" method="POST" action="/editarAluno" style="flex-direction: column; padding: 20px;">
                    <input type="hidden" name="id_usuario" value="<?= $aluno['id_usuario'] ?>">
                    <label class="subtitulo">Nome</label>
                    <input class="input" type="text" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" />

                    <label class="subtitulo">Objetivo</label>
                    <input class="input" type="text" name="objetivo" value="<?= htmlspecialchars($aluno['objetivo']) ?>" />

                    <label class="subtitulo">CPF</label>
                    <input class="input" type="text" name="cpf" value="<?= htmlspecialchars($aluno['cpf']) ?>" />

                    <label class="subtitulo">E-mail</label>
                    <input class="input" type="email" name="email" value="<?= htmlspecialchars($aluno['email']) ?>" />

                    <label class="subtitulo">Senha</label>
                    <input class="input" type="password" name="senha" placeholder="Deixe em branco para não alterar" />

                    <label class="subtitulo">Telefone</label>
                    <input class="input" type="tel" name="telefone" value="<?= htmlspecialchars($aluno['telefone']) ?>" />

                    <div style="width: 100%; display: flex; justify-content: center; gap:2%;">
                        <button type="submit" style="background-color: yellow; padding: 5px; cursor: pointer;">SALVAR</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>