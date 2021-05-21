<?php
include "header.php";


class searchMovies{

    public function __construct() {
        require_once ('dbconnect.php');
        $db = new DbConnect();
        $this->dbConn = $db->connect() ;
    
    }

    public function getConnection(){
        return $this->dbConn; 
      }
    }


$objsearchMovies = new searchMovies();
$conn = $objsearchMovies->getConnection();

if(isset($_POST['submit'])){
    
    $search_string = $_POST['search'];
    $genre_sql = "SELECT genres.genre_id FROM genres WHERE genres.genre_name = :search";
    $stmt = $conn->prepare($genre_sql);
    $stmt->execute([':search' => $search_string]);
    $search_info = $stmt->fetchAll(PDO::FETCH_OBJ);
    $new_genre = array();
    foreach ($search_info as $item) {
    foreach ($item as $key => $genre_info) {
        $new_genre[$key] = $genre_info;
        
    } 

    }
    // $genre_value = array_values($search_info);
    // $genre_info = $genre_value[0];

    // echo "<pre>"; print_r(array_values($search_info));

    $genre_search = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre = genres.genre_id WHERE movies.movie_genre = :searchinfo";
    $statement = $conn->prepare($genre_search);
    $statement->execute([':searchinfo' => $genre_info]);
    $genre_data = $statement->fetchAll(PDO::FETCH_OBJ);
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

                                <div class="container">
                                <table class="table">
                                <thead>
                                <tr>
                                <th scope="col">NO.</th>
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
                                $search_array = (array)$genre_data;
							  foreach($search_array as $search_data){
                                $id = $search_data->Id;
                                $name = $search_data->movie_title;
                                $year = $search_data->movie_year;
                                $image = $search_data->movie_image;
                                $genre = $search_data->movie_genre;
                                $director = $search_data->movie_director;
                                $description = $search_data->movie_description;
                               

                            ?>
                                <tr>
                                <th scope="row"><?php echo $count;?></th>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $year; ?></td>
                                <td><img class="card-img-top" src="<?php echo $image;?>" style="width: 100px; height: 200px;"></td>
                                <td><?php echo $genre;?></td>
                                <td><?php echo $director; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><a class="btn btn-primary" href="movie-details.php?id=<?php echo $id; ?>" role="button">View</a><br><br>
                                </tr>
                                <?php $count++; } ?>
                                </tbody>
                            </table>
                        </div>
    
</body>
</html>