<?php 

    class Account {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function create_login($data){

            $sql = "INSERT INTO tbl_acct (email, password, isAdmin, uuid) VALUES (:email, :password, :isAdmin, :uuid)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function create_profile($data){
            $sql = "INSERT INTO tbl_faculty (f_name, m_name, l_name, sex, uuid) VALUES (:f_name, :m_name, :l_name, :sex, :uuid)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function list_users(){
            $sql = "SELECT a.email, a.uuid, a.isBlocked, a.isAdmin, 
                    f.sex, CONCAT(f.f_name, ' ', f.m_name, ' ', f.l_name) as faculty_name 
                    FROM tbl_acct AS a LEFT JOIN tbl_faculty AS f ON (a.uuid=f.uuid)";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_user_by_uuid($uuid){
            $sql = "SELECT * FROM tbl_acct WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function block_account($isBlocked, $uuid){

            $sql = "UPDATE tbl_acct SET isBlocked = :isBlocked WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":isBlocked", $isBlocked, PDO::PARAM_INT);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->execute();

            return true;

        }

        public function change_password($password, $uuid){

            $sql = "UPDATE tbl_acct SET password = :password WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":password", $password, PDO::PARAM_STR);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->execute();

            return true;
        }

        public function select_account_by_uuid($uuid){
            $sql = "SELECT  f.f_name, f.m_name,f.l_name, f.sex,
                            a.email, a.password
                        FROM tbl_acct AS a 
                        LEFT JOIN tbl_faculty AS f ON (a.uuid=f.uuid)
                        WHERE a.uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_profile($data){
            $sql = "UPDATE tbl_faculty SET f_name = :f_name, m_name = :m_name, l_name = :l_name, sex = :sex WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            
            $res->execute($data);

            return true;
        }

        public function get_status($uuid){
            $sql = "SELECT availability FROM tbl_faculty WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0 ){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
            
        }

        public function set_status($uuid, $status){
            
            $sql = "UPDATE tbl_faculty SET availability = :status WHERE uuid = :uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->bindParam(":status", $status, PDO::PARAM_INT);
            $res->execute();

            return true;
        }
    }