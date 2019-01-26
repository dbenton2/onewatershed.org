<?php

include '../connect.php';

  
if (isset($_POST['verify'])){
    for ($x = 0; $x< count($_POST); $x++){
        if (isset($_POST['checkbox'.$x])){
           echo "loaded<br>";
            $month = test_input($_POST['month'.$x]);
            $day = test_input($_POST['day'.$x]);
            $year = test_input($_POST['year'.$x]);
            $lessonID = test_input($_POST['lesson']);
            $address = test_input($_POST['address'.$x]);
            $email = test_input($_POST['email'.$x]);

            $sql = "UPDATE material_reservation
                    SET Verified = 'yes'
                    WHERE  Month = '$month' AND Day = '$day' AND Year = '$year' AND Lesson_ID = '$lessonID' AND Verified = 'no'";

            $results = $con->query($sql);
            if ($con->affected_rows >= 1){
            	$to = $email;
            	$subject = "Materials for ".$lessonName;
            	$txt = "Thank you for reserving materials for ".$lessonName.". Your reservation for".$month." ".$day.", ".$year." has been verified. The Materials will be brought to ".$address.". If you have any questions or need to change the address, please contact Jemima Clark at jclark5@washcoll.edu ";
            	$headers = "From: admin@onewatershed.org" . "\r\n";
            	mail($to, $subject, $txt, $headers);
                echo "success there were rows affected in the database.<br>";
                header("Location:../admin_page.php");
                exit();
            }
            else if($con->affected_rows == 0 && !mysqli_error($con)){
                echo "There were no rows affected by the sql statement and there was not an error.<br> This means the entry did not exist in the database.";
            }
            else {
                echo "Failed. the error was ".(string) mysqli_error($con)."<br> This is the sql executed: ".$sql;
            }
        }
        echo "loaded at the end of for statement<br>";
    }
}

else if (isset($_POST['delete'])){ 
    for ($x = 0; $x < count($_POST); $x++){
        if ($_POST['checkbox'.$x] == 'on'){   
            $month = test_input($_POST['month']);
            $day = test_input($_POST['day']);
            $year = test_input($_POST['year']);
            $lessonID = test_input($_POST['lesson']);
            $address = test_input($_POST['address'.$x]);
            $email = test_input($_POST['email'.$x]);

            $sql = "DELETE FROM material_reservation 
                    WHERE Month = '$month' AND Day = '$day' AND Year = '$year' AND Lesson_ID = '$lessonID' AND Verified = 'no'";
            
            $results = $con->query($sql);
            if ($con->affected_rows >= 1){
            	$to = $email;
            	$subject = "Materials for ".$lessonName;
            	$txt = "Thank you for requesting materials for ".$lessonName.". Your reservation for".$month." ".$day.", ".$year." has been denied. If you have any questions, please contact Jemima Clark at jclark5@washcoll.edu ";
            	$headers = "From: admin@onewatershed.org" . "\r\n";
            	mail($to, $subject, $txt, $headers);
                echo "success there were rows affected in the database.<br>";
                header("Location:../admin_page.php");
                exit();
            }
            else if($con->affected_rows == 0 && !mysqli_error($con)){
                 echo "There were no rows affected by the sql statement and there was not an error.<br> This means the entry did not exist in the database.";
            }
            else {
                 echo "Failed. the error was ".(string) mysqli_error($con)."<br> This is the sql executed: ".$sql;
            }
        }
    }
}

    
//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}