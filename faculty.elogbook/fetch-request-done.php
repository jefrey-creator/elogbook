<?php
    header("Content-Type: application/json");
    
    include_once 'auth.php';
    $success = false;
    $result = "";


    if($_SERVER['REQUEST_METHOD'] === "GET"){

        $logs = new Logs();

        $is_accepted = trim($_GET['is_accepted']);
        $is_completed = trim($_GET['is_completed']);
        $page = trim($_GET['page']);
        $itemPerPage = ITEM_PER_PAGE;
        $offset = ($page - 1) * $itemPerPage;


        if(!intval($is_accepted)){
            $result = "No record at the moment";
        }
        elseif(empty($is_accepted)){
            $result = "No record at the moment";
        }
        elseif($logs->facultyLogsDone($user_details->uuid, $is_accepted, $is_completed, $offset, $itemPerPage) === false){
            $result = "No record at the moment.";
        }
        else{
            $success = true;
            $result = $logs->facultyLogsDone($user_details->uuid, $is_accepted, $is_completed, $offset, $itemPerPage);
        }

    }else{
        $result = "Method not allowed.";
    }

    echo json_encode([
        "success" => $success,
        "result" =>  $result
    ]);