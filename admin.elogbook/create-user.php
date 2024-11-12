<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $login = new Login();
        $account = new Account();
        $mailer = new Mailer();
        $config = new Config();

        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $isAdmin = isset($_POST['isAdmin']) ? trim($_POST['isAdmin']) : '';
        $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
        $mname = isset($_POST['mname']) ? trim($_POST['mname']) : '';
        $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
        $sex = isset($_POST['sex']) ? trim($_POST['sex']) : '';
        $uuid = isset($_POST['uuid']) ? trim($_POST['uuid']) : '';

        $result = "";
        $success = false;
        $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';
        $gen_uuid = md5(uniqid().time());

        $selected_config = $config->set_config("acct_reg");
        $subject = $selected_config->mail_subject;
        $body = str_replace("[name]", ucwords(strtolower($fname)), $selected_config->mail_body);
        $body1 = str_replace("[email]", $email, $body);
        $body2 = str_replace("[password]", $password, $body1);

        if(empty($uuid)){
            //insert

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $result = "Invalid email address.";
            }elseif(empty($email)){
                $result = "Email address is required.";
            }elseif ($login->duplicate_email($email)) {
               $result = "Email address is already in use.";
            }elseif(strlen($password) < 8){
                $result = "Password must be at least 8 characters long.";
            }elseif(!preg_match($pattern, $password)){
                $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
            }elseif ($isAdmin == "") {
                $result = "Invalid selection of user type.";
            }elseif (empty($fname)) {
                $result = "First name is required.";
            }elseif (empty($lname)) {
                $result = "Last name is required.";
            }elseif ($sex == ""){
                $result = "Invalid sex preference.";
            }else{
                
                $acct_data = [
                    "email" => $email,
                    "password" => password_hash($password, PASSWORD_BCRYPT), 
                    "isAdmin" => $isAdmin, 
                    "uuid" => $gen_uuid
                ];
                $profile_data = [
                    "f_name" => strtoupper($fname), 
                    "m_name" => strtoupper($mname), 
                    "l_name" => strtoupper($lname), 
                    "sex" => $sex, 
                    "uuid" => $gen_uuid
                ];

                if($mailer->send_mail($email, $fname, $subject, $body2) === true){
                    if($account->create_login($acct_data) === true){
                        if($account->create_profile($profile_data) === true){
                            $success = true;
                            $result = "User created successfully";
                        }else{
                            $result = "Database connection error.";
                        }
                    }else{
                        $result = "Database connection error.";
                    }
                }else{
                    $result = "Database connection error.";
                }
            }

        }else{
            //update
            if (empty($fname)) {
                $result = "First name is required.";
            }elseif (empty($lname)) {
                $result = "Last name is required.";
            }elseif ($sex == ""){
                $result = "Invalid sex preference.";
            }else{


                $data = [
                    "f_name" => strtoupper($fname), 
                    "m_name" => strtoupper($mname), 
                    "l_name" => strtoupper($lname), 
                    "sex" => $sex, 
                    "uuid" => $uuid
                ];

                if($account->update_profile($data) === true){
                    $success = true;
                    $result = "User updated successfully";
                }else{
                    $result = "Database connection error.";
                }
                
            }
        }
       
    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);