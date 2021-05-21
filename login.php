<?php
session_start();
                        class userSession{
                        
                                    public function __construct() {
                                        require_once ('dbconnect.php');
                                        $db = new DbConnect();
                                        $this->dbConn = $db->connect() ;
                                    }

                                    public function getConnection(){
                                        return $this->dbConn; 
                                      }

                                }

                                $objuserSession = new userSession();
                                $conn = $objuserSession->getConnection();

                                if(isset($_POST["login"])){
                                                                  
                                    $user = $_POST['username'];
                                    $original_password = $_POST['psw']; 
                                    $u_password = md5($original_password);                                     
                                    $sql  = "SELECT * FROM users WHERE user_name = '$user' AND password = '$u_password'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                               
                                        $count = $stmt->rowCount();
                                        $users = $stmt->fetch(PDO::FETCH_ASSOC);
                                        if($count > 0){

                                            $_SESSION["user"] = $user;
                                            if ($users['type'] == 1){
                                                header("Location:admin-dashboard.php");
                                                }
                                                elseif ($users['type']==2){
                                                    header("Location:view-movie.php");
                                                 }
                                                 elseif($users['type']==3){
                                                    header("Location:view-movie.php");
                                                  }
                                        
                                        else{
                                            echo "Wrong Username Or Password";
                                            header("Location:index.php");
                                        }

                                
                                    }
                                }

?>