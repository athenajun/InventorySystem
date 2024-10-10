<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_db";

$connection = mysqli_connect($server, $username, $password, $dbname);
if(!$connection){
echo "Connection has Failed!";
} else{
    // echo "Connected Succesfully";
}
?>