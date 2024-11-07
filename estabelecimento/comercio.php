<?php
session_start();

class Produto {
    private $nome;
    private $preco;
    private $quantidade;

    public function __construct($nome, $preco, $quantidade) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function reduzirQuantidade($quantidade) {
        if ($this->quantidade >= $quantidade) {
            $this->quantidade -= $quantidade;
            return true;
        }
        return false;
    }

    public function __toString() {
        return "{$this->nome} - R$ " . number_format($this->preco, 2, ',', '.') . " (Unidades: {$this->quantidade})";
    }
}

class Comercio {
    private $produtos = [];
    private $vendas = [];
    private $totalVendas = 0;

    public function cadastrarProduto($nomeProduto, $precoProduto, $quantidadeProduto) {
        $this->produtos[$nomeProduto] = new Produto($nomeProduto, $precoProduto, $quantidadeProduto);
        return "Produto cadastrado com sucesso!";
    }

    public function venderProduto($nomeProduto, $quantidadeVenda) {
        if (isset($this->produtos[$nomeProduto])) {
            $produto = $this->produtos[$nomeProduto];
            if ($produto->reduzirQuantidade($quantidadeVenda)) {
                $valorVenda = $produto->getPreco() * $quantidadeVenda;
                $this->totalVendas += $valorVenda;

                // Registra a venda
                $this->vendas[] = [
                    'produto' => $produto->getNome(),
                    'quantidade' => $quantidadeVenda,
                    'valor' => $valorVenda
                ];

                return "Venda realizada com sucesso!";
            } else {
                return "Quantidade insuficiente!";
            }
        }
        return "Produto não encontrado!";
    }

    public function excluirProduto($nomeProduto) {
        if (isset($this->produtos[$nomeProduto])) {
            unset($this->produtos[$nomeProduto]);
            return "Produto excluído com sucesso!";
        }
        return "Produto não encontrado!";
    }

    public function getTotalVendas() {
        return $this->totalVendas;
    }

    public function limparSaldo() {
        $this->totalVendas = 0;
        $this->vendas = [];
        return "Saldo limpo com sucesso!";
    }

    public function listarProdutos() {
        return $this->produtos;
    }

    public function listarVendas() {
        return $this->vendas;
    }

    public function salvarEstado() {
        $_SESSION['comercio'] = serialize($this);
    }

    public static function carregarEstado() {
        return isset($_SESSION['comercio']) ? unserialize($_SESSION['comercio']) : new Comercio();
    }
}

// Carregando ou inicializando o comércio
$comercio = Comercio::carregarEstado();

// Processando o cadastro de produtos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
        $nomeProduto = $_POST['produto'];
        $precoProduto = (float)$_POST['preco'];
        $quantidadeProduto = (int)$_POST['quantidade'];

        $mensagem = $comercio->cadastrarProduto($nomeProduto, $precoProduto, $quantidadeProduto);
        $_SESSION['mensagem'] = $mensagem;
        $comercio->salvarEstado(); // Salva o estado após o cadastro
    } elseif (isset($_POST['acao']) && $_POST['acao'] === 'vender') {
        $nomeProduto = $_POST['produto_venda'];
        $quantidadeVenda = (int)$_POST['quantidade_venda'];

        $mensagemVenda = $comercio->venderProduto($nomeProduto, $quantidadeVenda);
        $_SESSION['mensagem_venda'] = $mensagemVenda;
        $comercio->salvarEstado(); // Salva o estado após a venda
    } elseif (isset($_POST['acao']) && $_POST['acao'] === 'limpar') {
        $mensagemLimpar = $comercio->limparSaldo();
        $_SESSION['mensagem_limpar'] = $mensagemLimpar;
        $comercio->salvarEstado(); // Salva o estado após limpar o saldo
    } elseif (isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
        $nomeProdutoExcluir = $_POST['produto_excluir'];
        $mensagemExcluir = $comercio->excluirProduto($nomeProdutoExcluir);
        $_SESSION['mensagem_excluir'] = $mensagemExcluir;
        $comercio->salvarEstado(); // Salva o estado após excluir o produto
    }
}

