<?php 

    class Config {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function insert_config($data){

            $sql = "INSERT INTO tbl_mailer (mail_body, mail_subject, mail_tag) VALUES (:mail_body, :mail_subject, :mail_tag)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;

        }

        public function update_config($data){
            $sql = "UPDATE tbl_mailer SET mail_body = :mail_body, mail_subject = :mail_subject WHERE mail_id = :mail_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function view_config(){

            $sql = "SELECT * FROM tbl_mailer";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function select_config($mail_id){

            $sql = "SELECT * FROM tbl_mailer WHERE mail_id = :mail_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":mail_id", $mail_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function delete_config($id){

            $sql = "DELETE FROM tbl_mailer WHERE mail_id = :mail_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":mail_id", $id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }

        public function set_config($mail_tag){

            $sql = "SELECT * FROM tbl_mailer WHERE mail_tag = :mail_tag";
            $res = $this->db->prepare($sql);
            $res->bindParam(":mail_tag", $mail_tag, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }
    }