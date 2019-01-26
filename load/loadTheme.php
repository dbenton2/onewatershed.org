<?php
//get requested theme id
$x = test_input($_REQUEST["q"]);

//connect to database and run sql querry to find theme name
include '../connect.php';

$sql = "SELECT Name FROM theme
        WHERE theme.ID = '$x'";

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