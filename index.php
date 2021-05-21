<?php
include "header.php";
include "registration.php";

// echo md5(1234);

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


<div class="container-fluid">
  <div class="card bg-dark text-white">
    <img class="card-img" src="images\slide7.jpg" alt="Card image">
      <div class="card-img-overlay ">
        
          <div class="card text-white bg-dark mb-3 mx-auto mt-2" style="max-width: 25rem;">
            <div class="card-header"></div>
              <div class="card-body">
              <?php if(isset($error) & !empty($error)){?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $error;?>
                            </div>
                          <?php } ?>
              
              <form method="POST" action="registration.php">
                  <h3 class="text-center p-3">Create a New Account </h3>

                                   
                      <div class="form-group">
                          
                      <label for="formGroupExampleInput"> Full Name</label>
                      <input type="text" class="form-control" id="fname" placeholder="Enter Fullname" name="fname" value="<?php echo $full_name;?>">
                        <span class="error text-danger"><?php $first_name_error ;?></span>
                       
       
      
  <div class="form-group">
        <label for="formGroupExampleInput2">Username</label>
        <input type="text" class="form-control" id="uname" placeholder="Enter New Username" name="uname" value="<?php echo $user_name;?>">
        <!-- <span class="error text-danger"><?php $last_name_error ;?></span> -->
              
          
  </div>
    
  <div class="form-group">
          <label for="formGroupExampleInput">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email;?>">
          <!-- <span class="error text-danger"><?php $email_error; ?></span> -->
         
           
    </div>

  <div class="form-group">
    <label for="formGroupExampleInput2">Phone No:</label>
    <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone" value="<?php echo $phone_no;?>">
    <!-- <span class="error text-danger"><?php $phone_error ;?></span> -->
    
     </div>
     

  <div class="form-group">
    <label for="formGroupExampleInput">Password</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter Password" name="pwd" value="<?php echo $user_password;?>">
    <!-- <span class="error text-danger"><?php $password_error ;?></span> -->
    
      </div>
      

  <div class="form-group">
    <label for="formGroupExampleInput2">Confirm Password</label>
    <input type="password" class="form-control" id="cpwd" placeholder="Confrm Password" name="cpwd" value="<?php echo $confirm_password  ;?>">
    <!-- <span class="error text-danger"><?php $confirm_password_error ;?></span> -->
    
      </div>
      
  <button type="submit" class="btn btn-secondary btn-lg btn-block" name="submit" value="submit"> Register </button>
</form>
<?php if(isset($sucess_msg) & !empty($sucess_msg)){?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $sucess_msg;?>
                            </div>
                          <?php } ?>
  </div>
    
  </div>
</div>
</div>

</body>
</html>