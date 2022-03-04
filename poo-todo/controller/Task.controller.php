<?php
    require_once '../service/Task.service.php';

    $body = json_decode(file_get_contents("php://input"));
    
    switch($body->action){
        case 'list' :
            echo TaskService::get_all_tasks();
            break;
            
        case 'save' :
            if(isset($body->titulo) && isset($body->descricao)){
                TaskService::save_new_task($body->titulo, $body->descricao);
                echo TaskService::get_all_tasks();
            }
            break;

        case 'delete' :
            echo TaskService::delete_task($body->taskId);
            break;
    }
?>