<?php
    namespace App;

    class Database{
        private $username = '';
        private $password = '';
        private $dbname = '';
        private $hostname ='localhost';
        public $conn ='';

        function __construct($user=null,$password=null,$db=null){
          
            $this->username=($user ==null)?'root':$user;
            $this->password=($password ==null)?'':$password;
            $this->dbname=($db ==null)?'code_bright':$db;
            $this->databaseConnection();
        }
        
        private function databaseConnection()
        {
            // Create connection
            $this->conn = mysqli_connect($this->hostname, $this->username, $this->password,$this->dbname);
           // $this->conn = new mysqli($this->hostname, $this->username, $this->password,$this->dbname);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
    }


?>