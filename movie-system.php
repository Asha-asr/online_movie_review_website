<?php

require_once('DB.php');
require_once('Report.php');

class Movie {
    private $id;
    private $name;
    private $description;
    private $img;
    private $genre;
    private $comments;

    public function set($_id, $_name, $_description, $_img, $_genre) {
        $this->id = $_id;
        $this->name = $_name;
        $this->description = $_description;
        $this->img = $_img;
        $this->genre = $_genre;
        $conn = DB::getInstance()->conn;
        $result = $conn->query("SELECT UID, Comment, ID FROM Comments WHERE MovieId=".$_id);
        if($result != "") {
            $_comments = array();
            while($row = $result->fetch_assoc()) {
                $r = new Reports();
                $r = $r->checkIfReported($row["ID"], $this->id);
                $_comments[] = array('ID' => $row["ID"], 'comment' => $row["Comment"], 'UID' => $row["UID"], 'reported' => $r);
            }
            $this->comments = $_comments;
        }
        else {
            $this->comments = null;
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->img;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getId() {
        return $this->id;
    }

    public function getComments() {
        return  $this->comments;
    }
}

class Movies {
    //$sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
    private $conn;
    private static $instance;
    private $movies = array();

    function __construct() {
        $this->conn = DB::getInstance()->conn;
    }

    public static function getInstance() {
        if ( self::$instance == null ) {
            self::$instance = new Movies();
        }
        return self::$instance;
    }

    public function set($offset) {
        $result = $this->conn->query("SELECT * FROM Movies LIMIT 10 OFFSET {$offset}");
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $g = null;
                $res = $this->conn->query("SELECT * FROM Genres WHERE MovieID={$row['ID']}");
                if($res->num_rows > 0) {
                    while($r = $res->fetch_assoc()) {
                        $g[] = $r['genre'];
                    }
                }
                $m = new Movie();
                $m->set($row['ID'], $row['Name'], $row['Description'], $row['Poster'], $g);
                $this->movies[] = $m;
            }
        }
    }

    public function get() {
        return $this->movies;
    }

    public function addMovie($_name, $_description, $_img, $_genres) {
        $_img = base64_encode($_img);
        $this->conn->query("INSERT INTO Movies(Name, Description, Poster) VALUES('{$_name}', '{$_description}', '{$_img}')");
        $_id = $this->conn->query("SELECT id FROM Movies WHERE Name='{$_name}'")->fetch_assoc();
        $_id = $_id['id'];
        print_r($_genres);
        foreach($_genres as $index => $genre) {
            $r = $this->conn->query("INSERT INTO Genres(MovieID, ID, genre) VALUES({$_id}, {$index}, '$genre')");
        }
    }

    public function getMovie($id) {
        $movie = new Movie();
        $genres = [];
        $res = $this->conn->query("SELECT(genre) FROM Genres WHERE MovieID={$id}");
        while($row = $res->fetch_assoc()) {
            $genre[] = $row['genre'];
        }
        $res = $this->conn->query("SELECT * FROM Movies WHERE ID={$id}");
        $res = $res->fetch_assoc();
        $movie->set($id, $res['Name'], $res['Description'], $res['Poster'], $genre);
        return $movie;
    }
}