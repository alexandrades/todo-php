<?php
    $servidor = "localhost";
    $database = "tarefas";
    $usuario = "postgres";
    $senha = "";

    $conexao = pg_connect("host=$servidor port=5432 dbname=$database user=$usuario password=alexandrade1") or
        die("Não conectado");

    function getTarefas($conexao)
    {
        return array_reverse(pg_fetch_all(pg_query($conexao, "SELECT * FROM tarefas")));
    }

    function saveTarefa($conexao, $titulo, $descricao)
    {
        pg_query($conexao, "INSERT INTO tarefas (titulo, descricao) VALUES ('" .pg_escape_string($titulo). "', '" .pg_escape_string($descricao). "');");
    }

    function deleteTarefa($conexao, $idTarefa)
    {
        pg_query($conexao, "DELETE FROM tarefas WHERE id = " . $idTarefa . ";");
    }

    if (isset($_POST['titulo'])) {
        saveTarefa($conexao, $_POST['titulo'], $_POST['descricao']);
    }
    if (isset($_POST['idTarefa'])) {
        deleteTarefa($conexao, $_POST['idTarefa']);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="main-container">
        <div class="header">
            <h1>Lista de tarefas</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="titulo">Título:</label><br>
                    <input type="text" name="titulo" id="titulo">
                    <br>
                <label for="descricao">Descrição: </label><br>
                    <textarea name="descricao" id="descricao" cols="30" rows="5"></textarea>
                    <br>
                <button type="submit">Adicionar</button>
            </form>
        </div>
        <div class="list">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <?php
                    $tarefas = getTarefas($conexao);
                    foreach ($tarefas as $tarefa) {
                        echo "
                        <form action=" . $_SERVER['PHP_SELF'] . " method=\"POST\" class=\"item\">
                            <h3>Tarefa " . $tarefa['id'] . "</h3>
                            <p>" . $tarefa['descricao'] . "</p>
                            <input type=\"hidden\" name=\"idTarefa\" value=" . $tarefa['id'] . "></input>
                            <button type=\"submit\">Apagar</button>
                        </form>
                        ";
                    }
                    pg_close(($conexao));
                ?>

            </form>

        </div>
    </div>
</body>

</html>