<?php

$name = test_input($_POST['Name']);
$address = test_input($_POST['address']);
$city = test_input($_POST['city']);
$state = test_input($_POST['state']);
$zip = test_input($_POST['zip']);
$email = test_input($_POST['email']);
$lesson = test_input($_POST['lessonID']);
$verified = 'no';

//connect to database 
include '../connect.php';

for($x=1; $x < (count($_POST)-9)/3; $x++){
    $day = test_input($_POST['day'.$x]);
    $month = test_input($_POST['month'.$x]);
    $year = test_input($_POST['year'.$x]);

    $sql = "INSERT INTO material_reservation (Lesson_ID, Name, Year, Month, Day, Address, City, State, Zip, Email, Verified)
            Values ('$lesson', '$name', '$year', '$month', '$day', '$address', '$city', '$state', '$zip', '$email', '$verified')";
        
    $result = $con->query($sql);
}

header("Location:/staging_html/resources.php?response=success");
exit();    


//function call to ensure there is no code being run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
?>