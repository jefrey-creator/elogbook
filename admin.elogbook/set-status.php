<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $account = new Account();
        $status = trim($_POST['availability']);

        if(empty($status) OR !intval($status)){
            $result = "Invalid status selected.";
        }else{
            if($account->set_status($user_details->uuid, $status) === true){
                $success = true;
                $result = "Availability successfully set.";
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