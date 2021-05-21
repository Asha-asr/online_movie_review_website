<?php


include_once "header.php";
include_once "dbconnect.php";
require 'all-movies.php';
include "session-check.php";



                            

                            $limit = 5;
                            $adjacents = 2;

                            $count_query = "SELECT COUNT(*) 'total_rows' FROM `movies`";
                            $query = $conn->prepare($count_query);
                            $query->execute();
                            $result = $query->fetch();
                            $total_rows = $result[0];
                            $total_pages = ceil((int)$total_rows / $limit);

                            if(isset($_GET['page']) && $_GET['page'] != ""){
                                $page = $_GET['page'];
                                $offset = $limit * ($page - 1);
                            }else{
                                $page = 1;
                                $offset = 0;
                            }
                        

                            $sql = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.genre_name LIMIT $offset, $limit;";
                            $query = $conn->prepare($sql);
                            $query->execute();

                            if($query->rowCount() > 0){
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            }
                            // count total number of rows in students table
                            $count_query = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.genre_name";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
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
                </div>
</body>
</html>



