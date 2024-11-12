<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user_id = trim($_POST['user_id']);
        $gen_password = generateRandomPassword(8);
        
        $account = new Account();
        $config = new Config();
        $mailer = new Mailer();

        $select_acct = $account->select_user_by_uuid($user_id);

        $selected_config = $config->set_config("reset_password");
        $subject = $selected_config->mail_subject;
        $body = str_replace("[name]", $select_acct->email, $selected_config->mail_body);
        $body1 = str_replace("[email]", $select_acct->email, $body);
        $body2 = str_replace("[password]", $gen_password, $body1);

       
        if(empty($user_id)){
            $result = "User does not exist.";
        }else{

            if($mailer->send_mail($select_acct->email, "", $subject, $body2) === true){

                if($account->change_password(password_hash($gen_password, PASSWORD_BCRYPT), $user_id) === true){

                    $success = true;
                    $result = "Account password has been sent thru email. Please check the inbox of the email associated to your account.";
                    
                }else{
    
                    $result = "Error connecting to database.";
    
                }
            }else{
                $result = "Email notification error.";
            }
        }

    }else{
        $result = "Request method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);

    function generateRandomPassword($length) {
        // Define possible characters
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';
        
        // Initialize password string
        $password = '';
        
        // Loop to generate password
        for ($i = 0; $i < $length; $i++) {
            // Randomly pick a character from the possible characters
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $password;
    }