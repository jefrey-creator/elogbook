<?php 

    session_start();

    include_once '../vendor/autoload.php';
    include_once '../private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    try {

        $key = API_KEY;
        $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));

        if($decoded->data->isAdmin == 1){
            header("location: ../admin.elogbook/dashboard");
        }elseif($decoded->data->isAdmin == 0){
            header("location: ../faculty.elogbook/dashboard");
        }
        else{
            header("location: ../redirect/401?msg=You don\'t have permission to access this page.");
        }

    } catch (\Throwable $th) {
        error_log($th->getMessage(), 0);
        header("location: ../redirect/401");
    }