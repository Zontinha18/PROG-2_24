<?php

include_once "../Controller/ProdutoController.php";

error_reporting(E_ALL); // Reporta todos os tipos de erros
ini_set('display_errors', 1); // Ativa a exibição de erros
ini_set('display_startup_errors', 1); // Exibe erros durante a inicialização

$cargos = ["Gerência", "Estoque", "Reposição"];

?>

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
                <option value="Gerencia">Gerencia</option>
                <option value="Estoque">Estoque</option>
                <option value="Reposição">Reposição</option>
            </select>

            <label for="produto">Nome do Produto:</label>
            <input type="text" name="produto" id="produto" required>

            <label for="preco">Preço do Produto:</label>
            <input type="number" name="preco" id="preco" step="0.01" required>

            <label for="quantidade">Quantidade do Produto:</label>
            <input type="number" name="quantidade" id="quantidade" required>

            <label for="setor">Setor do Produto:</label>

            <select name="setor" id="setor" required>
    <?php if (!empty($setores)): ?>
        <?php foreach ($setores as $setor): ?>
            <option value="<?php echo htmlspecialchars($setor, ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($setor, ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach; ?>
        <?php else: ?>
            <option value="">Selecione um setor</option>
        <option value="Alimentos e Bebidas">Alimentos e Bebidas</option>
        <option value="Limpeza e Higiene">Limpeza e Higiene</option>
        <option value="Roupas e Acessórios">Roupas e Acessórios</option>
        <option value="Calçados">Calçados</option>
        <option value="Eletrônicos">Eletrônicos</option>
        <option value="Móveis e Decoração">Móveis e Decoração</option>
        <option value="Brinquedos e Jogos">Brinquedos e Jogos</option>
        <option value="Esportes e Lazer">Esportes e Lazer</option>
        <option value="Cosméticos e Perfumes">Cosméticos e Perfumes</option>
        <option value="Saúde e Bem-estar">Saúde e Bem-estar</option>
        <option value="Material de Escritório">Material de Escritório</option>
        <option value="Jardinagem e Agricultura">Jardinagem e Agricultura</option>
        <option value="Pets">Pets</option>
        <option value="Automotivo">Automotivo</option>
            <?php endif; ?>
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
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($produtosCadastrados)): ?>
            <?php foreach ($produtosCadastrados as $produto): ?>
                <tr>
                    <td><?php echo $produto->getNome(); ?></td>
                    <td>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo $produto->getQuantidade(); ?></td>
                    <td><?php echo $produto->getSetor(); ?></td>
                    <td><?php echo $produto->getFuncionario(); ?> (Matrícula: <?php echo $produto->getMatricula(); ?>, Cargo: <?php echo $produto->getCargo(); ?>)</td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="acao" value="remover_produto">
                            <input type="hidden" name="produto_remover" value="<?php echo $produto->getNome(); ?>">
                            <button type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum produto cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


