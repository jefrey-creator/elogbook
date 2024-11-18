<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $logs_id = trim($_POST['logs_id']);

        if(!intval($logs_id)){
            $result = "Unable to process request.";
        }elseif(empty($logs_id)){
            $result = "Logs not found.";
        }else{

            $logs = new Logs();
            if($logs->accept_request($logs_id, 1) === true){
                $success = true;
                $result = "Successfully accepted.";
            }else{
                $result = "Error connecting to database.";
            }

        }

    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" =>  $result
    ]);