<?php

    class DataBaseConnection {

        private const  SERVER = 'localhost';
        private const PORT = '5432';
        private const DATABASE = 'tarefas';
        private const USER = 'SEU USUARIO';
        private const PASSWORD = 'SUA SENHA';
        public $connection;

        function __construct()
        {
            $this->connection = pg_connect(
                "host=".self::SERVER ."
                port=".self::PORT."
                dbname=".self::DATABASE."
                user=".self::USER."
                password=".self::PASSWORD) or
            die("Não conectado");
        }

        public function get_connection() {
         return $this->connection;
        }

        public function close_db_connection() {
            pg_close($this->connection);
        }

    }