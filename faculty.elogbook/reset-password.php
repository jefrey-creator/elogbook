<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $account = new Account();

        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        $password_verfication = $account->select_account_by_uuid($user_details->uuid);

        if(!password_verify($current_password, $password_verfication->password)){
            $result = "Current password is incorrect.";
        }elseif(empty($current_password)){
            $result = "Current password is incorrect.";
        }elseif($new_password != $confirm_password){
            $result = "New password must be the same as the confirmation password.";
        }elseif(strlen($new_password) < 8){
            $result = "New password must be at least 8 characters long.";
        }elseif(!preg_match($pattern, $new_password)){
            $result = "New password must be a combination of UPPERCASE | lowercase | symbol | number.";
        }else{

            if($account->change_password(password_hash($new_password, PASSWORD_BCRYPT), $user_details->uuid) === true){
                $success = true;
                $result = "Password successfully updated.";
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