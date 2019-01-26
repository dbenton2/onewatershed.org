<?php

$lesson_ID = test_input($_GET['x']);
$month = test_input($_GET['y']);
$year = test_input($_GET['z']);

include '../connect.php';

$sql1 = "SELECT ID, Kit_Name, Lesson_ID, Count(Kit_Name) AS Number_of_Kits 
         FROM resource_kit 
         WHERE Lesson_ID = '$lesson_ID'
         Group BY Lesson_ID";
         
$result1 = $con->query($sql1);
$response = $result1->fetch_assoc();
$kit_Count = $response["Number_of_Kits"];        

$sql = "SELECT Day, Month, Year, Lesson_ID,COUNT(Day) AS Number_for_Day
        FROM material_reservation
        WHERE Lesson_ID = '$lesson_ID' && Month = '$month' && Year = '$year'
        GROUP BY Day
        HAVING COUNT(Day) >= '$kit_Count'";


$result = $con->query($sql);
while ($row = $result->fetch_assoc()){
if ($row["Day"] == null){
        $answer[] = 0;
}
else{

        $answer[] = $row["Day"];
        $answer[] = $row["Verified"];
    }
}



echo json_encode($answer);
 
//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}        
?>       