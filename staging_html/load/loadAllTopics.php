<?php
$Theme = test_input($_REQUEST["x"]);

include '../connect.php';

$sql = "SELECT GROUP_CONCAT(topic.Name SEPARATOR ':'),  theme.Name
        FROM `theme`
        LEFT JOIN topic on topic.ID = theme.topic1_ID OR topic.ID = theme.topic2_ID OR topic.ID = theme.topic3_ID OR topic.ID = theme.topic4_ID OR topic.ID = theme.topic5_ID OR topic.ID = theme.topic6_ID OR topic.ID = theme.topic7_ID OR topic.ID = theme.topic8_ID
        WHERE theme.Name ='$Theme'
        Group By theme.ID";

$result = $con->query($sql);
$row = $result->fetch_assoc();
$answer = $row["GROUP_CONCAT(topic.Name SEPARATOR ':')"];
if($answer == ""){
    $answer = "There was nothing there";
}
echo $answer;

//function call to ensure there is no code being run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>