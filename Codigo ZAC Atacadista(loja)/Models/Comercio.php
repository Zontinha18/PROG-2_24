<?php

class Comercio {
    private $produtos = [];

    public function cadastrarProduto($nomeProduto, $precoProduto, $quantidadeProduto, $setorProduto, $funcionario, $matricula, $cargo) {
        $this->produtos[$nomeProduto] = new Produto($nomeProduto, $precoProduto, $quantidadeProduto, $setorProduto, $funcionario, $matricula, $cargo);
        return "Produto cadastrado com sucesso!";
    }

    public function listarProdutos() {
        return $this->produtos;
    }

    public function removerProduto($nomeProduto) {
        if (isset($this->produtos[$nomeProduto])) {
            unset($this->produtos[$nomeProduto]);
            return "Produto removido com sucesso!";
        }
        return "Produto não encontrado!";
    }

    public function limparProdutos() {
        $this->produtos = [];
        return "Todos os produtos foram limpos!";
    }

    public function salvarEstado() {
        $_SESSION['comercio'] = serialize($this);
    }

    public static function carregarEstado() {
        return isset($_SESSION['comercio']) ? unserialize($_SESSION['comercio']) : new Comercio();
    }
}
?>
