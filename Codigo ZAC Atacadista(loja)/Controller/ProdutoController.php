<?php
require_once '../Models/Produto.php';
require_once '../Models/Comercio.php';

class ProdutoController {
    public function exibirView() {
        $comercio = Comercio::carregarEstado();
        $mensagens = $this->processarAcoes($comercio);
        $produtosCadastrados = $comercio->listarProdutos();

        // Setores disponíveis
        $setores = [
            "Alimentos e Bebidas", "Limpeza e Higiene", "Roupas e Acessórios",
            "Calçados", "Eletrônicos", "Móveis e Decoração", "Brinquedos e Jogos",
            "Esportes e Lazer", "Cosméticos e Perfumes", "Saúde e Bem-estar",
            "Material de Escritório", "Jardinagem e Agricultura", "Pets", "Automotivo"
        ];
        
        // Cargos disponíveis (ajuste feito aqui)
        $cargos = ["Gerência", "Estoque", "Reposição"];

        // Incluindo a view principal
        include '../Views/main_view.php'; // Inclui a view principal
    }

    private function processarAcoes($comercio) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['acao'])) {
                switch ($_POST['acao']) {
                    case 'cadastrar_produto':
                        return $this->cadastrarProduto($comercio);
                    case 'limpar_produtos':
                        return $this->limparProdutos($comercio);
                    case 'remover_produto':
                        return $this->removerProduto($comercio);
                }
            }
        }
        return '';
    }

    private function cadastrarProduto($comercio) {
        $nomeFuncionario = $_POST['nome_funcionario'];
        $matriculaFuncionario = $_POST['matricula'];
        $cargoFuncionario = $_POST['cargo']; // Cargo do funcionário
        $nomeProduto = $_POST['produto'];
        $precoProduto = (float)$_POST['preco'];
        $quantidadeProduto = (int)$_POST['quantidade'];
        $setorProduto = $_POST['setor'];

        // Cadastrando o produto
        $mensagem = $comercio->cadastrarProduto($nomeProduto, $precoProduto, $quantidadeProduto, $setorProduto, $nomeFuncionario, $matriculaFuncionario, $cargoFuncionario);
        $comercio->salvarEstado();
        return $mensagem;
    }

    private function limparProdutos($comercio) {
        $mensagem = $comercio->limparProdutos();
        $comercio->salvarEstado();
        return $mensagem;
    }

    private function removerProduto($comercio) {
        $nomeProduto = $_POST['produto_remover'];
        $mensagem = $comercio->removerProduto($nomeProduto);
        $comercio->salvarEstado();
        return $mensagem;
    }
}
?>

