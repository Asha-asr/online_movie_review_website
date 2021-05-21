<?php

class reviewMovies{

    public function __construct() {
        require_once ('dbconnect.php');
        $db = new DbConnect();
        $this->dbConn = $db->connect() ;
    
    }

    public function getConnection(){
        return $this->dbConn; 
      }
  
      public function get(){
        if(isset($_GET['ID'])){
            $this->movie_id = $_GET['ID'];
            return $this->movie_id;
        }
    }


?>