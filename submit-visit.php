<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Content-Type: application/json");
    
    include_once 'private/ini.php';
    
    $logs = new Logs();
    $mailer = new Mailer();
    $config = new Config();
    $account = new Account();

    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $getDateTime = $logs->getCurrentTime();
        $dtCreate = date_create($getDateTime->currentDate);

        $dateNow = date_format($dtCreate, "M d, Y");
        $timeIn = date_format($dtCreate, "h:i:s A");

        $full_name = isset($_POST['full_name']) ? htmlspecialchars(trim($_POST['full_name'])) : '';
        $person_to_visit = isset($_POST['person_to_visit']) ? htmlspecialchars(trim($_POST['person_to_visit'])) : '';
        $visit_purpose = isset($_POST['visit_purpose']) ? htmlspecialchars(trim($_POST['visit_purpose'])) : '';
        $recaptcha = isset($_POST['recaptcha']) ? htmlspecialchars(trim($_POST['recaptcha'])) : '';

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf1e3oqAAAAAPLEe93SqI4jjRYp1dXUPc-_HMVf&response=".$recaptcha);

        if(!$response){
            $response = "Recaptcha verification failed.";
        }elseif(empty($full_name)){
            $result = "Full name is required";
        }elseif(strlen($full_name) < 2){
            $result = "Name must be at least 2 characters long.";
        }elseif(empty($visit_purpose)){
            $result = "Please enter a purpose for visiting.";
        }elseif(strlen($visit_purpose) < 10){
            $result = "Purpose must be at least 10 characters long.";
        }elseif(empty($person_to_visit)){
            $result = "Select a person to visit.";
        }else{
            
            $visitor_data = [
                "full_name" => strtoupper($full_name), 
                "date_visited" => $dateNow, 
                "time_in" => $timeIn, 
                "person_to_visit" => $person_to_visit, 
                "purpose" => $visit_purpose, 
                "req_category" => 0
            ];

            $faculty = $account->select_account_by_uuid($person_to_visit);
            $faculty_name = $faculty->f_name . " " . $faculty->m_name . " " . $faculty->l_name;

            $mail_config = $config->set_config("visit");
            $subject = $mail_config->mail_subject;
            $body = str_replace("[visitor_name]", ucwords(strtolower($full_name)), $mail_config->mail_body);
            $body1 = str_replace("[faculty_name]", ucwords(strtolower($faculty_name)), $body);
            $body2 = str_replace("[purpose]", $visit_purpose, $body1);

        

            if($logs->add_visitor_log($visitor_data) === true){

                if($mailer->public_mail($faculty->email, $faculty_name, $subject, $body2) === true){
                    
                    $success = true;
                    $result = "The person you want to visit has been notified successfully.";

                }else{
                    $result = "Request successfully submitted but unable to notify recipient because the email address is invalid.";
                }

                
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