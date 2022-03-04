<?php

use LDAP\Result;

    require_once 'C:\xampp\htdocs\todo-list\poo-todo\model\Task.model.php';
    require_once 'C:\xampp\htdocs\todo-list\poo-todo\service\db\database.connection.php';
    require_once 'C:\xampp\htdocs\todo-list\poo-todo\service\Task.service.php';

    class TaskService {

        public static function get_all_tasks() {
            try {
                $connection = new DataBaseConnection();
                $query = "SELECT * FROM tarefas";

                $query_result = pg_fetch_all(pg_query($connection->connection, pg_escape_string($query)));
                $connection->close_db_connection();

                return json_encode($query_result);
            } catch (Exception $error) {
                return $error;
            }
        }

        public static function save_new_task($titulo, $descricao) {
            $connection = new DataBaseConnection();
            $query = "INSERT INTO tarefas (titulo, descricao) VALUES ('$titulo', '$descricao');";
            
            $result = pg_fetch_all(pg_query($connection->connection, $query));
            $connection->close_db_connection();

            return json_encode($result);
        }

        public static function delete_task($task_id){
            $connection = new DataBaseConnection();
            $query = "DELETE FROM tarefas WHERE id = $task_id";

            $result = pg_fetch_all(pg_query($connection->connection, pg_escape_string($query)));
            $connection->close_db_connection();

            return json_encode($result);
        }

    }
