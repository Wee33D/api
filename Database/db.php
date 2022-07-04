<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

    class db{
        // Properties
        private $host = 'localhost: 3306';
        private $user = 'root';
        private $password = '';
        private $dbname = 'project_wt';

        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname;";
            $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }
    class DbResponse {
        public $status;
        public $error;
        public $lastinsertid;
     }

    
   function getDatabase() {


    $db = new db();
    return $db;
 }
