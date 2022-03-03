<?php
    require_once 'C:\xampp\htdocs\todo-list\poo-todo\model\Task.model.php';
    require_once 'C:\xampp\htdocs\todo-list\poo-todo\service\db\database.connection.php';
    require_once 'C:\xampp\htdocs\todo-list\poo-todo\service\Task.service.php';

    class TaskService {
        // private $table_name = "tarefas";

        public static function get_all_tasks() {
            $connection = new DataBaseConnection();
            $query = "SELECT * FROM tarefas";

            $query_result = pg_fetch_all(pg_query($connection->connection, pg_escape_string($query)));
            $connection->close_db_connection();

            $result = array();
            foreach($query_result as $q){
                $tarefa = new Task($q['titulo'], $q['descricao']);
                $tarefa->set_id($q['id']);
                array_push($result ,$tarefa);
            }

            return $result;
        }

        public static function save_new_task($titulo, $descricao) {
            $connection = new DataBaseConnection();
            $query = "INSERT INTO tarefas (titulo, descricao) VALUES ('" .$titulo. "', '" .$descricao. "');";

            $result = pg_query($connection->connection, $query);
            $connection->close_db_connection();

            return pg_fetch_all($result);
        }

        public static function render_all_tasks() {
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
        }
    }
