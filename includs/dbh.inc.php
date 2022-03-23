<?php

$serverName = "sql4.freesqldatabase.com";
$dBUsername = "sql4480869";
$dBPassword = "vr2idb9srd";
$dBName = "sql4480869";


$conn = mysqli_connect($serverName,$dBUsername ,$dBPassword,$dBName );

if(!$conn){

    die("connection faild:". mysqli_connect_error());
}
?>