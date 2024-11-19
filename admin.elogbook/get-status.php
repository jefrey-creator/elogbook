<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] === "GET"){

        $account = new Account();

        if($account->get_status($user_details->uuid) === false){
            $result = "Availability not set.";
        }else{
            $success = true;
            $result = $account->get_status($user_details->uuid);
        }

    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" =>  $result
    ]);