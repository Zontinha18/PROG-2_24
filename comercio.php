<?php
session_start();

// Verifica se a sessão de produtos já existe, se não, inicializa
if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

// Adiciona o produto à sessão quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = htmlspecialchars($_POST['descricao']);
    $setor = htmlspecialchars($_POST['setor']);
    
    $_SESSION['produtos'][] = ['descricao' => $descricao, 'setor' => $setor];
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOJA DO ZONTINHA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            text-transform: uppercase; /* NOME EM MAIÚSCULAS */
        }
        form {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 600px; /* LARGURA AUMENTADA */
            margin-bottom: 40px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        h2, h3 {
            margin-top: 20px;
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        .setor {
            background: #e9ecef;
            border-radius: 8px;
            padding: 10px;
            margin: 10px 0;
            width: 400px; /* Mesma largura do formulário */
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        li {
            background: #fff;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
        }
        .numero {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <h1>LOJA DO ZONTINHA</h1>

    <h2>Adicionar Produto</h2>
    <form method="post" action="">
        <label for="descricao">Descrição do Produto:</label>
        <input type="text" id="descricao" name="descricao" required placeholder="Digite a descrição do produto">

        <label for="setor">Setor:</label>
        <select id="setor" name="setor" required>
            <option value="eletronico">Eletrônico</option>
            <option value="aluminio">Alumínio / Inox</option>
            <option value="plastico">Plástico</option>
            <option value="brinquedo">Brinquedo</option>
            <option value="tecido">Tecido</option>
            <option value="roupas">Roupas</option> <!-- Setor adicionado -->
        </select>

        <input type="submit" value="Adicionar Produto">
    </form>

    <h2>Produtos Cadastrados</h2>
    <div class="setor">
        <ul>
            <?php foreach ($_SESSION['produtos'] as $index => $produto): ?>
                <li>
                    <span class="numero"><?php echo $index + 1; ?>.</span> <?php echo "{$produto['descricao']} - Setor: " . ucfirst($produto['setor']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <h2>Produtos por Setor</h2>
    <?php 
    $produtosPorSetor = [];
    foreach ($_SESSION['produtos'] as $produto) {
        $produtosPorSetor[$produto['setor']][] = $produto['descricao'];
    }
    ?>
    <?php if (empty($produtosPorSetor)): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <?php foreach ($produtosPorSetor as $setor => $produtos): ?>
            <div class="setor">
                <h3><?php echo ucfirst($setor); ?></h3>
                <ul>
                    <?php foreach ($produtos as $index => $descricao): ?>
                        <li>
                            <span class="numero"><?php echo $index + 1; ?>.</span> <?php echo htmlspecialchars($descricao); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
