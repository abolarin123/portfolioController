<?php 
$serverName = 'localhost';
$username   = 'root';
$userPassword = "";
$DB = "portfolio";

$con =mysqli_connect($serverName,$username,$userPassword,$DB);

if ($con->connect_error){
    echo("Connection failed.".mysqli_connect_error());
    die();

}
?> 