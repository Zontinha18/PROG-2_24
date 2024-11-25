<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAC ATACADISTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <div class="container">
        <img src="https://images.vexels.com/content/214980/preview/store-location-stroke-icon-625e9d.png" alt="Logo" class="logo" width="150">
        
        <h1>ZAC ATACADISTA</h1>

        <?php if (!empty($mensagens)): ?>
            <div class="message"><?php echo $mensagens; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="acao" value="cadastrar_produto">
            <label for="nome_funcionario">Nome do Funcionário:</label>
            <input type="text" name="nome_funcionario" id="nome_funcionario" required>

            <label for="matricula">Matrícula do Funcionário:</label>
            <input type="text" name="matricula" id="matricula" required>

            <label for="cargo">Cargo do Funcionário:</label>
            <select name="cargo" id="cargo" required>
                <?php foreach ($cargos as $cargo): ?>
                    <option value="<?php echo $cargo; ?>"><?php echo $cargo; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="produto">Nome do Produto:</label>
            <input type="text" name="produto" id="produto" required>

            <label for="preco">Preço do Produto:</label>
            <input type="number" name="preco" id="preco" step="0.01" required>

            <label for="quantidade">Quantidade do Produto:</label>
            <input type="number" name="quantidade" id="quantidade" required>

            <label for="setor">Setor do Produto:</label>
            <select name="setor" id="setor" required>
                <?php foreach ($setores as $setor): ?>
                    <option value="<?php echo $setor; ?>"><?php echo $setor; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Cadastrar Produto</button>
        </form>

        <form method="POST">
            <input type="hidden" name="acao" value="limpar_produtos">
            <button type="submit">Limpar Todos os Produtos</button>
        </form>

        <h2>Produtos Cadastrados:</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Setor</th>
                    <th>Funcionário</th>
                    <th>Numero</th>
