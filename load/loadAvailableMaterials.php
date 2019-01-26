<?php
//get requested materials
$ID = test_input($_REQUEST["x"]);

//connect to database and run sql querry to find materials to load
include '../connect.php';

$sql = "SELECT live_data.ID, GROUP_CONCAT(available_materials.Name)
        FROM live_data
        LEFT JOIN available_name_junction on live_data.ID=available_name_junction.Name_ID
        LEFT JOIN available_materials on available_name_junction.Material_ID=available_materials.ID
        WHERE live_data.ID ='$ID'";
        
$result = $con->query($sql);
$row = $result->fetch_assoc();
$answer = $row["GROUP_CONCAT(available_materials.Name)"];

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