// Exibindo produtos e vendas cadastrados
$produtosCadastrados = $comercio->listarProdutos();
$vendasRealizadas = $comercio->listarVendas();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAC ATACADISTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('https://wallpapers.com/images/high/clothing-store-pictures-6et6i0uwwfr4rqkx.webp');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #e51c44;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }
        h2 {
            color: #fff;
            margin-top: 20px;
            border-bottom: 2px solid #e51c44;
            padding-bottom: 10px;
            font-weight: bold;
        }
        .totais {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            font-size: 1.5em;
            color: #28a745;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, button, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #e51c44;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #c81030;
        }
        .message {
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: rgba(255, 255, 255, 0.9);
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: background-color 0.3s;
            color: black; /* Cor alterada para preto */
        }
        li:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            background-color: #e51c44;
            color: white;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .tab:hover {
            background-color: #c81030;
        }
        .active {
            background-color: #c81030;
        }
        .clear-saldo {
            background-color: #dc3545;
        }
        .clear-saldo:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ZAC ATACADISTA</h1>
        <div class="totais">Total em Vendas: R$ <?php echo number_format($comercio->getTotalVendas(), 2, ',', '.'); ?></div>

        <div class="tabs">
            <div class="tab active" onclick="showTab('cadastrar')">Cadastrar Produto</div>
            <div class="tab" onclick="showTab('vendas')">Registrar Venda</div>
            <div class="tab" onclick="showTab('registros')">Registros de Vendas</div>
        </div>

        <div class="content" id="cadastrar">
            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="message"><?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="acao" value="cadastrar">
                <label for="produto">Nome do Produto:</label>
                <input type="text" name="produto" id="produto" required>

                <label for="preco">Preço:</label>
                <input type="number" step="0.01" name="preco" id="preco" required>

                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" required>

                <button type="submit">Cadastrar Produto</button>
            </form>

            <h2>Produtos Cadastrados</h2>
            <ul>
                <?php if (empty($produtosCadastrados)): ?>
                    <p>Nenhum produto cadastrado.</p>
                <?php else: ?>
                    <?php foreach ($produtosCadastrados as $produto): ?>
                        <li>
                            <?php echo $produto; ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="acao" value="excluir">
                                <input type="hidden" name="produto_excluir" value="<?php echo $produto->getNome(); ?>">
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <div class="content" id="vendas" style="display: none;">
            <?php if (isset($_SESSION['mensagem_venda'])): ?>
                <div class="message"><?php echo $_SESSION['mensagem_venda']; unset($_SESSION['mensagem_venda']); ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="acao" value="vender">
                <label for="produto_venda">Nome do Produto:</label>
                <select name="produto_venda" id="produto_venda" required>
                    <option value="">Selecione um produto</option>
                    <?php foreach ($produtosCadastrados as $produto): ?>
                        <option value="<?php echo $produto->getNome(); ?>"><?php echo $produto->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="quantidade_venda">Quantidade:</label>
                <input type="number" name="quantidade_venda" id="quantidade_venda" required>

                <button type="submit">Registrar Venda</button>
            </form>
        </div>

        <div class="content" id="registros" style="display: none;">
            <h2>Registros de Vendas</h2>
            <ul>
                <?php if (empty($vendasRealizadas)): ?>
                    <p>Nenhuma venda registrada.</p>
                <?php else: ?>
                    <?php foreach ($vendasRealizadas as $venda): ?>
                        <li><?php echo "{$venda['produto']} - Quantidade: {$venda['quantidade']} - Valor: R$ " . number_format($venda['valor'], 2, ',', '.'); ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <form method="POST" style="text-align: center; margin-top: 20px;">
                <input type="hidden" name="acao" value="limpar">
                <button type="submit" class="clear-saldo">Limpar Saldo</button>
                <?php if (isset($_SESSION['mensagem_limpar'])): ?>
                    <div class="message"><?php echo $_SESSION['mensagem_limpar']; unset($_SESSION['mensagem_limpar']); ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
        function showTab(tab) {
            document.querySelectorAll('.content').forEach(function(content) {
                content.style.display = 'none';
            });
            document.querySelectorAll('.tab').forEach(function(tabElement) {
                tabElement.classList.remove('active');
            });

            document.getElementById(tab).style.display = 'block';
            document.querySelector(`.tab[onclick="showTab('${tab}')"]`).classList.add('active');
        }

        // Exibir a aba inicial
        showTab('cadastrar');
    </script>
</body>
</html>
