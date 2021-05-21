<?php
        include "header.php";
        // include_once "session-check.php";
        include_once "dbconnect.php";
        class movieDetails{

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
    
            public function movieDetails(){
    
                        $sql  = "SELECT * FROM movies WHERE Id = :Id"; 
                          $stmt = $this->dbConn->prepare($sql);
                          $stmt->execute([':Id' => $this->movie_id]);
                          $movie_info = $stmt->fetchAll(PDO::FETCH_OBJ);
                          return $movie_info;
           
            } 
                     
    
    } 
    
    $message = "";
    $objmovieDetails = new movieDetails();
    $conn = $objmovieDetails->getConnection();
    $get_movie = $objmovieDetails->getMovies();
    $movie = $objmovieDetails->movieDetails();
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

    // Below function will convert datetime to time elapsed string.
       function time_elapsed_string($datetime, $full = false) {
                        $now = new DateTime;
                        $ago = new DateTime($datetime);
                        $diff = $now->diff($ago);
                        $diff->w = floor($diff->d / 7);
                        $diff->d -= $diff->w * 7;
                        $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
                        foreach ($string as $k => &$v) {
                            if ($diff->$k) {
                                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                            } else {
                                unset($string[$k]);
                            }
                        }
                        if (!$full) $string = array_slice($string, 0, 1);
                        return $string ? implode(', ', $string) . ' ago' : 'just now';
                    }


if (isset($get_movie)){


    if(isset($_POST['submit'])) {

                if (!isset($_SESSION["user"])){
                $person = "Guest";
                $message = "Please login to submit review";
                
                }

                else{

                $person = $_SESSION["user"];
                $review = $_POST['review'];
                $rating = $_POST["rating"];
                
            
                $sql  = "INSERT INTO ratings(`movie_id`, `user_name`, `review`, `score`, `submit_date`) VALUES ('$id','$person','$review','$rating', NOW())"; 
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $message = "Your review has been submitted!";
                }
        }
        
                
        $sql = "SELECT * FROM ratings WHERE movie_id = ? ORDER BY submit_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$get_movie]);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT AVG(score) AS overall_rating, COUNT(*) AS total_reviews FROM ratings WHERE movie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$get_movie]);
        $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        else {
            $message = "Wrong Movie Id";
        }
      
   
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet"/>
    <title>Movie Details</title>
</head>
<body>
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

            <div class="container mt-3">
            <?php if(isset($message) & !empty($message)){?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $message;?>
                            </div>
                          <?php } ?>
            <div class="jumbotron">
            <h1 class="display-4"><?php echo $name; ?></h1>
            <p class="lead"><?php echo $director; ?></p>
            <hr class="my-4">
            <img src="<?php echo $image; ?>." class="img-fluid img-thumbnail" alt="...">
            <p><?php echo $description; ?></p>
            
            </div>
            <form action= "" method="POST">
            <div class="form-group">
                
            
                                          
                <label for="exampleFormControlTextarea1">Add Your Review</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "review"></textarea>
            </div>
            <div>
                    <div class="rateyo"
                        data-rateyo-rating="1"
                        data-rateyo-num-stars="5"
                        data-rateyo-score="5"></div>
                        <span class='score'><?=number_format($reviews_info['overall_rating'], 1)?></span>
                        <span class='result'><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></span>
                        <span><?=$reviews_info['total_reviews']?> reviews</span>
                        <input type="hidden" id="rating" name="rating" value="rating">
                </div>
                <input class="btn btn-primary" type="submit" value="Add Review" name="submit">
            </form>
            <?php foreach ($reviews as $review): ?>
            <div class="container mt-3">
            <p class="text-capitalize"><strong><?=htmlspecialchars($review['user_name'], ENT_QUOTES)?></strong></p>
                <div class="container">
                    <span><?=str_repeat('&#9733;', $review['score'])?></span>
                    <span><?=time_elapsed_string($review['submit_date'])?></span>
                    <p><?=htmlspecialchars($review['review'], ENT_QUOTES)?></p>
                </div>
                
            </div>
            <?php endforeach ?>

            </div>

    
</body>
</html>

