<?php 

    class Logs{
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function faculty_dropdown(){
            $sql = "SELECT CONCAT(f.f_name, ' ', f.m_name, ' ', f.l_name) as faculty_name, f.uuid, f.availability FROM 
            tbl_faculty AS f
            LEFT JOIN tbl_acct AS a ON (f.uuid = a.uuid)
            ORDER BY f.f_name ASC";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function add_visitor_log($data){

            $sql = "INSERT INTO tbl_logs (full_name, date_visited, time_in, person_to_visit, purpose, req_category) 
                    VALUES (:full_name, :date_visited, :time_in, :person_to_visit, :purpose, :req_category)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function fetchLogs(){

            $sql = "SELECT l.full_name, l.date_visited, l.time_in, l.time_out,  l.purpose, l.logs_id, l.is_completed, l.req_category, l.is_accepted,
                    CONCAT(f.f_name, ' ', f.m_name, f.l_name) as person_to_visit
                FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty AS f 
                ON (l.person_to_visit=f.uuid)
                WHERE l.is_completed = 0
                ORDER BY l.date_visited DESC, l.time_in DESC
            ";

            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
            
        }

        public function fetchAdminLogs($status, $completed){

            $sql = "SELECT l.full_name, l.date_visited, l.time_in, l.time_out,  l.purpose, l.logs_id, l.is_completed, l.req_category, l.is_accepted, l.action_taken,
                    CONCAT(f.f_name, ' ', f.m_name, f.l_name) as person_to_visit, f.uuid
                FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty AS f 
                ON (l.person_to_visit=f.uuid)
                WHERE l.is_accepted = :is_accepted AND l.is_completed = :completed
                ORDER BY l.date_visited DESC, l.time_in DESC
            ";

            $res = $this->db->prepare($sql);
            $res->bindParam(":is_accepted", $status, PDO::PARAM_INT);
            $res->bindParam(":completed", $completed, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function fetchAdminLogsDone($status, $completed, $offset, $limit){

            $sql = "SELECT l.full_name, l.date_visited, l.time_in, l.time_out,  l.purpose, l.logs_id, l.is_completed, l.req_category, l.is_accepted, l.action_taken,
                    CONCAT(f.f_name, ' ', COALESCE(f.m_name, ''), f.l_name) as person_to_visit, f.uuid
                FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty AS f 
                ON (l.person_to_visit=f.uuid)
                WHERE l.is_accepted = :is_accepted AND l.is_completed = :completed
                ORDER BY l.date_visited DESC, l.time_in DESC 
                LIMIT :offset, :limit
            ";

            $res = $this->db->prepare($sql);
            $res->bindParam(":is_accepted", $status, PDO::PARAM_INT);
            $res->bindParam(":completed", $completed, PDO::PARAM_INT);
            $res->bindParam(":offset", $offset, PDO::PARAM_INT);
            $res->bindParam(":limit", $limit, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function facultyLogs($uuid, $status, $completed){
            $sql = "SELECT l.full_name, l.date_visited, l.time_in, l.time_out,  l.purpose, l.logs_id, l.is_completed, l.req_category, l.is_accepted, l.action_taken,
                    CONCAT(f.f_name, ' ', f.m_name, f.l_name) as person_to_visit
                FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty AS f 
                ON (l.person_to_visit=f.uuid)
                WHERE l.person_to_visit = :uuid AND l.is_accepted = :is_accepted AND l.is_completed = :completed
                ORDER BY l.date_visited DESC, l.time_in DESC
            ";

            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->bindParam(":is_accepted", $status, PDO::PARAM_INT);
            $res->bindParam(":completed", $completed, PDO::PARAM_INT);
            
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function facultyLogsDone($uuid, $status, $completed, $offset, $limit){
            $sql = "SELECT l.full_name, l.date_visited, l.time_in, l.time_out,  l.purpose, l.logs_id, l.is_completed, l.req_category, l.is_accepted, l.action_taken,
                    CONCAT(f.f_name, ' ', f.m_name, f.l_name) as person_to_visit
                FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty AS f 
                ON (l.person_to_visit=f.uuid)
                WHERE l.person_to_visit = :uuid AND l.is_accepted = :is_accepted AND l.is_completed = :completed
                ORDER BY l.date_visited DESC, l.time_in DESC
                LIMIT :offset, :limit
            ";

            $res = $this->db->prepare($sql);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $res->bindParam(":is_accepted", $status, PDO::PARAM_INT);
            $res->bindParam(":completed", $completed, PDO::PARAM_INT);
            $res->bindParam(":offset", $offset, PDO::PARAM_INT);
            $res->bindParam(":limit", $limit, PDO::PARAM_INT);
            
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function accept_request($logs_id){

            $sql = "UPDATE tbl_logs SET is_accepted = 1 WHERE logs_id = :logs_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":logs_id", $logs_id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }

        public function complete_request($logs_id, $time_out){
            $sql = "UPDATE tbl_logs SET is_completed = 1, time_out = :time_out WHERE logs_id = :logs_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":logs_id", $logs_id, PDO::PARAM_INT);
            $res->bindParam(":time_out", $time_out, PDO::PARAM_STR);
            
            $res->execute();

            return true;
        }

        public function complete_consultation($logs_id, $time_out, $action_taken){
            $sql = "UPDATE tbl_logs SET is_completed = 1, time_out = :time_out, action_taken = :action_taken WHERE logs_id = :logs_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":logs_id", $logs_id, PDO::PARAM_INT);
            $res->bindParam(":time_out", $time_out, PDO::PARAM_STR);
            $res->bindParam(":action_taken", $action_taken, PDO::PARAM_STR);
            
            $res->execute();

            return true;
        }

        public function getCurrentTime(){

            $sql = "SELECT CURRENT_TIMESTAMP as currentDate";
            $res = $this->db->prepare($sql);
            $res->execute();

            return $res->fetch(PDO::FETCH_OBJ);
        }

        public function print_logs($req_category){
            $sql = "select l.full_name as Requester, l.date_visited, l.time_in, l.time_out, CONCAT(f.f_name, ' ', COALESCE(f.m_name, ''), f.l_name) as person_to_visit, l.purpose, l.action_taken, l.req_category FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty as f ON (l.person_to_visit=f.uuid) WHERE l.req_category = :req_category";

            $res = $this->db->prepare($sql);
            $res->bindParam(":req_category", $req_category, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{  
                return false;
            }
        }

        public function print_all_logs(){
            $sql = "select l.full_name as Requester, l.date_visited, l.time_in, l.time_out, CONCAT(f.f_name, ' ', COALESCE(f.m_name, ''), f.l_name) as person_to_visit, l.purpose, l.action_taken, l.req_category FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty as f ON (l.person_to_visit=f.uuid)";

            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{  
                return false;
            }
        }

        public function print_faculty_logs($req_category = null, $uuid){
            $sql = "select l.full_name as Requester, l.date_visited, l.time_in, l.time_out, CONCAT(f.f_name, ' ', COALESCE(f.m_name, ''), f.l_name) as person_to_visit, l.purpose, l.action_taken, l.req_category FROM tbl_logs AS l 
                LEFT JOIN tbl_faculty as f ON (l.person_to_visit=f.uuid) WHERE l.req_category = :req_category AND f.uuid = :uuid";

            $res = $this->db->prepare($sql);
            $res->bindParam(":req_category", $req_category, PDO::PARAM_INT);
            $res->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{  
                return false;
            }
        }
    }