<?php
ini_set('memory_limit', '44M');
// include_once "index.php";

class userRegistration{
                        
            public function __construct() {
                require_once ('dbconnect.php');
                $db = new DbConnect();
                $this->dbConn = $db->connect() ;
            }

            public function getConnection(){
              return $this->dbConn; 
            }
}

        $full_name = $user_name = $email = $phone_no = $user_password = $confirm_password = "";
        $error = $first_name_error = $last_name_error = $email_error = $phone_error = $password_error = $confirm_password_error = $sucess_msg = "";
        // $data = $_POST;
        

          
        if(isset($_POST['submit']))
          {
            $objuserRegistration = new userRegistration();
            $conn = $objuserRegistration->getConnection();

            $full_name = $_POST["fname"];
            $user_name = $_POST["uname"];
            $email = $_POST["email"];             
            $phone_no = $_POST["phone"];
            $user_password = $_POST["pwd"];
            $confirm_password = $_POST["cpwd"];
            $phone_digits_length = strlen($phone_no);


            function test_input($data) 
            {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }

                    if(empty($full_name) || empty($user_name) || empty($email) || empty($phone_no) || empty($user_password) || empty($confirm_password))
                    {
                      $error ="Please enter all required fields";
                      echo " Please enter all required fields";
                      // header("Location:index.php?register=empty");
                      exit();
                    }
                
                                    if ($full_name == "") 
                                    {
                                      // $first_name_error = "First Name is required";
                                      $error = "First Name is required"; 
                                      // header("Location:index.php?register=empty-fullname");
                                      echo " First Name Required";
                                      exit();
                                     
                                    } 

                                    elseif(!preg_match('/^[a-zA-Z]*$/',$full_name)) 
                                    
                                    {                                                  
                                      // $last_name_error = "Only letters and white space allowed";
                                      $error = "Only letters and white space allowed";
                                      // header("Location:index.php?register=fullname");
                                      echo "Only Lettter";
                                      exit();
                                                            
                                    }   
                                    elseif(strlen($full_name) < 5)
                                      {
                                      // $first_name_error = "Minimum 5 letters required";
                                      $error = "Minimum 5 letters required";
                                      // header("Location:index.php?register=fullname-length");
                                      echo "Minimum 5 letter";
                                      exit();
                                      
                                      }                                                                 
                                  
                                    elseif($user_name =="") 
                                    {
                                      // $last_name_error = "Please Enter Username"; 
                                      $error = "Please Enter Username";
                                      // header("Location:index.php?register=empty-username");
                                      echo "Please Enter Username";
                                      exit();
                                    } 
                                      elseif(strlen($user_name) < 5)
                                      {
                                      // $last_name_error = "Minimum 5 letters required";
                                      $error = "Minimum 5 letters required";
                                      // header("Location:index.php?register=username-length");
                                      echo "Minimum 5 letters";
                                      exit();
                                      
                                      }
                                   
                                      elseif($email == "") 
                                      {
                                        // $email_error = "Email is required";
                                        $error = "Email is required";
                                        // header("Location:index.php?register=empty-length");
                                        echo "Email is Required";
                                        exit();

                                      } 
                                      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                                      {
                                      //  $email_error = "Invalid Email"; 
                                       $error = "Invalid Email";
                                      //  header("Location:index.php?register=email-invalid");  
                                        echo "Not Valid Email";
                                        exit();
                                                               
                                       }
                                  
                                      elseif($phone_no == "") 
                                    {
                                      // $phone_error = "Phone Number is required";
                                      $error = "Phone Number is required";
                                      // header("Location:index.php?register=empty-phone-number");
                                      echo "Phone Number is required";
                                      exit();
                                    } 
                                    elseif($phone_digits_length < 10 || $phone_digits_length > 15)
                                    {
                                        // $phone_error = "Phone Number should have 10 digits";
                                        $error = "Phone Number should have 10 digits";
                                        // header("Location:index.php?register=phone-number-length");
                                        echo "Check phone";
                                        exit();
                                    }
                                    elseif(!preg_match("/^[+]?[1-9][0-9]{9,14}$/",$phone_no))
                                    {
                                    // $phone_error = "Invalid Phone Number";
                                    $error = "Invalid Phone Number"; 
                                    // header("Location:index.php?register=invalid-phone");        
                                    echo "Invalid phone number";    
                                    exit();                                                        
                                    } 

                                    elseif($user_password == "")
                                    {
                                      // $password_error = "Password is required";
                                      $error = "Password is required";
                                      // header("Location:index.php?register=password-required");
                                      echo "password is required";
                                      exit();
                                    }
                                    elseif($confirm_password == "")
                                    {
                                      // $confirm_password_error = "Enter Password Again";
                                      $error = "Enter Password Again";
                                      // header("Location:index.php?register=enter-password-again");
                                      echo "Enter Password again";
                                      exit();
                                    }
                                    elseif($user_password != $confirm_password)
                                    {
                                      // $confirm_password_error = "Passwords doesnot match";
                                      $error = "Passwords doesnot match";
                                      // header("Location:index.php?register=passwords-not-match"); 
                                      echo "Passwords does not match";
                                      exit();
                                    }
                                    elseif(strlen($confirm_password) <= '6') 
                                        {
                                          // $confirm_password_error = "Your Password Must Contain At Least 6 Characters!";
                                          $error = "Your Password Must Contain At Least 6 Characters!";
                                          // header("Location:index.php?register=password-character");
                                          echo "Your Password Must Contain At Least 6 Characters!";
                                          exit();
                                        }
                                        elseif(!preg_match("#[0-9]+#",$confirm_password)) 
                                            {
                                              // $confirm_password_error = "Your Password Must Contain At Least 1 Number!";
                                              $error = "Your Password Must Contain At Least 1 Number!";
                                              // header("Location:index.php?register=password-atleast-one-number");
                                              echo "Your Password Must Contain At Least 1 Number!";
                                              exit();
                                            }
                                            elseif(!preg_match("#[A-Z]+#",$confirm_password)) 
                                              {
                                                // $confirm_password_error = "Your Password Must Contain At Least 1 Capital Letter!";
                                                $error = "Your Password Must Contain At Least 1 Capital Letter!";
                                                // header("Location:index.php?register=password-atleast-one-capital");
                                                echo "Your Password Must Contain At Least 1 Capital Letter!";
                                                exit();
                                              }

                                              elseif(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $confirm_password))
                                                {
                                                  // $confirm_password_error = "Your Password Must Contain At Least 1 special character";
                                                  $error = "Your Password Must Contain At Least 1 special character";
                                                  // header("Location:index.php?register=password-atleast-one-special-character");
                                                  echo "Your Password Must Contain At Least 1 special character!";
                                                  exit();
  
                                                }
                                              
                                              
                                              else
                                              {         $confirm_password = md5($confirm_password);
                                                        $sql = "INSERT INTO `new-registration`(`full_name`, `user_name`, `phone_no`, `email_address`, `password`) VALUES ('$full_name','$user_name','$phone_no','$email','$confirm_password')";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute();

                                                       $sql = "INSERT INTO users (`user_name`, `password`, `role`, `type`) VALUES ('$user_name', '$confirm_password', 'user', '3')";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute();
                                                        
                                                        $sucess_msg = "Your account has been created successfully:Please Login";
                                                        header("Location:admin-dashboard.php");
                                                        // header("Location:index.php?register=successfully-created");
                                                      } 
                                                      
                                                
                                                      
                                           
                                                  
          }
                       

  ?>
