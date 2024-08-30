
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas PHP</title>
    <style>
        .prioridade-baixa {
            color: blue;
        }
        .prioridade-media {
            color: orange;
        }
        .prioridade-alta {
            color: red;
        }
    </style>
</head>
<body>
<form>
    <h1>Gerenciador de Tarefas PHP</h1>
    <fieldset>
        <legend>Nova Tarefa</legend>
        <label>Tarefa:
            <input type="text" name="nome" required>
        </label>
        <label>Data:
            <input type="date" name="data" required>
        </label>
        <label>Prioridade:
            <select name="prioridade" required>
                <option value="Baixa">Baixa</option>
                <option value="Média">Média</option>
                <option value="Alta">Alta</option>
            </select>
        </label>
        <label>Status:
            <select name="status" required>
                <option value="Pendente">Pendente</option>
                <option value="Em Progresso">Em Progresso</option>
                <option value="Concluída">Concluída</option>
            </select>
        </label>
        <input type="submit" name="gravar">
    </fieldset>
</form>

<table border="1">
<tr>
    <th>Tarefa</th>
    <th>Data</th>
    <th>Prioridade</th>
    <th>Status</th>
</tr>
<?php foreach ($lista_tarefas as $tarefa) : ?>
    <?php
        // Definindo a classe CSS com base na prioridade
        $classe_prioridade = '';
        switch ($tarefa['prioridade']) {
            case 'Baixa':
                $classe_prioridade = 'prioridade-baixa';
                break;
            case 'Média':
                $classe_prioridade = 'prioridade-media';
                break;
            case 'Alta':
                $classe_prioridade = 'prioridade-alta';
                break;
        }
    ?>
    <tr>
        <td><?php echo htmlspecialchars($tarefa['nome']); ?></td>
        <td><?php echo htmlspecialchars($tarefa['data']); ?></td>
        <td class="<?php echo $classe_prioridade; ?>"><?php echo htmlspecialchars($tarefa['prioridade']); ?></td>
        <td><?php echo htmlspecialchars($tarefa['status']); ?></td>
    </tr>
<?php endforeach; ?>
</table>                           
</body>
</html>