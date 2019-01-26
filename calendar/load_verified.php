<?php
$lessonID = test_input($_REQUEST["x"]);

include '../connect.php';

$sql = "SELECT ID, Day, Month, Year, Lesson_ID, Address, City, State, Zip, Email, Verified, Name
        FROM material_reservation
        WHERE Lesson_ID = '$lessonID' && Verified = 'yes'";
        
      
$result = $con->query($sql);
while ($row = $result->fetch_assoc()){ 
    $date = $row['Month']." ". $row['Day'].", ".$row['Year'];
    $address = $row['Address']." ".$row['City']." ".$row['State']." ".$row['Zip'];
    $htmlContent .= "<tr><td>".$row['Name']."</td><td>".$date."</td><td>".$address."</td><td>".$row['Email']."</td></tr>";
}
echo $htmlContent;

//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>