<?php

if (isset($_POST["action"])) {

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    
    session_start();
$id = $_SESSION["userid"];
   add($conn,$id);
 
   header("Refresh:0; url=../index.html");



}else{

    header("location: ../logIn.html?error=fffffyyy");
    exit();

}


?>

