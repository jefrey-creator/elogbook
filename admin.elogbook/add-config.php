<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Content-Type: application/json");
    include_once 'auth.php';

    $success = false;
    $result = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $mail_id = isset($_POST['mail_id']) ? trim($_POST['mail_id']) : '';
        $mail_tag = isset($_POST['mail_tag']) ? trim($_POST['mail_tag']) : '';
        $mail_subject = isset($_POST['mail_subject']) ? trim($_POST['mail_subject']) : '';
        $mail_body = isset($_POST['mail_body']) ? trim($_POST['mail_body']) : '';

        if(empty($mail_id)){
            //insert
            if(empty($mail_tag)){
                $result = "Mail tag is required.";
            }elseif (empty($mail_subject)) {
                $result = "Mail subject is required.";
            }elseif (empty($mail_body)) {
                $result = "Message is required.";
            }else{

                $config = new Config();
                $data = [
                    "mail_body" => $mail_body, 
                    "mail_subject" => $mail_subject, 
                    "mail_tag" => $mail_tag
                ];

                if($config->insert_config($data) === true){
                    $success = true;
                    $result = "Configuration successfully saved.";
                }else{
                    $result = "Error connecting to database.";
                }
            }

        }else{
            //update
            if(empty($mail_tag)){
                $result = "Mail tag is required.";
            }elseif (empty($mail_subject)) {
                $result = "Mail subject is required.";
            }elseif (empty($mail_body)) {
                $result = "Message is required.";
            }elseif (empty($mail_id)) {
                $result = "The config you are trying to update does not exist.";
            }elseif (!intval($mail_id)) {
                $result = "The config you are trying to update does not exist.";
            }
            else{

                $config = new Config();
                $data = [
                    "mail_body" => $mail_body, 
                    "mail_subject" => $mail_subject,
                    "mail_id" => intval($mail_id)
                ];

                if($config->update_config($data) === true){
                    $success = true;
                    $result = "Configuration successfully updated.";
                }else{
                    $result = "Error connecting to database.";
                }
            }

        }

    }else{
        $result = "Request method not allowed.";
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);