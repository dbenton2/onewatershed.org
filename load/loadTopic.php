<?php
//get requested theme id
$themeIndex = test_input($_REQUEST["q"]);
$topicIndex = test_input($_REQUEST["y"]);

//connect to database and run sql querry to find theme name
include '../connect.php';

$sql = "SELECT topic.Name 
        FROM `theme` 
        LEFT JOIN topic on theme.topic".$topicIndex."_ID = topic.ID
        WHERE theme.ID = $themeIndex";

$result = $con->query($sql);
$row = $result->fetch_assoc();
$answer = $row["Name"];
$final = urlencode($answer)."#".str_replace(" ", "#",$answer);


echo $final;

//function call to ensure there is no code being run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>