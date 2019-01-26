<?php
//get requested materials
$userName = test_input($_REQUEST["x"]);

//connect to database and run sql querry to find materials to load
include '../connect.php';

$sql = "SELECT username, Name 
        FROM members 
        WHERE username='$userName'";
        
$result = $con->query($sql);
$row = $result->fetch_assoc();
$answer = $row["Name"];

echo $answer;

//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>