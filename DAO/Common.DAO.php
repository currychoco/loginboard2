<?php
    
    class CommonDAO{

        protected $conn;

        public function __construct(){
            $this->conn = mysqli_connect("localhost", "root", "password", "mysql");
        }

        public function __destruct() {
            mysqli_close($this->conn);
        }
    }