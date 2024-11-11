<?php 
    session_start();
    header("Content-Type: application/json");

    include_once '../vendor/autoload.php';
    include_once '../private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $login = new Login();
    $success = false;
    $result = "";

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(isset($_POST['recaptcha']) && !empty($_POST['recaptcha'])){

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf1e3oqAAAAAPLEe93SqI4jjRYp1dXUPc-_HMVf&response=".$_POST['recaptcha']);

        if(!$response){
            $response = "Recaptcha verification failed.";
        }elseif(empty($email)){
            $result = "Email address is required.";
        }elseif(empty($password)){
            $result = "Incorrect password.";
        }elseif($login->user_login($email, $password) === false){
            $result = "Incorrect email or password.";
        }else{
    
            $data = $login->get_user_logged_in($email);
    
            if($data->isBlocked == 1){
                $result = "Your account has been blocked, please contact the system administrator.";
            }else{
                $key = API_KEY;
        
                $payload = [
                    'iss' => ISS,
                    'aud' => AUD,
                    'exp' => time() + (60 * 60),
                    'data' => array(
                        'email' => $email,
                        'isAdmin' =>  $data->isAdmin,
                        'isBlocked' => $data->isBlocked,
                        'acct_id' => $data->acct_id,
                        "uuid" => $data->uuid
                    )
                ];
        
                $jwt = JWT::encode($payload, $key, 'HS256');
        
                if($login->update_login_token($jwt, $data->acct_id) === true){
                    $_SESSION['token'] = $jwt;
        
                    $success = true;
                    $result = "Successfully logged in.";
                }else{
                    $result = "Login failed. Please try again.";
                }
            }
    
        }
    }else{
        $result = "Recaptcha verification failed.";
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);
