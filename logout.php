<?php 

    session_start();

    include_once 'private/ini.php';
    include_once 'vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    try {

        $key = API_KEY;
        $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));

        print_r($decoded);

        $login = new Login();
        
        $login->update_login_token(NULL, $decoded->data->acct_id);
        
        session_destroy();
        header("location: admin.elogbook/");

    } catch (\Throwable $th) {
        error_log($th->getMessage(), 0);
        header("location: redirect/401");
    }
    