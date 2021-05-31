<?php

include "header.php";
include "session-check.php";

class genreMovies{

  public function __construct() {
      require_once ('dbconnect.php');
      $db = new DbConnect();
      $this->dbConn = $db->connect() ;
  
  }

  public function getConnection(){
      return $this->dbConn; 
    }
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
    <title>Document</title>
</head>
<body>
<div class="container my-5" >
    <form action = "upload-new-movie.php" method = "post" enctype="multipart/form-data">
      <h3 class="text-center">Add New Movie</h3>
          <div class="form-row my-5">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Movie Name</label>
              <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Movie Name" name="movieName">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Release Year</label>
              <input type="text" class="form-control" id="inputPassword4" placeholder="Year of Release" name="movieYear">
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress">Movie Poster</label>
            <div class="custom-file">
            <input type="file" class="custom-file-input" id="validatedCustomFile" name = "moviePoster" required>
            <!-- <input type="text" class="form-control" id="inputPassword4" placeholder="Movie Short Name" name="movieShort"> -->
            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            <div class="invalid-feedback">Example invalid custom file feedback</div>
          </div>
          </div>

          <div class="form-group">
                  <?php
                  $objgenreMovies = new genreMovies();
                  $conn = $objgenreMovies->getConnection();
                  $sql = "SELECT id, genre_name FROM genres";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  // $genre_selection = $statement->fetchAll();
                  
                  ?>
            <label for="inputAddress2">Select Movie Genre</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="movieGenre">
                <option selected>Choose Movie Genre...</option>
                <?php
                while ($row = $statement->fetch()){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['genre_name'];?></option>
                <?php } ?>
              </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Movie Director</label>
              <input type="text" class="form-control" id="inputCity" name="movieDirector">
            </div>
            <div class="form-group col-md-6">
              <label for="inputZip">Movie Short Description</label>
              <input type="text" class="form-control" id="inputZip" name="movieDetails">
            </div>
          </div>
  
          <button type="submit" class="btn btn-primary" name="submit"> Add Movie</button>
      </form>
</div>

</body>
</html>