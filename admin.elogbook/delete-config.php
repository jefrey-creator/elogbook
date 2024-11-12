<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $config_id = trim($_POST['config_id']);

        if(!intval($config_id)){
            $result = "Configuration not found.";
        }elseif(empty($config_id)){
            $result = "Invalid configuration ID.";
        }else{
            $config = new Config();

            if($config->delete_config($config_id) === true){
                $success = true;
                $result = "Configuration successfully deleted.";
            }else{
                $result = "Error connecting to database.";
            }
        }
    }else{
        $result = "Request method not allowed.";
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);