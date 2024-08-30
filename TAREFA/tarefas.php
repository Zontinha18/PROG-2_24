<?php session_start();

    // Verificar se existe valor para os índices nesta posição
    if (isset($_GET['gravar'])) {
        $nome = isset($_GET['nome']) ? $_GET['nome'] : '';
        $data = isset($_GET['data']) ? $_GET['data'] : '';
        $prioridade = isset($_GET['prioridade']) ? $_GET['prioridade'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $tarefa = [
            'nome' => $nome,
            'data' => $data,
            'prioridade' => $prioridade,
            'status' => $status
        ];

        if (isset($_SESSION['lista_tarefas'])) {
            $lista_tarefas = $_SESSION['lista_tarefas'];
        } else {
            $lista_tarefas = [];
        }

        $lista_tarefas[] = $tarefa;
        $_SESSION['lista_tarefas'] = $lista_tarefas;
    }

    if (isset($_SESSION['lista_tarefas'])) {
        $lista_tarefas = $_SESSION['lista_tarefas'];
    } else {
        $lista_tarefas = [];
    }

include "templat.php"
?>

