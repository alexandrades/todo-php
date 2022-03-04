<?php
    require_once 'service/Task.service.php'
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css"/>
    <title>Document</title>
    <script type="text/javascript" src="./assets/script.js"></script>
</head>

<body>
    <div class="main-container">
        <div class="header">
            <h1>Lista de tarefas</h1>
            <form>
                <label for="titulo">Titulo:</label><br>
                <input type="text" name="titulo" id="titulo"><br>
                <label for="descricao">Descrição:</label><br>
                <textarea name="descricao" id="descricao" cols="30" rows="5"></textarea>
                <input type="hidden" name="action" value="save"><br>
                <button type="button" id="save" onclick="saveTask()">Adicionar</button>
            </form>
        </div>
        <div class="task-list" id="task-list">
        </div>
    </div>
    <script>
        renderTasks()
    </script>
</body>

</html>