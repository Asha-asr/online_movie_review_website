<!DOCTYPE html>
<html>
<body>

        <?php
    include "header.php";
    include_once "dbconnect.php";
    include "all-movies.php";

    if($_SESSION["user"] = "admin") {?>
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
    
            <div class="container mx-auto mt-5">
                <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                    </form>
            </div>
        

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
                <?php }?>

                
</body>
</html>