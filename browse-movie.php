<?php
        session_start();
        include "header.php";
        include_once "dbconnect.php";
        include "all-movies.php";
    ?>



<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/7e81584200.js" crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet"/>
<link href="jquery.rateyo.min.css" rel="stylesheet"/>
        <style>
        .checked {
          color: orange;
        }
        .ui-datepicker-calendar {
            display: none;
            }
        </style>

  </head>
    <body>

              <?php if($_SESSION["user"] == "admin") {?>
                  <div class="container-fluid mx-auto my-5" style="width: 50%;">
                  <a href="admin-dashboard.php" class="btn btn-primary btn-lg active" role="button" aria-disabled="true"> Admin Dashboard</a>
                  <a href="add-movie.php" class="btn btn-primary btn-lg active" role="button" aria-disabled="true"> Add New Movie</a>
                  <!-- <a href="#" class="btn btn-primary btn-lg active" role="button" aria-disabled="true">Edit A Movie</a>
                  <a href="#" class="btn btn-primary btn-lg active" role="button" aria-disabled="true">Delete A Movie</a> -->
                  </div>

              <?php } ?>
        
            <?php
            $objviewMovies = new viewMovies();
            $movie = $objviewMovies->getAllmovies();
            $conn = $objviewMovies->getConnection();
            ?>
          <!-- Search Movie Filter -->
              <div class="container mx-auto my-3">
                  <form class="form-inline" action="" method="POST">
                      <label class="sr-only" for="inlineFormInputName2">Search by Movie Name</label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search by Movie Name" name="search">

                      <label class="sr-only" for="inlineFormInputGroupUsername2">Find by Movie Year</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <?php 
                            $year_sql = "SELECT DISTINCT movie_year FROM movies";
                            $year_statement = $conn->prepare($year_sql);
                            $year_statement->execute();
                          // $releaseyear = $year_statement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                          <div class="input-group-prepend">                       
                              <select class="custom-select" name="searchyear">
                                  <option selected>Search by Year</option>
                                    <?php
                                    while ($row = $year_statement->fetch()){
                                    ?>
                                  <option value="<?php echo $row['movie_year']?>"><?php echo $row['movie_year']?></option>
                                <?php } ?>
                              </select>               
                          </div>
                      </div>

                  <div class="form-check mb-2 mr-sm-2">
                        <?php 
                                  $type_sql = "SELECT id, genre_name FROM genres";
                                  $type_statement = $conn->prepare($type_sql);
                                  $type_statement->execute();
                                  
                                // $releaseyear = $year_statement->fetchAll(PDO::FETCH_ASSOC);
                                  ?>
                          <div class="input-group-prepend">                    
                              <select class="custom-select" name="searchgenre">
                                <option selected>Search by Genre</option>
                                <?php
                                  while ($type_row = $type_statement->fetch()){
                                  ?>
                                <option value="<?php echo $type_row['id']?>"><?php echo $type_row['genre_name']?></option>
                                <?php } ?>
                              </select>                        
                          </div>
                   </div>

                   <!-- <div class="input-group-prepend">                        
                    <div class="rateyo" id="rating"
                      data-rateyo-rating="4"
                      data-rateyo-num-stars="5"
                      data-rateyo-score="3">
                    </div>
                    <span class='result'>0</span>
                    <input type="hidden" name="rating">
                   </div>                        -->
                   

                    <div class="input-group-prepend">
                      <button type="submit" class="btn btn-primary mb-2" name="filter"><i class="fas fa-search"></i></button>
                    </div>
                   
              </form>
          </div>
         
        <script>
          $(function () {
                  $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
                    $(this).parent().find('.result').text('rating :'+ rating);
                    $(this).parent().find('input[name=rating]').val(rating);
                  });
                });
          </script>

                <!-- <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                    </form> -->


          <?php
             

             if(isset($_POST['filter'])){

              $limit = 5;

              $page = isset($_GET['page']) ? $_GET['page'] : 1;

              $start = ($page - 1) * $limit;

              $browse_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.id LIMIT $start,$limit";
             
              $browse_statement = $conn->prepare($browse_sql);
              
              $browse_statement->execute();
              
              $movie = $browse_statement->fetchAll(PDO::FETCH_ASSOC);

              $count_query = "SELECT COUNT(Id) AS Id FROM movies";
              
              $count_statement = $conn->prepare($count_query);
              
              $count_statement->execute();
              
              $movie_count = $count_statement ->fetchAll(PDO::FETCH_ASSOC);
              
              $total = $movie_count[0]['Id'];
              
              $pages = ceil($total/$limit);
              
              $previous = $page - 1;
              
              $next = $page + 1;

          ?>
             <div class="container mx-auto mt-5">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                        <a class="page-link" href="browse-movie.php?page=<?php echo $previous;?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for($i = 1; $i<= $pages; $i++){?>
                        <li class="page-item <?php ($i == $page ? print 'active' : '')?>"><a class="page-link" href="browse-movie.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php } ?>
                        <li class="page-item">
                        <a class="page-link" href="browse-movie.php?page=<?php echo $next;?>">Next</a>
                        </li>
                    </ul>
                    </nav>
            </div>
           <!-- end of pagination -->
              <?php

                $search_name = $_POST["search"];

                $search_genre = $_POST["searchgenre"];

                $search_year = $_POST["searchyear"];


                /*$where = array();

                if (isset($_POST["search"])) 
                {   
                  $search_name = $_POST["search"];

                  $where[] =  "movie_title LIKE '%".$search_name."%'";
                }

                if(isset($_POST["searchgenre"]))
                {
                  $search_genre = $_POST["searchgenre"];

                  $where[] =  "movie_genre = '$search_genre'";

                }

                if(isset($_POST["searchyear"]))
                {
                  $search_year = $_POST["searchyear"];

                  $where[] =  "movie_year = $search_year";

                }

                if(count($where))
                {
                  $search_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , 
                  genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description 
                  FROM movies INNER JOIN genres ON movies.movie_genre = genres.id
                    WHERE ".implode(" AND ",$where);
                }
                else
                {
                  "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id";
                }

                /*$search_query = " ";

                if(isset($search_name) && !empty($search_name)){
                              
                  $search_query .= "movie_title LIKE '%".$search_name."%'";                             
                 }

                 if(isset($search_year) && !empty($search_year)) {

                  $search_query .= " AND movie_year = '$search_year'";
                }

                  if(isset($search_genre) && !empty($search_genre)) {

                    $search_query .= " AND 'movie_genre' = '$search_genre'";                                       
                  } 

                  $search_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id WHERE 1 ".$search_query."";
                  */

                  $search_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id";

                            if(isset($search_name) && !empty($search_name)){
                              
                              $search_sql .= " WHERE (movie_title LIKE '%".$search_name."%')";                             
                             }

                             elseif(isset($search_year) && !empty($search_year)) {

                              $search_sql .= " WHERE(movie_year = '$search_year')";
                            }

                              elseif(isset($search_genre) && !empty($search_genre)) {

                                $search_sql .= " WHERE('movie_genre' = '$search_genre')";                                       
                              } 

                  echo $search_sql;

                  $search_statement = $conn->prepare($search_sql);

                  $search_statement->execute();

                  $search_movies = $search_statement->fetchAll(PDO::FETCH_ASSOC);
  
                    foreach($search_movies as $key => $filter){

                    ?>

                      <div class="container my-5" id="myDIV">
                      
                          <div class="card mb-3" style="max-width: 540px;">
                                  <div class="row no-gutters">
                                      <div class="col-md-4">
                                          <img src="<?php echo $filter['movie_image']; ?>." class="card-img" alt="...">
                                      </div>
                                      <div class="col-md-8">
                                          <div class="card-body">
                                              <h5 class="card-title"><?php echo $filter['movie_title'];?><p class="h5">(<?php echo $filter['movie_year'];?>)</p></h5>
                                              <p class="card-text"><?php echo $filter['movie_description']; ?></p>
                                              <p class="card-text"><small class="text-muted"><?php echo $filter['movie_genre']; ?> </small></p>
                                              <?php $sql = "SELECT AVG(score) AS overall_rating FROM ratings WHERE movie_id = ?";
                                                  $stmt = $conn->prepare($sql);
                                                  $stmt->execute([$filter['Id']]);
                                                  $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);?>
                                              <p class="card-text">Rating     <?=number_format($reviews_info['overall_rating'], 1)?></p>
                                              <p class="card-text"><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></p>
                                              <a href="movie-details.php?id=<?php echo $filter['Id']; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Reviews and Ratings</a>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                          <!-- End of Search Filter -->                
                      </div>             
                      <?php }      
       }
    else{

         
            // Pagination
            $limit = 5;

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start = ($page - 1) * $limit;

            $browse_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.id LIMIT $start,$limit";
            
            $browse_statement = $conn->prepare($browse_sql);
            
            $browse_statement->execute();
            
            $movie = $browse_statement->fetchAll(PDO::FETCH_ASSOC);

            $count_query = "SELECT COUNT(Id) AS Id FROM movies";
            
            $count_statement = $conn->prepare($count_query);
            
            $count_statement->execute();
            
            $movie_count = $count_statement ->fetchAll(PDO::FETCH_ASSOC);
            
            $total = $movie_count[0]['Id'];
            
            $pages = ceil($total/$limit);
            
            $previous = $page - 1;
            
            $next = $page + 1;

          ?>
             <div class="container mx-auto mt-5">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                        <a class="page-link" href="browse-movie.php?page=<?php echo $previous;?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for($i = 1; $i<= $pages; $i++){?>
                        <li class="page-item <?php ($i == $page ? print 'active' : '')?>"><a class="page-link" href="browse-movie.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php } ?>
                        <li class="page-item">
                        <a class="page-link" href="browse-movie.php?page=<?php echo $next;?>">Next</a>
                        </li>
                    </ul>
                    </nav>
            </div>
           <!-- end of pagination -->
     <?php 
     
     foreach($movie as $key => $all_movies){
  
    ?>
 
                <div class="container my-5">
                
                    <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="<?php echo $all_movies['movie_image']; ?>." class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $all_movies['movie_title'];?><p class="h5">(<?php echo $all_movies['movie_year'];?>)</p></h5>
                                        <p class="card-text"><?php echo $all_movies['movie_description']; ?></p>
                                        <p class="card-text"><small class="text-muted"><?php echo $all_movies['movie_genre']; ?> </small></p>
                                        <?php $sql = "SELECT AVG(score) AS overall_rating FROM ratings WHERE movie_id = ?";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute([$all_movies['Id']]);
                                            $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);?>
                                        <p class="card-text">Rating     <?=number_format($reviews_info['overall_rating'], 1)?></p>
                                        <p class="card-text"><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></p>
                                        <a href="movie-details.php?id=<?php echo $all_movies['Id']; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Reviews and Ratings</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                                    
                </div>             
                <?php }      
                }?>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
                    <script src="jquery.js"></script>
                    <script src="jquery.rateyo.js"></script>
                  <script>
                   $(function () {
 
                      $("#rateYo").rateYo({
                        starWidth: "14px",
                        rating: 0,
                        fullStar:true
                        var starWidth = $("#rateYo").rateYo("option", "starWidth");
                        $("#rateYo").rateYo("option", "starWidth", "14px");
                      });
                      
                      });
                                
                </script>

              

</body>
</html>