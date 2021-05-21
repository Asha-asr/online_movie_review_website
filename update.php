<?php
 
 include "header.php";
 include_once "dbconnect.php";
 include "session-check.php";

      Class updateMovies{
                  public $movie_name;
                  public $movie_info;
                  public $dbConn;

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

                                  public function movieInfo(){
                                  $sql  = "SELECT * FROM movies WHERE Id = :Id"; 
                                  $stmt = $this->dbConn->prepare($sql);
                                  $stmt->execute([':Id' => $this->movie_id]);
                                  $movie_info = $stmt->fetchAll(PDO::FETCH_OBJ);
                                  return $movie_info;
                              }
                            
 
  }

                $objupdateMovies = new updateMovies();
                $conn = $objupdateMovies->getConnection();
                $get_movie = $objupdateMovies->getMovies();
                $movie = $objupdateMovies->movieInfo();
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
                          
                          if(isset($_POST['submit'])){
                                  
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
  
                                           $sql = "UPDATE movies SET movie_title = '$movie_title', movie_year= '$release_year', movie_image= '$poster_name', movie_genre= '$movie_genre', movie_director = '$movie_director', movie_description = '$movie_details' WHERE Id = '$get_movie'";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            echo "Successs and done";
                                            header("Location:admin-dashboard.php");
                              
                              }
                        }

                        $update_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                       
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
    <title>Document</title>
</head>
<body>
<div class="container my-5" >

<form action = "" method = "post" enctype="multipart/form-data">
<h3 class="text-center">Update Movie Details</h3>

  <div class="form-row my-5">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Movie Name</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Movie Name" value = "<?php echo $name?>" name="movieName">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Release Year</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Year of Release" value = "<?php echo $year?>" name="movieYear">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Movie Poster</label>
    <div class="custom-file">
    <input type="file" class="custom-file-input" id="validatedCustomFile" value = "<?php echo $image?>" name = "moviePoster" required>
    <!-- <input type="text" class="form-control" id="inputPassword4" placeholder="Movie Short Name" name="movieShort"> -->
    <label class="custom-file-label" for="validatedCustomFile"><?php echo $image?></label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Select Movie Genre</label>
    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="movieGenre">
                 
        <option selected>Choose...</option>
        <?php
        $sql = "SELECT * FROM genres";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $genre_selection = $statement->fetchAll(PDO::FETCH_OBJ);
        $genre_array = (array)$genre_selection;
        foreach($genre_array as $options){
          $genre_movie = $options->genre_name;
          $genre_no = $options->genre_id;           
                ?>
        <option value="<?php echo $genre_movie?>" <?php if($genre_movie == $genre){echo "selected";}?>><?php echo $genre_movie;?></option>
        <?php } ?>        
       
      </select>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Movie Director</label>
      <input type="text" class="form-control" id="inputCity" name="movieDirector" value = "<?php echo $director?>" >
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputZip">Movie Short Description</label>
      <input type="text" class="form-control" id="inputZip" name="movieDetails" value = "<?php echo $description?>" >
    </div>
  </div>
 
      
  <button type="submit" class="btn btn-primary" name="submit"> Update Movie</button>
</form>
</div>

</body>
</html>