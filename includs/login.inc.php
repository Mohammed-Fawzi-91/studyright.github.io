<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
 

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';



    if (emptyLogin($email ,$pwd) !== false) {

        header("location: ../logIn.html?error=emptyinput");
        exit();
    }
    if (uidExists($conn,$email)) {

        logInUser($conn,$email,$pwd);

    }
    
    else {
        header("location: ../logIn.html?error=wrongEmail");

    }




}else{

    header("location: ../logIn.html?error=fffffyyy");
    exit();

}


?>