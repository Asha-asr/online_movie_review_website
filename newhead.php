<nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">REVIEW YOUR FAVOURITE MOVIE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto" >
      <li class="nav-item active">
        <a class="nav-link" href="#">HOME<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ABOUT US</a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MOVIE REVIEWS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Comedy</a>
          <a class="dropdown-item" href="#">Thriller</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">CONTACT US</a>
      </li>

      <!-- <?php if(isset($_SESSION['user'])){?> -->
        <div class="login-container">
    <form action="logout.php" method = "POST">
    <button type="submit" name = "logout">Log Out</button>
    </form>

    <!-- <?php } else{?> -->
    <form action="admin-dashboard.php" method = "POST">
      <input type="text" placeholder="Username" name="username">
      <input type="text" placeholder="Password" name="psw">
      <button type="submit" name = "login">Login</button>
    </form>
  </div>
  <!-- <?php } ?> -->
  
    </ul>
  </div>
</nav>
