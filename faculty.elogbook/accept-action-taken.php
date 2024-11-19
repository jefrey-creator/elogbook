<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $logs = new Logs();
        $logs_id = trim($_POST['logs_id']);
        $action_taken = trim($_POST['action_taken']);

        $serverTime = $logs->getCurrentTime();
        $dtCreate = date_create($serverTime->currentDate);
        $timeOut = date_format($dtCreate, "h:i:s A");

        if(!intval($logs_id)){
            $result = "Unable to process request.";
        }elseif(empty($logs_id)){
            $result = "Logs not found.";
        }elseif(empty($action_taken)){
            $result = "Action taken is required.";
        }elseif(strlen($action_taken) < 10){
            $result = "Action taken must be at least 10 characters long.";
        }
        else{

        
            if($logs->complete_consultation($logs_id, $timeOut, $action_taken) === true){
                $success = true;
                $result = "Successfully finished.";
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