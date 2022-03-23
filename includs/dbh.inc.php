<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "studyRight";


$conn = mysqli_connect($serverName,$dBUsername ,$dBPassword,$dBName );

if(!$conn){

    
    die("connection faild:". mysqli_connect_error());
}
?>
