<?php
$lessonID = test_input($_REQUEST["x"]);

include '../connect.php';

$sql = "SELECT ID, Day, Month, Year, Lesson_ID, Address, City, State, Zip, Email, Verified, Name
        FROM material_reservation
        WHERE Lesson_ID = '$lessonID' && Verified = 'no'";
        
$x = 0;     
$result = $con->query($sql);
while ($row = $result->fetch_assoc()){ 
    $date = $row['Month']." ". $row['Day'].", ".$row['Year'];
    $address = $row['Address']." ".$row['City']." ".$row['State']." ".$row['Zip'];
    $htmlContent .= "<tr><td><input type='checkbox' name='checkbox".$x."' value='on'></input></td><td id='name'>".$row['Name']."<input type='hidden' name='name".$x."' value='".$row['Name']."'></td><td><input id='month' name='month".$x."' type='hidden' value='".$row['Month']."'/><input id='day' name='day".$x."' type='hidden' value='".$row['Day']."'/><input id='year' name='year".$x."' type='hidden' value='".$row['Year']."'/>".$date."</td><td>".$address." <input type='hidden' name='address".$x."' value='".$address."'></td><td>".$row['Email']."<input id='email".$x."' type='hidden' value='".$row['Email']."'></td></tr>";
    $x = $x +1;
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