<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $result = "";
    $success = false;

    if($_SERVER['REQUEST_METHOD'] === "GET"){
        
        $config = new Config();

        if($config->view_config() === false){
            $result = "No data available.";
        }else{
            $result = $config->view_config();
            $success = true;
        }

    }else{
        $result = "Requset method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);