<?php
    header("Content-Type: application/json");
    
    include_once 'private/ini.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] == "GET"){

        $logs = new Logs();

        if($logs->fetchLogs() === false){
            $result = "No record at the moment.";
        }else{
            $success = true;
            $result = $logs->fetchLogs();
        }

    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" =>  $result
    ]);