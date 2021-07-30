<?php
    class Product{
  
        // database connection and table name
        private $conn;
        private $table_name = "user_information";
  
        // object properties
        public $id;
        public $ipaddr;
        public $pwd;
  
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

    // read products
        function read(){
  
            // select all query
            /*$query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC";
            */
            $id = (string)$_GET['id'];
            $query = "SELECT * FROM " . $this->table_name . " WHERE ipaddr="."'$id'";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
  
            // execute query
            $stmt->execute();
  
            return $stmt;
        }



        // create product
        function create(){
  
            // query to insert record
            $query = "INSERT INTO user_information SET ipaddr=:ipaddr, pwd=:pwd";
            // prepare query
            $stmt = $this->conn->prepare($query);
  
            // sanitize
            $this->ipaddr=htmlspecialchars(strip_tags($this->ipaddr));
            $this->pwd=htmlspecialchars(strip_tags($this->pwd));
  
            // bind values
            $stmt->bindParam(":ipaddr", $this->ipaddr);
            $stmt->bindParam(":pwd", $this->pwd);
  
            if($stmt->execute()){
                //echo "Welcome1";
                return true;
            }
            else{
                //echo "Welcome2";
                return false;
    
            }
      
        }
    }
?>