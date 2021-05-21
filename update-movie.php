<?php

//  include "update.php";
include "session-check.php"


class updateAll{

                public function __construct() {
                    require_once ('dbconnect.php');
                    $db = new DbConnect();
                    $this->dbConn = $db->connect() ;
                    }

                    public function updateMovie(){

                        if(isset($_POST['submit'])){
                                echo "sucess";
                                $movie_title = $_POST['movieName'];
                                $release_year = $_POST['movieYear'];
                                $movie_poster = $_FILES["moviePoster"]["name"];
                                $movie_genre = $_POST['movieGenre'];
                                $movie_director = $_POST['movieDirector'];
                                $movie_details = $_POST['movieDetails'];
                                // $poster_name = $_POST['movieShort'];
                                $target_dir = "images/";
                                $target_file = $target_dir . basename($_FILES["moviePoster"]["name"]);
                                $poster_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                $movie_file = $movie_title.".".$poster_type;
                                $poster_name = $target_dir . $movie_file;

                            if(empty($movie_title) || empty($release_year) || empty($movie_poster) || empty($movie_genre) || empty($movie_director) || empty($movie_details)){
                                echo "Please provide all the details";
                            }

                  
                  
                            if(move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $poster_name)){

                                echo "Successs and done";
                            $sql = "UPDATE movies SET movie_title = '$movie_title', movie_year= '$release_year', movie_image= '$poster_name', movie_genre= '$movie_genre', movie_director = '$movie_director', movie_description = '$movie_details' WHERE Id = '$id'";
                            $stmt = $this->dbConn->prepare($sql);
                            $stmt->execute();
                            header("Location:admin-dashboard.php");
                            }
                    } 
                }
               


} 

            










?>