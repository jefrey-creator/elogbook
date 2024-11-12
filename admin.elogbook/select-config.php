<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $mail_id = trim($_GET['mail_id']);

        if(empty($mail_id)){
            $result = "Configuration not found.";
        }elseif(!intval($mail_id)){
            $result = "Invalid email configuration.";
        }else{

            $config = new Config();

            if($config->select_config($mail_id) === false){
                $result = "Configuration not found.";
            }else{
                $result = $config->select_config($mail_id);
                $success = true;
            }
        }

    }else{
        $result = "Request method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);