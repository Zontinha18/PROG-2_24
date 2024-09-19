<?php
// Mapeamento dos setores
$setores = [
    'eletronico' => 'Setor 1 (Eletrônico)',
    'plastico' => 'Setor 2 (Plástico)',
    'aluminio' => 'Setor 3 (Alumínio)',
    'roupas' => 'Setor 4 (Roupas)',
    'brinquedo' => 'Setor 5 (Brinquedo)'
];

// Inicializa variáveis para armazenar o produto, setor e quantidade
$produto = '';
$composicao = ''; // Inicializa a variável
$setor = '';
$quantidade = ''; // Altera aqui para inicializar como string

// Verifica se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = htmlspecialchars($_POST['produto']);
    $composicao = htmlspecialchars($_POST['composicao']);
    $quantidade = isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : ''; // Verifica se a quantidade foi enviada

    // Encontra o setor baseado na composição
    $setor = isset($setores[$composicao]) ? $setores[$composicao] : 'Setor não encontrado';
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            margin-bottom: 25px;
        }
        .header {
            font-size: 25px;
            margin-bottom: 25px;
        }
        .content {
            font-size: 20px;
            text-align: start;
        }
        form {
            margin-bottom: 20px;
            padding: 25px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], select, input[type="number"] {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">LOJA DO ZONTINHA</div>

        <!-- Formulário para entrada de dados -->
        <h1>Cadastro de Produtos</h1>
        <form action="" method="post">
            <label for="produto">Nome do Produto:</label>
            <input type="text" id="produto" name="produto" value="<?php echo htmlspecialchars($produto); ?>" required>

            <label for="composicao">Composição do Produto:</label>
            <select id="composicao" name="composicao" required>
                <option value="eletronico" <?php echo $composicao === 'eletronico' ? 'selected' : ''; ?>>Eletrônico</option>
                <option value="plastico" <?php echo $composicao === 'plastico' ? 'selected' : ''; ?>>Plástico</option>
                <option value="aluminio" <?php echo $composicao === 'aluminio' ? 'selected' : ''; ?>>Alumínio</option>
                <option value="roupas" <?php echo $composicao === 'roupas' ? 'selected' : ''; ?>>Roupas</option>
                <option value="brinquedo" <?php echo $composicao === 'brinquedo' ? 'selected' : ''; ?>>Brinquedo</option>
            </select>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>" required min="1">

            <input type="submit" value="Enviar">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="content">
                <h1>Detalhes do Produto</h1>
                <p><strong>Nome do Produto:</strong> <?php echo htmlspecialchars($produto); ?></p>
                <p><strong>Setor Recomendado:</strong> <?php echo htmlspecialchars($setor); ?></p>
                <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($quantidade); ?></p>
            </div>
        <?php else: ?>
            <div class="content">Nenhum dado foi enviado.</div>
        <?php endif; ?>
    </div>
</body>
</html>
