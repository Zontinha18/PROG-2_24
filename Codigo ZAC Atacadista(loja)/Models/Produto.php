<?php

class Produto {
    private $nome;
    private $preco;
    private $quantidade;
    private $setor;
    private $funcionario;
    private $matricula;
    private $cargo;

    public function __construct($nome, $preco, $quantidade, $setor, $funcionario, $matricula, $cargo) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        $this->setor = $setor;
        $this->funcionario = $funcionario;
        $this->matricula = $matricula;
        $this->cargo = $cargo;
    }

    public function __toString() {
        return "{$this->nome} - R$ " . number_format($this->preco, 2, ',', '.') . 
               " (Unidades: {$this->quantidade}, Setor: {$this->setor}, Cadastrado por: {$this->funcionario} (Matrícula: {$this->matricula}, Cargo: {$this->cargo}))";
    }

    // Getters
    public function getNome() { return $this->nome; }
    public function getPreco() { return $this->preco; }
    public function getQuantidade() { return $this->quantidade; }
    public function getSetor() { return $this->setor; }
    public function getFuncionario() { return $this->funcionario; }
    public function getMatricula() { return $this->matricula; }
    public function getCargo() { return $this->cargo; }
}
?>
