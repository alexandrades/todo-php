<?php
    class Task {
        private $id;
        private $titulo;
        private $descricao;

        function __construct($titulo, $descricao){
            $this->titulo = $titulo;
            $this->descricao = $descricao;
        }
        
        public function get_id(): string {
            return $this->id;
        }
        
        public function get_titulo(): string {
            return $this->titulo;
        }

        public function get_descricao(): string {
            return $this->descricao;
        }

        public function set_id($new_id): void {
            $this->id = $new_id;
        }

        public function set_titulo($new_titulo): void {
            $this->titulo = $new_titulo;
        }

        public function set_descricao($new_descricao): void {
            $this->descricao = $new_descricao;
        }

    }
