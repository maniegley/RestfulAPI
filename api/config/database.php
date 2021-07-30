<?php
    class Database{
  
        // specify your own database credentials
        private $host = 'localhost';
        private $db_name = 'mathojat_api_db';
        private $username = 'mathojat_root';
        private $password = 'Manish@12345';
        public $conn;
  
        // get the database connection
        public function getConnection(){
  
            $this->conn = null;
  
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
                //echo "Connection established";
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
  
            return $this->conn;
        }
    }
?>