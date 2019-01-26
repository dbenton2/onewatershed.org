<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../nav.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script>    
    function subjectSearch(name){
        if (name.length==0){
            document.getElementById("subjectSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("searchBar").innerHTML=this.responseText;
                document.getElementById("searchBar").style.display = "block";
            }
        };
        xmlhttp.open("GET", "../search/searchSubject.php?x="+name, true);
        xmlhttp.send();
    }

    function fillSubject(name){
        var string = name;
        var final = string.toString();
        document.getElementById("subject").value = final;
        document.getElementById("searchBar").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#searchBar').length) {
         document.getElementById("searchBar").style.display = "none";
        }
    });
    </script> 
    
</head>

<body>


<div id="holder">

<div class="nav">
<div class="links">
<ul class="nav">
    <!-- <li><div class="login"><a href="login_page.php"><img class="logo" src="../Images/earth_waterdrop.png"></a></div></li> -->
    <li class="object"><a class="link" href="../wheel.php">Home</a></li>
    <li class="object"><a class="link" href="../search_start.php">Search</a></li>
    <li class="object"><a class="link" href="../upload.php">Upload</a></li>
    <li class="object"><a class="link" href="../About.php">About</a></li>
    <li class="object"><a class="link" href="../partners.php">Partners</a></li>
<?php

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    echo "<li class='object'><a class='link' href='../member_page.php'>". $_SESSION['username']."</a><li>";
    echo "<li class='object'><a class='link'  id='active' href='../admin_page.php'>Admin</a></li>";
}
elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == ''){
    echo "<li class='object'><a class='link' href='../member_page.php'>". $_SESSION['username']."</a><li>";
}
?>
</ul>
<div>
<div class="nav_tooltip">
<a href="login_page.php"><img class="logo" src="../Images/earth_waterdrop.png"></a>
<span id="login" class="tooltiptext">Login</span>
</div>
<div class="nav_tooltip">
<img id="help" class="logo" src="../Images/question_mark2.png" onclick="openModal()">
<span id="" class="tooltiptext">Need Help?</span>
</div>
<div id="search">
<form method="post" action="search_display.php">
<input id="subject" class="search" type="text" name="subject" placeholder="Search.." onkeyup="subjectSearch(this.value)" autocomplete="off"><ul id="searchBar" class="searchBarResults"></ul>
<button class="search"><img class="search" src="../Images/search-icon-th.png"></button>
</form>
</div>
</div>
</div>
</div>



<br>
<br>

