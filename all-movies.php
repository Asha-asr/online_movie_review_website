<?php 
	/**
	 * 
	 */
	class viewMovies {
		public $dbConn;
		
		/*private $movie_title;
		private $movie_year;
		private $movie_image;
		private $movie_genre;
		private $movie_director;
        private $movie_description;
		

		function setmovie_title($movie_title) { $this->movie_title = $movie_title; }
		function getmovie_title() { return $this->movie_title; }
		function setmovie_year($movie_year) { $this->movie_year = $movie_year; }
		function getmovie_year() { return $this->movie_year; }
		function setmovie_image($movie_image) { $this->movie_image= $movie_image; }
		function getmovie_image() { return $this->movie_image; }
		function setmovie_genre($movie_genre) { $this->movie_genre = $movie_genre; }
		function getmovie_genre() { return $this->movie_genre; }
		function setmovie_director($movie_director) { $this->movie_director = $movie_director; }
		function getmovie_director() { return $this->movie_director; }
		function setmovie_description($movie_description) { $this->movie_description = $movie_description; }
		function getmovie_description() { return $this->movie_description; }*/
        
		public function __construct() {
            require_once ('dbconnect.php');
            $db = new DbConnect();
			$this->dbConn = $db->connect() ;
		}

		public function getConnection(){
			return $this->dbConn; 
		  }

		public function getAllmovies() {
			$sql  = "SELECT movies.Id, movies.movie_title, movies.movie_year, movies.movie_image , genres.genre_name AS movie_genre, movies.movie_director, movies.movie_description FROM movies INNER JOIN genres ON movies.movie_genre=genres.genre_name;";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->execute();
			$all_movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $all_movies;	
		}

		public function moviesCount(){
			$sql  = "SELECT count(Id) As Id FROM movies";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->execute();
			$movie_count = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$total_movie = $movie_count[0]['Id'];
			$page_count = ceil($total_movie/ 10);
			return $page_count;
		}

		
	}
 ?>