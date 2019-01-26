<?php
$month = test_input($_POST['x']);
$day = test_input($_POST['y']);
$year = test_input($_POST['z']);
$lessonID = test_input($_POST['a']);

include '\connect.php';

$sql = "DELETE FROM material_reservation
        WHERE Month = '$month' AND Year = '$year' AND Day = '$day' AND Lesson_ID = '$lessonID'";
        
$result = $con->query($sql);

if ($con->affected_rows > 0){
    echo "Success";
}
else if ($con->affected_rows == 0 && !mysqli_error($con)){
    echo "No rows were affected and there was not an error with the sql.";
}
else{
    echo "failed. There was some kind of error. ". mysqli_error($con)."<br>";
}


//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}