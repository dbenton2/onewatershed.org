<?php
//database login info
$host = 'localhost';
$user = 'copyUser';
$password = 'crazyFish16!';
$dbname = 'onewatershed_live_data';

//connect to the database
$con = new mysqli($host, $user, $password, $dbname);
    
//check connection to database
if ($con->connect_error){
    die("Sorry, connection to database failed. Please try again.");
}

?>    