<?php
include '../connect.php';

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    for($x =0; $x < count($_POST); $x++){
            if ($_POST[$x] == 'on'){
                //initialize variables
                $lessonName = test_input($_POST['lessonName'.$x]);
                $lessonLanguage = test_input($_POST['language'.$x]);
                $primarySubject = test_input($_POST['primary_subject'.$x]);
                $secondarySubject = test_input($_POST['secondary_subject'.$x]);
                $oldLessonName = $_POST['oldLessonName'.$x];
                $oldPrimarySubject = $_POST['oldPrimarySubject'.$x];
                $target_dir = "PDFs/";
                $target_file = $target_dir . basename($_FILES["pdf".$x]["name"]);
                $linkName = $_FILES["pdf".$x]["name"];
                $uploadOk = 1;
                $deleteOk = 1;
                $copyOk = 1; 
                
                $sql = "SELECT live_data.Name FROM live_data WHERE live_data.Name='$lessonName'";
                $result = $con->query($sql);
                if ($result->num_rows > 0){
  	            echo "Sorry, the name " . $lessonName. " is already used. Please use a different name.<br>";
  	            $uploadOk = 0;
                }
                
                //update uploaded_data before trying to copy it to live_data
                $sql2 = "UPDATE uploaded_data
                         SET uploaded_data.Name = '$lessonName', uploaded_data.Language = '$lessonLanguage', uploaded_data.Primary_Subject = '$primarySubject', uploaded_data.Secondary_Subject = '$secondarySubject'
                         Where uploaded_data.Name = '$oldLessonName' AND uploaded_data.Primary_Subject = '$oldPrimarySubject'";
                if($con->query($sql2) != TRUE){
                    echo "There was an error updating " .$oldLessonName. "please try again.<br>";
                }         
                       
                //file upload checks if there is a new file being uploaded
                 if ($_FILES["pdf".$x]["size"] > 0){
                    
                    //get the file type
                    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx"){
                        echo "Sorry, only PDF or Word files are allowed.<br>";
                        $uploadOk = 0;
                    }
  
                    //check if the file already exists
                    if (file_exists($target_file)){
                        echo "Sorry, this file already exists.<br>Please try another file name.<br>";
                        $uploadOk = 0;
                    }
  
                    //check the file size
                    if ($_FILES["pdf".$x]["size"] > 1000000){
                       echo "Sorry, your file is too large.<br>";
                       $uploadOk = 0;
                    }
  
                    //check if the upload process has been stopped for any reason
                    if ($uploadOk == 0){
                       echo "Sorry, your file was not uploaded. Please use the back button to make changes and try again.<br>";
                    }
                    else{
                        if (move_uploaded_file($_FILES["pdf".$x]["tmp_name"], $target_file)){
                            //select insert into database now
                            $sql3 = "INSERT INTO live_data (Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language)
                                     SELECT Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language 
                                     FROM uploaded_data
                                     WHERE uploaded_data.Name='$lessonName' AND uploaded_data.Language='$lessonLanguage'";
                            if ($con->query($sql3) === TRUE){
                                $sql4 = "SELECT live_data.ID
                                         FROM live_data
                                         WHERE live_data.Name='$lessonName'";
                                $result2 = $con->query($sql4);
                                $row = $result2->fetch_assoc();
                                $nameID = $row["ID"];
                                for($i =0; $i < count($ids); $i++){
                                    $sql5 = "INSERT INTO standard_name_junction(Name_ID, Standard_ID)
                                             VALUES('$nameID','$ids[$i]')";
                                    if ($con->query($sql5) != TRUE){
                                        echo "A standard was not properly paired with the lesson in the database.";
                                        $deleteOk = 0;
                                    }
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
                                $sql6 ="DELETE FROM uploaded_data
                                     WHERE uploaded_data.Name = '$lessonName'";
                                if ($con->query($sql6) === TRUE){
                                    for($i =0; $i < count($ids); $i++){
                                        $sql7 ="DELETE FROM standard_upload_junction
                                                WHERE Standard_ID='$ids[$i]'";
                                        $con->query($sql7);
                                    }
                                }
                            }  
                        }
                    }
                }
                else{
                     //do insert to live_data when there is not a new pdf file
                     $sql3 = "INSERT INTO live_data (Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language)
                         SELECT Grade_ID, Name, PDF_link, Primary_Subject, Secondary_Subject, Language 
                         FROM uploaded_data
                         WHERE uploaded_data.Name='$lessonName' AND uploaded_data.Language='$lessonLanguage'";
                     if ($con->query($sql3) === TRUE){
                         $sql4 = "SELECT live_data.ID
                                  FROM live_data
                                  WHERE live_data.Name='$lessonName'";
                         $result2 = $con->query($sql4);
                         $row = $result2->fetch_assoc();
                         $nameID = $row["ID"];
                         for($i =0; $i < count($ids); $i++){
                             $sql5 = "INSERT INTO standard_name_junction(Name_ID, Standard_ID)
                                      VALUES('$nameID','$ids[$i]')";
                             if ($con->query($sql5) != TRUE){
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
                             $sql6 ="DELETE FROM uploaded_data
                                     WHERE uploaded_data.Name = '$lessonName'";
                             if ($con->query($sql6) === TRUE){
                                 for($i =0; $i < count($ids); $i++){
                                     $sql7 ="DELETE FROM standard_upload_junction
                                             WHERE Standard_ID='$ids[$i]'";
                                     $con->query($sql7);
                                 }
                             }
                         }  
                     }
                } 
            }
    }
}

 //clean data to ensure security
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
 

</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="../Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="../Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>