<?php
    require_once 'service/Task.service.php'
    
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#save').click(function(){
                let body = {
                    action: 'save',
                    titulo: $('#titulo').val(),
                    descricao: $('#descricao').val()
                }
                $.ajax("POST",
                "./controller/Task.controller.php",
                body,
                function(data){
                    alert(data);
                    $('#task-list').html(data);
                })
            })
        })
    </script>
</head>

<body>
    <div class="main-container">
        <div class="header">
            <h1>Lista de tarefas</h1>
            <form>
                Tarefa: <input type="text" name="titulo" id="titulo">
                Descricao: <input type="text" name="descricao" id="descricao">
                <button id="save">Adicionar</button>
            </form>
        </div>
        <div class="task-list" id="task-list">
        
            <?php
                $all_tasks = TaskService::get_all_tasks();
                foreach ($all_tasks as $task) {
                    echo "
                    <form action=" . $_SERVER['PHP_SELF'] . " method=\"POST\" class=\"item\">
                    <h3>" . $task->get_titulo() . "</h3>
                    <p>" . $task->get_descricao() . "</p>
                    <input type=\"hidden\" name=\"idtask\" value=" . $task->get_id() . "></input>
                    <button type=\"submit\">Apagar</button>
                    </form>
                    ";
                }
                ?>
        </div>
    </div>
</body>

</html>