<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user_id = trim($_POST['user_id']);
        
        $account = new Account();

        $user_select = $account->select_user_by_uuid($user_id);

        $isBlocked = ($user_select->isBlocked == 1) ? 0 : 1;

        if(empty($user_id)){
            $result = "User does not exist.";
        }else{
            if($account->block_account($isBlocked, $user_id) === true){
                $success = true;
                if($isBlocked == 1){
                    $result = "Account successfully blocked.";
                }else{
                    $result = "Account successfully unblocked.";
                }
            }else{
                $result = "Error connecting to database.";
            }
        }

    }else{
        $result = "Request method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);