<?php
 session_start();
 include_once "header.php";

 include_once "dbconnect.php";

 require 'all-movies.php';

 include "session-check.php";

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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">   
        <!--Bootsrap 4 CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">       
        <!--Fontawesome CDN-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!--Custom styles-->
        <link rel="stylesheet" type="text/css" href="styles.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <title>Movie Review Website</title>
    </head>
    <body>
    <div class="container-fluid mx-auto my-5" style="width: 50%;">
    <a href="browse-movie.php" class="btn btn-primary btn-lg active" role="button" aria-disabled="true"> View Movies</a>
    <a href="add-movie.php" class="btn btn-primary btn-lg active" role="button" aria-disabled="true"> Add New Movie</a>
    <!-- <a href="#" class="btn btn-primary btn-lg active" role="button" aria-disabled="true">Edit A Movie</a>
    <a href="#" class="btn btn-primary btn-lg active" role="button" aria-disabled="true">Delete A Movie</a> -->
    </div>

                        <?php

                            $objviewMovies = new viewMovies();

                            $conn = $objviewMovies->getConnection();

							              $movie = $objviewMovies->getAllmovies();

                            $movie_count = $objviewMovies->moviesCount();

                            $limit = 5;

                            $adjacents = 2;

                            $count_query = "SELECT COUNT(*) 'total_rows' FROM `movies`";

                            $query = $conn->prepare($count_query);

                            $query->execute();

                            $result = $query->fetch();

                            $total_rows = $result[0];

                            $total_pages = ceil((int)$total_rows / $limit);

                            if(isset($_GET['page']) && $_GET['page'] != "") {

                                $page = $_GET['page'];

                                $offset = $limit * ($page - 1);

                            }else {
                                $page = 1;

                                $offset = 0;
                            }
                        

                            $sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id LIMIT $offset, $limit";
                            
                            $query = $conn->prepare($sql);
                            
                            $query->execute();

                            if($query->rowCount() > 0){
                                
                              $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            }
                            // count total number of rows in movies table
                            
                            $count_query = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.id";
                            
                            $query = $conn->prepare($count_query);
                            
                            $query->execute();
                            
                            $count = $query->rowCount();
                            // calculate the pagination number by dividing total number of rows with per page.
                            
                            if($total_pages <= (1+($adjacents * 2))) {

                                $start = 1;

                                $end   = $total_pages;

                              } else {

                                if(($page - $adjacents) > 1) { 

                                  if(($page + $adjacents) < $total_pages) { 

                                    $start = ($page - $adjacents); 

                                    $end   = ($page + $adjacents); 

                                  } else {	

                                    $start = ($total_pages - (1+($adjacents*2))); 

                                    $end   = $total_pages;						   
                                  }
                                } else {	

                                  $start = 1;  

                                  $end   = (1+($adjacents * 2));  

                                }

                              }
                                                      
                              $start = 1;

                              $end = $total_pages;
                        ?>


                <div class="container">
                  <nav aria-label="Page navigation example">
                  <?php if($total_pages > 1) { ?>
                      <ul class="pagination">
                   
                        <li class="page-item <?php ($page <= 1 ? print 'disabled' : '')?>"><a class="page-link" href="admin-dashboard.php?page=1">&lt;&lt;</a></li>

                        

                         <li class="page-item <?php ($page <= 1 ? print 'disabled' : '')?>"><a class="page-link" href="admin-dashboard.php?page=<?php ($page>1 ? print($page-1) : print 1)?>">&lt;</a></li>

                         <?php for($i=$start; $i<=$end; $i++) { ?>


                        <li class="page-item <?php ($i == $page ? print 'active' : '')?>"><a class="page-link" href="admin-dashboard.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>

                        <?php } ?>

                            

                        <li class="page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>"><a class="page-link" href="admin-dashboard.php?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>">&gt;</a></li>

                        <li class="page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>"><a class="page-link" href="admin-dashboard.php?page=<?php echo $total_pages;?>">&gt;&gt;</a></li>
                        </ul>
                        <?php } ?>
                   
                    </nav>
               

                    <nav class="navbar navbar-light bg-light float-right">
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

                    <div class="input-group-prepend">
                      <button type="submit" class="btn btn-primary mb-2" name="searchsubmit"><i class="fas fa-search"></i></button>
                    </div>
                   
              </form>
          </div>

                      <!-- <form class="form-inline float-right" action="" method="post">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchsubmit">Search</button>
                      </form> -->
                      </nav>
                  </div>

                      <?php if(isset($_POST["searchsubmit"])){
                          
                          $search_name = $_POST["search"];

                          $search_year = $_POST["searchyear"];

                          $search_genre = $_POST["searchgenre"];

                          /*$find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id WHERE movies.movie_title != ''";

                          if(isset($search_name) && !empty($search_name)){
                              
                            $find_sql .= " AND (movie_title LIKE '%".$search_name."%')";                             
                           }

                           if(isset($search_year) && !empty($search_year)) {

                            $find_sql .= " AND (movie_year = '$search_year')";
                          }

                            if(isset($search_genre) && !empty($search_genre)) {

                              $find_sql .= " AND ('movie_genre' = '$search_genre')";                                       
                            } 


                          // $search_name = isset($search_name) ? trim($search_name) : false;

                          // $search_year = isset($search_year) ? trim($search_year) : false;

                          // $search_genre = isset($search_genre) ? trim($search_genre) : false;

                          
                          // $filter_input = [];

                          // array_push($filter_input, $search_name, $search_year, $search_genre);

                          // $search_fields = array('$search_name', '$search_year', '$search_genre');

                          // echo '<pre>'; print_r($search_fields); 

                          // $search_keys = array_filter($search_fields);*/

                          // $conditions = array();

                          // $parameters = array();

                          // $where = "";

                          // if($search_name != "" || $search_genre != "" || $search_year != "" || $search_rating != ""){
                            
                            // $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.id WHERE movie_title LIKE '%$search_name%' OR movie_year = '$search_year' OR movie_genre = '$search_genre' LIMIT $offset, $limit";
                            
                            // $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id  WHERE TRUE ";

                            /*if($search_name != ""){
                              
                             $conditions[] = " movies.movie_title LIKE :name";

                             $parameters[":name"] = "%'.$search_name.'%";
                                     
                             }

                             if($search_year != ""){
                              
                              $conditions[] = " movies.movie_year = :year";
 
                              $parameters[":year"] = $search_year;
                              
                              }

                              if($search_genre != ""){
                              
                                $conditions[] = " movies.movie_genre = :type";
   
                                $parameters[":type"] = $search_genre;
                                
                                }

                                if (count($conditions) > 0)
                                {
                                    $where = implode(' AND ', $conditions);
                                }
  
                                $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id" . ($where != "" ? " WHERE $where" : "");

                                $find_sql .= ";";

                                if (empty($parameters))
                                {
                                  $find_movies = $conn->query($find_sql);
                                }

                                else
                                {
                                    // $statement = $pdo->prepare($query);
                                    // $statement->execute($parameters);
                                     echo $find_sql;
                                    $find_statement = $conn->prepare($find_sql);
                                     
                                    foreach($parameters as $key=>$value){
                                      $find_statement->bindValue(':'.$key, $value);
                                    // $find_statement->execute($parameters);
                                    }

                                    $find_statement->execute($parameters);

                            
                                    if (!$find_statement) throw new Exception("Query execution error.");
                                    $find_movies = $find_statement->fetchAll(PDO::FETCH_ASSOC);
                                    // $result = $statement->fetchAll();
                                    
                                }

                          // $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id WHERE (movie_title LIKE '%$search_name%' OR movie_title = '') AND (movie_year = '$search_year' OR movie_year = '') AND (movie_genre = '$search_genre' OR movie_genre = '') LIMIT $offset, $limit";

                            /*if($search_name != "" || $search_genre != "" || $search_year != "" || $search_rating != ""){

                              $find_sql .= " WHERE"; 
                              echo "added where";
                            }else{
                              echo "Please enter field to search";
                            } 

                      
                            /*if(count($search_keys) > 0){

                              $find_sql .= " WHERE";

                              $keynames = array_keys($search_keys);

                              foreach($search_keys as $key => $value){

                                $find_sql .= " $keynames[$key] = '$value'";

                                if (count($search_keys) > 1 && (count($search_keys) > $key)) { 
                                  $find_sql .= " AND";
                               }

                              }

                            }*/                      
                           
                            
                            // $find_sql .= ";"

                            /*$keynames = array_values($filter_input);

                            foreach($filter_input as $key => $value)
                                        {
                                          $find_sql .= " $keynames[$key] = '$value'";  // $filtered_get keyname = $filtered_get['keyname'] value
                                          if (count($filter_input) > 1 && (count($filter_input) > $key)) { // more than one search filter, and not the last
                                              $find_sql .= " AND";
                                          }
                                        }

                                        $where = "";

                                        if(isset($search_name) && !empty($search_name)){
                              
                                          $where .= " AND movie_title LIKE '%".$search_name."%'";
                                         
                                         }
            
                                         if(isset($search_year) && !empty($search_year)) {
            
                                            $where .= " AND 'movies.movie_year' = '$search_year'";
                                            }
            
                                          if(isset($search_genre) && !empty($search_genre)) {
            
                                          $where .= " AND 'movie_genre' = '$search_genre'";
                                                   } 

                                        $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id WHERE 1=1 $where";

                                                   
                                              else {
                                                $find_sql .= " AND";
                                              }
                                              // ELSE*/
                 $find_sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.id";

                            if(isset($search_name) && !empty($search_name)){
                              
                              $find_sql .= " WHERE (movie_title LIKE '%".$search_name."%')";                             
                             }

                             elseif(isset($search_year) && !empty($search_year)) {

                              $find_sql .= " WHERE(movie_year = '$search_year')";
                            }

                              elseif(isset($search_genre) && !empty($search_genre)) {

                                $find_sql .= " WHERE('movie_genre' = '$search_genre')";                                       
                              } 
                                       
                                  /*else {
                                    $find_sql .= " AND";
                                  }*/



                              
                           $find_sql .= " LIMIT $offset, $limit;"; 
                            
                            
                            // echo $find_sql;
                          
                            $find_statement = $conn->prepare($find_sql);

                            $find_statement->execute();

                            $find_movies = $find_statement->fetchAll(PDO::FETCH_ASSOC);


                          /*$genre_sql = "SELECT genres.genre_id FROM genres WHERE genres.genre_name = :search";
                          $stmt = $conn->prepare($genre_sql);
                          $stmt->execute([':search' => $search_string]);
                          $search_info = $stmt->fetchAll(PDO::FETCH_OBJ);
                           echo "database";
                          $new_genre = array();
                          foreach ($search_info as $item) {
                          foreach ($item as $key => $genre_info) {
                              $new_genre[$key] = $genre_info;
                            // echo $genre_info;
                            } 

                            }

                          $genre_search = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.genre_id WHERE movies.movie_genre = :searchinfo";
                          $statement = $conn->prepare($genre_search);
                          $statement->execute([':searchinfo' => $genre_info]);
                          $genre_data = $statement->fetchAll(PDO::FETCH_OBJ);
                          //  echo "<pre>"; print_r($genre_data);

                          }*/

                          ?>
              
                      <div class="container">
                            <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">MOVIE TITLE</th>
                                <th scope="col">MOVIE YEAR</th>
                                <th scope="col">MOVIE IMAGE</th>
                                <th scope="col">MOVIE GENRE</th>
                                <th scope="col">MOVIE DIRECTOR</th>
                                <th scope="col">MOVIE DESCRIPTION</th>
                                <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                    <?php
                                
                                $serial = 1;
                                // $search_array = (array)$find_movies;
                                foreach($find_movies as $key => $search_data){
							                  /*foreach($search_array as $search_data){
                                $id = $search_data->Id;
                                $name = $search_data->movie_title;
                                $year = $search_data->movie_year;
                                $image = $search_data->movie_image;
                                $genre = $search_data->movie_genre;
                                $director = $search_data->movie_director;
                                $description = $search_data->movie_description;*/

                                  ?>
                                    <tr>
                                      <th scope="row"><?php echo $serial;?></th>
                                      <td><?php echo $search_data['movie_title'];?></td>
                                      <td><?php echo $search_data['movie_year']; ?></td>
                                      <td><img class="card-img-top" src="<?php echo $search_data['movie_image'];?>" style="width: 100px; height: 200px;"></td>
                                      <td><?php echo $search_data['movie_genre'];; ?></td>
                                      <td><?php echo $search_data['movie_director'];; ?></td>
                                      <td><?php echo $search_data['movie_description'];; ?></td>
                                      <td><a class="btn btn-primary btn btn-warning" href="update.php?id=<?php echo $search_data['Id']; ?>" role="button">EDIT </a><br><br>
                                      <a class="btn btn-primary btn btn-danger" href="delete.php?id=<?php echo $search_data['Id']; ?>" role="button">DELETE</a></td>
                                      </tr>

                                      <?php $serial++;} ?>
                                  </tbody>
                                  </table>
                                 
                          </div>
                           </div>       
                      <?php } 
                      
                      else{
                        ?>

                           
                            <div class="container">
                            <div class="table-responsive">
                            <table class="table" id="fulltable">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">MOVIE TITLE</th>
                                <th scope="col">MOVIE YEAR</th>
                                <th scope="col">MOVIE IMAGE</th>
                                <th scope="col">MOVIE GENRE</th>
                                <th scope="col">MOVIE DIRECTOR</th>
                                <th scope="col">MOVIE DESCRIPTION</th>
                                <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $serial_number = $offset+1;
                               
							//   foreach($movie as $key => $all_movies){ 
                                foreach($result as $data) { 
                                   
                            ?>
                                <tr>
                                <th scope="row"><?php echo $serial_number++;?></th>
                                <td><?php echo $data['movie_title']; ?></td>
                                <td><?php echo $data['movie_year']; ?></td>
                                <td><img class="card-img-top" src="<?php echo $data['movie_image']?>" style="width: 100px; height: 200px;"></td>
                                <td><?php echo $data['movie_genre']; ?></td>
                                <td><?php echo $data['movie_director']; ?></td>
                                <td><?php echo $data['movie_description']; ?></td>
                                <td><a class="btn btn-primary btn btn-warning" href="update.php?id=<?php echo $data['Id']; ?>" role="button">EDIT </a><br><br>
                                <a class="btn btn-primary btn btn-danger" href="delete.php?id=<?php echo $data['Id']; ?>" role="button">DELETE</a></td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                            </table>
                           
                    </div>
                     </div>

                  <?php }?>

</body>
</html>