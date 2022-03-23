<?php

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once 'dbh.inc.php';

    require_once 'functions.inc.php';
    


    if (emptyInput($name,$email ,$uid ,$pwd ,$pwdRepeat) !==false) {

        header("location: ../signIn.html?error=emptyinput");
        exit();
    }

    if (pwdMatch($pwd ,$pwdRepeat) !==false) {

        header("location: ../signIn.html?error=passworddontmatch");
        exit();
    }
    if(uidExists($conn,$email)){

        header("location: ../signIn.html?error=emailexist");
        exit();
    }

    creatUser($conn, $name, $email, $uid, $pwd);
  
    
}
else{
    header("location: ../signIn.html");
    exit();
}
