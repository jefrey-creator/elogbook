<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $uuid = trim($_GET['uuid']);

        if(empty($uuid)){
            $result = "User does not exist";
        }else{

            $acct = new Account();

            if($acct->select_account_by_uuid($uuid) === false){
                $result = "User not found.";
            }else{
                $result = $acct->select_account_by_uuid($uuid);
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