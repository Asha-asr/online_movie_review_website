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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
                        

                            $sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.genre_id LIMIT $offset, $limit";
                            
                            $query = $conn->prepare($sql);
                            
                            $query->execute();

                            if($query->rowCount() > 0){
                                
                              $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            }
                            // count total number of rows in movies table
                            
                            $count_query = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.genre_id";
                            
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
                   
                    

                    <nav class="navbar navbar-light bg-light float-right">
                      <form class="form-inline float-right">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                      </form>
                      </nav>
                    </nav>
                </div>


                           
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
                                $count = 1;
							//   foreach($movie as $key => $all_movies){ 
                                foreach($result as $data) { 

                            ?>
                                <tr>
                                <th scope="row"><?php echo $count;?></th>
                                <td><?php echo $data['movie_title']; ?></td>
                                <td><?php echo $data['movie_year']; ?></td>
                                <td><img class="card-img-top" src="<?php echo $data['movie_image']?>" style="width: 100px; height: 200px;"></td>
                                <td><?php echo $data['movie_genre']; ?></td>
                                <td><?php echo $data['movie_director']; ?></td>
                                <td><?php echo $data['movie_description']; ?></td>
                                <td><a class="btn btn-primary btn btn-warning" href="update.php?id=<?php echo $data['Id']; ?>" role="button">EDIT </a><br><br>
                                <a class="btn btn-primary btn btn-danger" href="delete.php?id=<?php echo $data['Id']; ?>" role="button">DELETE</a></td>
                                </tr>
                                <?php $count++; } ?>
                            </tbody>
                            </table>
                           
                    </div>
                     </div>       

</body>
</html>