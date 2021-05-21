<?php
include "header.php";
include "session-check.php";

class deleteMovies{

                    public function __construct() {
                        require_once ('dbconnect.php');
                        $db = new DbConnect();
                        $this->dbConn = $db->connect() ;
                    
                    }

                    public function getConnection(){
                        return $this->dbConn; 
                      }
                  
                      public function getMovies(){
                        if(isset($_GET['id'])){
                            $this->movie_id = $_GET['id'];
                            return $this->movie_id;
                        }
                    }

                    public function deleteMovie(){
                                $sql  = "SELECT * FROM movies WHERE Id = :Id"; 
                                  $stmt = $this->dbConn->prepare($sql);
                                  $stmt->execute([':Id' => $this->movie_id]);
                                  $movie_info = $stmt->fetchAll(PDO::FETCH_OBJ);
                                  return $movie_info;
                   
                    } 
                             

} 

        $objdeleteMovies = new deleteMovies();
        $conn = $objdeleteMovies->getConnection();
        $get_movie = $objdeleteMovies->getMovies();
        $movie = $objdeleteMovies->deleteMovie();
        $movie_array = (array) $movie;
        //  echo "<pre>"; print_r($movie_array);
        foreach($movie_array as $object){
          $id = $object->Id;
          $name = $object->movie_title;
          $year = $object->movie_year;
          $image = $object->movie_image;
          $genre = $object->movie_genre;
          $director = $object->movie_director;
          $description = $object->movie_description;
        } 

if(isset($_POST['delete'])) {
    
    $sql = "DELETE FROM movies WHERE Id = '$get_movie'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // echo "Successs and done";
    header("Location:admin-dashboard.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Delete Movie</title>
</head>
<body>
<div class="container">
<form action = "" method = "post" enctype="multipart/form-data">
<div class="card mb-3">
  <img class="card-img-top img-fluid img-thumbnail" src="<?php echo $image?>" alt="Card image cap">
  <div class="card-body">
    <h3 class="card-title"><?php echo $name?></h3>
    <h5 class="card-title"><?php echo $director?></h5>
    <p class="card-text"><?php echo $year ?></p>
    <p class="card-text"><small class="text-muted"><?php echo $genre ?></small></p>
    <p class="card-text"><?php echo $description ?></p>
    <input class="btn btn-primary" type="submit" value="Delete Movie" name ="delete">
    
  </div>
</div>
    </form>
   </div> 
</body>
</html>