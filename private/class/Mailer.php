<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Mailer {
        
        public function send_mail($recipient, $name, $subject, $body){

            require_once '../vendor/autoload.php';
    
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'cicslogbook@gmail.com';                   //SMTP username
                $mail->Password   = 'vavw zqjx rzfe eyfu';                    //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;        

                //Recipients
                $mail->setFrom('cicslogbook@gmail.com', 'e-Logbook');
                $mail->addAddress($recipient, $name);     //Add a recipient


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;
                
                $mail->send();
                
                return true;

            } catch (\Throwable $th) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    }