<?php
$day = test_input($_POST['day']);
$month = test_input($_POST['month']);
$year = test_input($_POST['year']);
$name = test_input($_POST['Name']);
$address = test_input($_POST['address']);
$city = test_input($_POST['city']);
$state = test_input($_POST['state']);
$zip = test_input($_POST['zip']);
$email = test_input($_POST['email']);
$lesson = test_input($_POST['lessonID']);
$topic = $_POST['topic'];
$lessonName = $_POST['lessonName'];
$verified = 'no';



//connect to database and run sql querry to find theme name
include '../connect.php';

$sql = "INSERT INTO material_reservation (Lesson_ID, Name, Year, Month, Day, Address, City, State, Zip, Email, Verified)
        Values ('$lesson', '$name', '$year', '$month', '$day', '$address', '$city', '$state', '$zip', '$email', '$verified')";
        
$result = $con->query($sql);

if($topic == '' && $lessonName == ''){
    header("Location:../resources.php?response=success");
    exit();    
}
else if($lessonName == ''){
    header("Location:../lesson.php?topic=$topic");
    exit();
}
else{
    header("Location:../lesson.php?lesson=$lessonName");
    exit();
}







//function call to ensure there is no code being run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
?>