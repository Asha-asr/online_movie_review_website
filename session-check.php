<?php

if (!isset($_SESSION["user"]) || $_SESSION["user"] != "admin"){
    header("Location:index.php");
}	

?>