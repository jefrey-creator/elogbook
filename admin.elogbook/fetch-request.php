<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] === "GET"){

        $logs = new Logs();

        $is_accepted = trim($_GET['is_accepted']);
        $is_completed = trim($_GET['is_completed']);


        if(!intval($is_accepted)){
            $result = "No record at the moment";
        }
        elseif(empty($is_accepted)){
            $result = "No record at the moment";
        }
        elseif($logs->fetchAdminLogs($is_accepted, $is_completed) === false){
            $result = "No record at the moment.";
        }
        else{
            $success = true;
            $result = $logs->fetchAdminLogs($is_accepted, $is_completed);
        }

    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" =>  $result
    ]);