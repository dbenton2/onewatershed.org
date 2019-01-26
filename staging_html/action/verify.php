<?php
include '../connect.php';

//start session to check that the person has signed in
session_start();

//do check if the person is logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
   	
for($x =0; $x < count($_POST); $x++){
           if ($_POST[$x] == 'on'){
               //only do things in this if statement other wise it will create problems
               $uploadOk = 1;
               $copyOk = 1;
               $deleteOk = 1;
               $lessonName = $_POST['lessonName'.$x];
               $pdfLink = $_POST['link' .$x];
               $standardIDs = $_POST['standardsIDs' .$x];
               $ids = explode(",",$standardIDs);
               
               
               //run checks before trying copy
               
               //check database connection
               if ($conn->connect_error){
                   die("Sorry, connection to database failed. Please try again.");
                   $uploadOk = 0;
               }
               
               //check if any names and links in live_data match this entry
               $sql = "SELECT live_data.Name, live_data.PDF_link
                       FROM live_data
                       WHERE live_data.Name='$lessonName' OR live_data.PDF_link='$pdfLink'";
               $result = $con->query($sql);
               if ($result->num_rows > 0){
                   echo "There is already an entry in live_data with the same name(" .$lessonName. ") and/or PDF(" .$pdfLink. ").<br>";
                   $uploadOk = 0;
               }
               
               //if uploadOk = 1 run the copy and let user know it was verified.
               if ($uploadOk == 1){
                   //do copy here
                   $sql2 = "INSERT INTO live_data (Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language)
                            SELECT Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language 
                            FROM uploaded_data
                            WHERE uploaded_data.Name='$lessonName' AND uploaded_data.PDF_link='$pdfLink'";
                   if ($con->query($sql2) === TRUE){
                       $sql3 = "SELECT live_data.ID
                                FROM live_data
                                WHERE live_data.Name='$lessonName'";
                       $result2 = $con->query($sql3);
                       $row = $result2->fetch_assoc();
                       $nameID = $row["ID"];
                       //echo "live_data ID " .$nameID. "<br>";
                       for($i =0; $i < count($ids); $i++){
                           //echo "standard_ID " .$ids[$i]."<br>";
                           $sql4 = "INSERT INTO standard_name_junction(Name_ID, Standard_ID)
                                    VALUES('$nameID','$ids[$i]')";
                           if ($con->query($sql4) != TRUE){
                               echo "A standard was not properly paired with the lesson in the database.";
                               $deleteOk = 0;
                           }
                       }
                   }
                   else{
                        echo "The lesson " .$lessonName. " was not copied properly.<br>";
                        $copyOk = 0;
                   }
                   if ($copyOk == 1){
                       echo $lessonName." verified<br>";
                       if ($deleteOk == 1){
                           $sql5 ="DELETE FROM uploaded_data
                                   WHERE uploaded_data.Name='$lessonName' AND uploaded_data.PDF_link='$pdfLink'";
                           if ($con->query($sql5) === TRUE){
                               for($i =0; $i < count($ids); $i++){
                                   $sql6 ="DELETE FROM standard_upload_junction
                                           WHERE Standard_ID='$ids[$i]'";
                                   $con->query($sql6);
                               }
                           }
                       }
                       else{
                            echo "The lesson " .$lessonName. " was not deleted!<br>";
                       }
                   }
               }
               if ($uploadOk == 0 OR $copyOk == 0 OR $deleteOk ==0){
                    echo "The lesson ".$lessonName." was not verified. Please contact Daniel Benton to resolve the issue.<br>";
               }
               else{
                   echo "the lesson" .$lessonName. " was verified.<br>";
               }
           }
       }
?>