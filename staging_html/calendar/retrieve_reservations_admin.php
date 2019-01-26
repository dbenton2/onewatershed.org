<?php

$lesson_ID = test_input($_GET['x']);
$month = test_input($_GET['y']);
$year = test_input($_GET['z']);

include '../connect.php';

$sql = "SELECT Day, Month, Year, Lesson_ID, Verified
        FROM material_reservation
        WHERE Lesson_ID = '$lesson_ID' && Month = '$month' && Year = '$year'
        ORDER BY Day";


$result = $con->query($sql);

if ($row["Day"] == null){
    $answer[] = 0;
}
else{
    while ($row = $result->fetch_assoc()){
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