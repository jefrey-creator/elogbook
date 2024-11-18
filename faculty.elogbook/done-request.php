<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $logs = new Logs();
        $logs_id = trim($_POST['logs_id']);

        $serverTime = $logs->getCurrentTime();
        $dtCreate = date_create($serverTime->currentDate);
        $timeOut = date_format($dtCreate, "h:i:s A");

        if(!intval($logs_id)){
            $result = "Unable to process request.";
        }elseif(empty($logs_id)){
            $result = "Logs not found.";
        }else{

        
            if($logs->complete_request($logs_id, $timeOut) === true){
                $success = true;
                $result = "Successfully done.";
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