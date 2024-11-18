<?php

    header("Content-Type: application/json");
    
    include_once 'private/ini.php';
    
    $logs = new Logs();

    $success = false;
    $result = "";

    if($logs->faculty_dropdown() === false){
        $result = "No result found!";
    }else{
        $success = true;
        $result = $logs->faculty_dropdown();
    }

    echo json_encode(
        [
            "success" => $success,
            "result" => $result
        ]
    );
