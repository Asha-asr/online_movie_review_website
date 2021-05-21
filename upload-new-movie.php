<?php
include "header.php";
include "session-check.php";


// require 'dbconnect.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_review_online";


if(isset($_POST['submit']))
{

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
  
  if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $poster_name)){
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO movies(`movie_title`, `movie_year`, `movie_image`, `movie_genre`, `movie_director`, `movie_description`) VALUES ('$movie_title','$release_year','$poster_name','$movie_genre','$movie_director','$movie_details')");
            $stmt->execute();
            // echo "Inserted Succesfully";
            header("Location:admin-dashboard.php");
        }


        catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;

  }
  
  
           
            
    }

?>
  
  
