<?php

    class Login{
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function user_login($email, $password){

            $sql = "SELECT email, password FROM tbl_acct WHERE email = :email";
            $res = $this->db->prepare($sql);
            $res->bindParam(":email", $email, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){

                $row = $res->fetch(PDO::FETCH_OBJ);

                if(password_verify($password, $row->password)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

        public function get_user_logged_in($email){
            $sql = "SELECT a.acct_id, a.email, a.isAdmin, a.uuid, a.isBlocked, a.login_token, a.reset_token, a.reg_token,
                            CONCAT(f.f_name, ' ', f.m_name, ' ', f.l_name) as faculty_name, f.sex
                        FROM tbl_acct AS a 
                        LEFT JOIN tbl_faculty AS f ON (a.uuid=f.uuid)
                        WHERE a.email = :email";
            $res = $this->db->prepare($sql);
            $res->bindParam(":email", $email, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function update_login_token($login_token, $acct_id){
            $sql = "UPDATE tbl_acct SET login_token = :login_token WHERE acct_id = :acct_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":login_token", $login_token, PDO::PARAM_STR);
            $res->bindParam(":acct_id", $acct_id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }

        public function duplicate_email($email){
            $sql = "SELECT email FROM tbl_acct WHERE email = :email";
            $res = $this->db->prepare($sql);
            $res->bindParam(":email", $email, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }