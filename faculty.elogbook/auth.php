<?php 

    session_start();

    include_once '../vendor/autoload.php';
    include_once '../private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    if(!isset($_SESSION['token'])){

        header("location: ../redirect/401?msg=You must login first.");

    }else{

        try {

            $key = API_KEY;
            $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));
            $login = new Login();

            $user_details = $login->get_user_logged_in($decoded->data->email);
    
            if($decoded->data->isAdmin != 0){
                header("location: ../redirect/401?msg=You must login first.");
            }

            if($user_details->login_token == ""){
                header("location: ../redirect/401?msg=You must login first1.");
            }

            // echo $decoded->data->username;

        } catch (\Throwable $th) {
            error_log($th->getMessage(), 0);
            header("location: ../redirect/401?msg=You must login first.");
        }

    }
