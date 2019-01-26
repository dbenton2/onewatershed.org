<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Upload</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="upload.css">
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
        xmlhttp.open("GET", "search/searchSubject.php?x="+name, true);
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
    <script>    
    function languageSearch(name){
        if (name.length==0){
            document.getElementById("languageSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("languageSearch").innerHTML=this.responseText;
                document.getElementById("languageSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchLanguage.php?x="+name, true);
        xmlhttp.send();
    }

    function fillLanguage(name){
        var string = name;
        var final = string.toString();
        document.getElementById("languageInput").value = final;
        document.getElementById("languageSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#languageSearch').length) {
         document.getElementById("languageSearch").style.display = "none";
        }
    });
    </script>
    <script>    
    function subjectSearchPage(name, num){
        if (name.length==0){
            document.getElementById("primarySubjectSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("primarySubjectSearch").innerHTML=this.responseText;
                document.getElementById("primarySubjectSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchSubjectPage.php?x="+name+"&y="+num, true);
        xmlhttp.send();
    }

    function fillSubjectPage1(name){
        var string = name;
        var final = string.toString();
        document.getElementById("primarySubjectInput").value = final;
        document.getElementById("primarySubjectSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#subject').length) {
         document.getElementById("primarySubjectSearch").style.display = "none";
        }
    });
    </script>
    <script>    
    function secondarySubjectSearch(name, num){
        if (name.length==0){
            document.getElementById("secondarySubjectSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("secondarySubjectSearch").innerHTML=this.responseText;
                document.getElementById("secondarySubjectSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchSubjectPage.php?x="+name+"&y="+num, true);
        xmlhttp.send();
    }

    function fillSubjectPage2(name){
        var string = name;
        var final = string.toString();
        document.getElementById("secondarySubjectInput").value = final;
        document.getElementById("secondarySubjectSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#subject').length) {
         document.getElementById("secondarySubjectSearch").style.display = "none";
        }
    });
    </script>
    <script>    
    function standardSearch(name, index){
        if (name.length==0){
            document.getElementById("standardSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("standardSearch"+index).innerHTML=this.responseText;
                document.getElementById("standardSearch"+index).style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchStandard.php?x="+name+"&y="+index, true);
        xmlhttp.send();
    }

    function fillStandard(name, index){
        var string = name;
        var final = string.toString();
        document.getElementById("standardInput"+index).value = final;
        document.getElementById("standardSearch"+index).style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#standardSearch'+index).length) {
         document.getElementById("standardSearch"+index).style.display = "none";
        }
    });
    </script>
    <script>
    function topicDropDown(themeName){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                var text = this.responseText;
                var topics = text.split(":");
                var x = document.getElementById("topicDrop");
                while(x.length > 0){
                    x.remove(x.length - 1);
                }
                var option = document.createElement("option");
                option.text = "Please Select a Topic";
                option.selected = "true";
                x.add(option);
                //var option2 = document.createElement("option");
                //option2.text = topics[0];
                //x.add(option2);
                for(var i=0; i < 8; i++){
                    var option2 = document.createElement("option")
                    //topicString = topic[i].toString();
                    option2.text = topics[i];
                    option2.value = topics[i];
                    x.add(option2);
                }
            }
        };
        xmlhttp.open("GET", "load/loadAllTopics.php?x="+themeName, true);
        xmlhttp.send();
    }
    </script>
</head>

<body>
<div id="holder">
<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" href="wheel.php">Home</a></li>
    <!--<li class="object"><a class="link" href="search_start.php">Search</a></li>-->
    <li class="object"><a class="link" id="active" href="upload.php">Upload</a></li>
    <li class="object"><a class="link" href="resources.php">Resources</a></li>
    <li class="object"><a class="link" href="About.php">About</a></li>
    <li class="object"><a class="link" href="partners.php">Partners</a></li>
<?php

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
    echo "<li class='object'><a class='link' href='admin_page.php'>Admin</a></li>";
}
elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == ''){
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
}
?>
</ul>
<div>
<div class="nav_tooltip">
<a href="login_page.php"><img class="logo" src="Images/earth_waterdrop.png"></a>
<span id="login" class="tooltiptext">Login</span>
</div>
<div class="nav_tooltip">
<img id="help" class="logo" src="Images/question_mark2.png" onclick="openModal()">
<span id="" class="tooltiptext">Need Help?</span>
</div>
<div id="search">
<!--<form method="post" action="search_display.php">-->
<!--<input id="subject" class="search" type="text" name="subject" placeholder="Search.." onkeyup="subjectSearch(this.value)" autocomplete="off"><ul id="searchBar" class="searchBarResults"></ul>-->
<!--<button class="search"><img class="search" src="Images/search-icon-th.png"></button>-->
<!--</form>-->
</div>
</div>
</div>
</div>

<div class="title">
<img class="title" src="Images/onewatershed_VI.png">
</div>
<br>
<div class="title">
<form action='download2.php' method='post'>Download the OneWatershed Lesson Plan Template here: <button type='submit'>Download</button><input type='hidden' name='file' value='OneWatershed Lesson Plan Template'/><input type='hidden' name='filePath' value='PDFs/OneWatershed_Lesson_Plan_Template.doc'/></form>
</div>

<?php
 
  //database connection info
  include 'connect.php';
  
  //variables to use in sql queries and upload checks and validation
  $checks = 1;
  
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
      
      if (empty($_POST['name'])){
          $NameErr = "Lesson Name is required.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $error2 = "* Please reselect your file for upload.";
          $checks = 0; 
      }
      else{
          $lessonName = test_input($_POST['name']);
      }
      
      if (empty($_POST['subject'])){
          $SubjectErr = "Primary Subject is required.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $error2 = "* Please reselect your file for upload.";
          $checks = 0;
      }
      else{    
          $lessonType = test_input($_POST['subject']);
      }
          
      if (empty($_FILES['pdf']['name'])){
          $FileErr = "You are required to upload a document.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $checks = 0;
      }
      else{
          $linkName = $_FILES["pdf"]["name"];
      }
      
      if (empty($_POST['lang'])){
          $LanguageErr = "Language is required.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $error2 = "* Please reselect your file for upload.";
          $checks = 0;
      }
      else{
          $language = test_input($_POST["lang"]);
      }
      
      if (empty($_POST['stan1'])){
          $StandardErr = "Standard 1 is required.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $error2 = "* Please reselect your file for upload.";
          $checks = 0;
      }
      else{
          $standard1 = test_input($_POST['stan1']);
      }
      
      $lessonType2 = test_input($_POST['subject2']);
      $standard2 = test_input($_POST['stan2']);
      $standard3 = test_input($_POST['stan3']);
      $standard4 = test_input($_POST['stan4']);
      $standard5 = test_input($_POST['stan5']);
      $standard6 = test_input($_POST['stan6']);
      $target_dir = "PDFs/";
      $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
      $uploadOk = 1;
      $theme = test_input($_POST['theme']);
      $topic = test_input($_POST['topic']);
      $uploaderName = test_input($_POST['uploaderName']);
      $email = test_input($_POST['email']);
      $checkAll = $_POST['selectAll'];
      $checkbox = $_POST['grade1']; 
      $checkbox2 = $_POST['grade2'];
      $checkbox3 = $_POST['grade3'];
      $checkbox4 = $_POST['grade4'];
      $checkbox5 = $_POST['grade5'];
      $checkbox6 = $_POST['grade6'];
      $checkbox7 = $_POST['grade7'];
      $checkbox8 = $_POST['grade8'];
      $checkbox9 = $_POST['grade9'];
      $checkbox10 = $_POST['grade10'];
      $checkbox11 = $_POST['grade11'];
      $checkbox12 = $_POST['grade12'];
      $checkbox13 = $_POST['grade13'];
      $checkbox14 = $_POST['informal'];
      $grades = array();
   
       //get min and max grades selected by user
      if($checkAll == 'on'){
          array_push($grades,'25');
      }
      if($checkbox == 'on'){
          array_push($grades,'0');
      }
      if($checkbox2 == 'on'){
          array_push($grades,'1');
      }
      if($checkbox3 == 'on'){
          array_push($grades,'2');
      }
      if($checkbox4 == 'on'){
          array_push($grades,'3');
      }
      if($checkbox5 == 'on'){
          array_push($grades,'4');
      }
      if($checkbox6 == 'on'){
          array_push($grades,'5');
      }
      if($checkbox7 == 'on'){
          array_push($grades,'6');
      }
      if($checkbox8 == 'on'){
          array_push($grades,'7');
      }
      if($checkbox9 == 'on'){
          array_push($grades,'8');
      }
      if($checkbox10 == 'on'){
          array_push($grades,'9');
      }
      if($checkbox11 == 'on'){
          array_push($grades,'10');
      }
      if($checbox12 == 'on'){
          array_push($grades,'11');
      }
      if($checkbox13 == 'on'){
          array_push($grades,'12');
      }
      if($checkbox14 == 'on'){
          array_push($grades,'20');
      }
  
      $arrLength = count($grades);
  
      if($arrLength == 0){
          $GradeErr = "* Please select at least one grade for the lesson.";
          $error2 = "* Please reselect your file for upload.";
          $checks = 0;
      }
      if($grades[0]=='25'){
          $gradeMin = '0';
          $gradeMax = '20';
      }
      else{
          $gradeMin = $grades[0];
          $gradeMax = $grades[$arrLength - 1];
      }
      
      
      if ($checks == 1){
        
      //check connection to database
      if ($con->connect_error){
          die("Sorry, connection to database failed. Please try again.");
          $uploadOk = 0;
      }
  
      //get grade ID for insert into uploaded_data
      $sql3 = "SELECT grade_range.ID FROM grade_range WHERE Min = '$gradeMin' AND Max = '$gradeMax'";
      $result = $con->query($sql3);
      $rs = $result->fetch_assoc();
      $gradeID = $rs['ID'];
      //don't allow the upload if there is not a correct grade range in the database
      if($gradeID === NULL){
          $uploadOk = 0;
          echo"Sorry, file not uploaded due to internal error. Not a recommended grade range.<br>";
      }
      $result->free();
  
      //check name against live_data and uploaded_data to see if it has been used already. If it has ask the user to use a different name so it doesnt throw off standards pairing
      $sql10 = "SELECT live_data.Name FROM live_data WHERE live_data.Name='$lessonName'";
      $result7 = $con->query($sql10);
      if ($result7->num_rows > 0){
  	  $NameErr = "Sorry, the name " . $lessonName. " is already used. Please use a different name.";
  	  $error = "* Please reselect the grade level(s) for this lesson.";
  	  $uploadOk = 0;
      }
      $sql11 = "SELECT uploaded_data.Name FROM uploaded_data WHERE uploaded_data.Name='$lessonName'";
      $result8 = $con->query($sql11);
      if ($result8->num_rows > 0){
  	  $NameErr = "Sorry, the name " . $lessonName. " is already used. Please use a different name.";
  	  $error = "* Please reselect the grade level(s) for this lesson.";
  	  $uploadOk = 0;
      }
  
  
      //file upload checks
  
      //get the file type
      $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
      if ($fileType != "doc" && $fileType != "docx"){
          $error2 = "* Please select a PDF or Word file for upload.";
          $error = "* Please reselect the grade level(s) for this lesson.";
          $uploadOk = 0;
      }
  
      //check if the file already exists
      if (file_exists($target_file)){
         $FileErr = "Please use a different file name.";
         $error = "* Please reselect the grade level(s) for this lesson.";
         $uploadOk = 0;
      }
  
      //check the file size
      if ($_FILES["pdf"]["size"] > 1000000){
         $FileErr = "Your file is too large.";
         $error = "* Please reselect the grade level(s) for this lesson.";
         $uploadOk = 0;
      }
  
      if ($uploadOk == 0){
          echo "<br>";
      }
      else{
          //file upload and inserts into databases
          if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file)){
      
              //create insert sql statement for uploaded_data
  	      $sql = "INSERT INTO uploaded_data (Name, Primary_Subject, Secondary_Subject, Language, PDF_link, Grade_ID, Person, Recommended_Theme, Recommended_Topic)
   	              Values ('$lessonName', '$lessonType', '$lessonType2', '$language', '$linkName', '$gradeID', '$uploaderName', '$theme', '$topic')";
   	  
   	      //run sql statement for uploaded_data
   	      if ($con->query($sql) === TRUE){
   	          $sql8 = "Select uploaded_data.ID FROM uploaded_data WHERE uploaded_data.Name = '$lessonName'";
   	          $result = $con->query($sql8);
   	          $row = $result->fetch_assoc();
   	          $liveID = $row['ID'];
   	      
   	          //create sql statement for standards and insert them
 	          $sql1 = "INSERT INTO standards (Standard)
   	                   Values ('$standard1')";
   	          //run check if standard already exists in standards table
   	      
   	          if ($con->query($sql1) === TRUE){
   	              $sql6 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard1'";
   	              $result3 = $con->query($sql6);
  	              $row1 = $result3->fetch_assoc();
  	              $standardID = $row1['ID'];
  	              $sql7 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                       Values ('$liveID', '$standardID')";
  	              if ($con->query($sql7) === TRUE){ 
                              //if standard one worked check for a second standard and if there is one try to insert it into the database  	
   	                      if ($standard2 <> NULL){
   	                          $sql5 = "INSERT INTO standards (Standard)
   	                                   Values ('$standard2')";
   	                          if ($con->query($sql5) != TRUE){
      		                      echo "Error: " . $con->error. "<br>";
      		                      echo "Standard 2 did not upload correctly.<br>";
   	                          } 	    
   	                          $sql8 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard2'";
   	                          $result4 = $con->query($sql8);
  	                          $row2 = $result4->fetch_assoc();
  	                          $standardID2 = $row2['ID'];
  	                          $sql9 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                                   Values ('$liveID', '$standardID2')";
  	                          if ($con->query($sql9) != TRUE){
  	                              echo"Upload issue into database.<br>";
  	                          }
   	                      }
                              //if standard one worked check for a third standard and if there is one try to insert it into the database  	
   	                      if ($standard3 <> NULL){
   	                          $sql5 = "INSERT INTO standards (Standard)
   	                                   Values ('$standard3')";
   	                          if ($con->query($sql5) != TRUE){
      		                      echo "Error: " . $con->error. "<br>";
      		                      echo "Standard 3 did not upload correctly.<br>";
   	                          } 	    
   	                          $sql8 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard3'";
   	                          $result4 = $con->query($sql8);
  	                          $row2 = $result4->fetch_assoc();
  	                          $standardID3 = $row2['ID'];
  	                          $sql9 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                                   Values ('$liveID', '$standardID3')";
  	                          if ($con->query($sql9) != TRUE){
  	                              echo"Upload issue into database.<br>";
   	                          } 
   	                      }
   	                      //if standard one worked check for a fourth standard and if there is one try to insert it into the database  	
   	                      if ($standard4 <> NULL){
   	                          $sql5 = "INSERT INTO standards (Standard)
   	                                   Values ('$standard4')";
   	                          if ($con->query($sql5) != TRUE){
      		                      echo "Error: " . $con->error. "<br>";
      		                      echo "Standard 4 did not upload correctly.<br>";
   	                          } 	    
   	                          $sql8 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard4'";
   	                          $result4 = $con->query($sql8);
  	                          $row2 = $result4->fetch_assoc();
  	                          $standardID4 = $row2['ID'];
  	                          $sql9 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                                   Values ('$liveID', '$standardID4')";
  	                          if ($con->query($sql9) != TRUE){
  	                              echo"Upload issue into database.<br>";
  	                          }
  	                     }
  	                     if ($standard5 <> NULL){
   	                          $sql5 = "INSERT INTO standards (Standard)
   	                                   Values ('$standard5')";
   	                          if ($con->query($sql5) != TRUE){
      		                      echo "Error: " . $con->error. "<br>";
      		                      echo "Standard 5 did not upload correctly.<br>";
   	                          } 	    
   	                          $sql8 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard5'";
   	                          $result4 = $con->query($sql8);
  	                          $row2 = $result4->fetch_assoc();
  	                          $standardID5 = $row2['ID'];
  	                          $sql9 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                                   Values ('$liveID', '$standardID5')";
  	                          if ($con->query($sql9) != TRUE){
  	                              echo"Upload issue into database.<br>";
  	                          }
  	                     }
  	                     if ($standard6 <> NULL){
   	                          $sql5 = "INSERT INTO standards (Standard)
   	                                   Values ('$standard6')";
   	                          if ($con->query($sql5) != TRUE){
      		                      echo "Error: " . $con->error. "<br>";
      		                      echo "Standard 6 did not upload correctly.<br>";
   	                          } 	    
   	                          $sql8 = "Select standards.ID FROM standards WHERE standards.Standard = '$standard6'";
   	                          $result4 = $con->query($sql8);
  	                          $row2 = $result4->fetch_assoc();
  	                          $standardID6 = $row2['ID'];
  	                          $sql9 = "INSERT INTO standard_upload_junction (Name_ID, Standard_ID)
  	                                   Values ('$liveID', '$standardID6')";
  	                          if ($con->query($sql9) != TRUE){
  	                              echo"Upload issue into database.<br>";
  	                          }
  	                     }
                         }
    	             }
    	         }
    	         $to = "jclark5@washcoll.edu";
    	         $subject = "Lesson Uploaded";
    	         $txt = "A lesson has been successfully uploaded to onewatershed, named " . $lessonName.". ";
    	         $headers = "From: admin@onewatershed.org" . "\r\n";
    	         
    	         mail($to, $subject, $txt, $headers);
 	         //close connection to database
  	         $con->close();
  	         //echo "The file " . basename($_FILES["pdf"]["name"]). " has been successfully uploaded.<br>";
  	         echo "New lesson named ". $lessonName. " successfully uploaded.<br>";
             }
             else{
  	         echo "There was an error uploading your file. Please try again.<br>";
             }
        }
      }
  }
?>



<br>
<div class="form">
<p class="error"> * required field.</p>
<form name="upload" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" autocomplete="off">
<fieldset>
<div class="top">
<div class="leftSide">
<div id="language"><span class="error">* </span>Language: <input id="languageInput" type="text" name="lang" value="<?php echo $language; ?>" autocomplete="off" onkeyup='languageSearch(this.value)'/><ul id='languageSearch' class='searchResults'></ul><br><span class="error"><?php echo $LanguageErr; ?></span></div><br>
<div id="lessonName"><span class="error">* </span>Lesson Name: <input id="lessonInput" type="text" name="name" value="<?php echo $lessonName; ?>" autocomplete="off"/><br><span class="error"><?php echo $NameErr; ?></span></div><br>
<div id="primarySubject"><span class="error">* </span>Primary Subject:<input id="primarySubjectInput" type="text" name="subject" value="<?php echo $lessonType; ?>" autocomplete="off" onkeyup='subjectSearchPage(this.value, 1)' ><ul id='primarySubjectSearch' class='searchResults'></ul><br><span class="error"><?php echo $SubjectErr; ?></span></div><br> 
<div id="secondarySubject">Secondary Subject:<input id="secondarySubjectInput" type="text" name="subject2" value="<?php echo $lessonType2; ?>" onkeyup='secondarySubjectSearch(this.value, 2)' ><ul id='secondarySubjectSearch' class='searchResults'></ul></div><br>
</div>
<div class="rightSide">
<div id="grade"><p><span class="error">*</span>Please select what grade level(s) this lesson is meant for.</p>
<span class="error"><?php echo $error; ?></span>
<table class="checkbox">
<tbody class="checkbox">
<tr>
<td class="checkbox">K:<input type="checkbox" name="grade1"/>
<td class="checkbox">1:<input type="checkbox" name="grade2"/></td>
<td class="checkbox">2:<input type="checkbox" name="grade3"/></td>
<td class="checkbox">3:<input type="checkbox" name="grade4"/></td>
<td class="checkbox">4:<input type="checkbox" name="grade5"/></td></tr>
<tr><td class="checkbox">Informal:<input type="checkbox" name="informal"/></td>
<td class="checkbox">5:<input type="checkbox" name="grade6"/></td>
<td class="checkbox">6:<input type="checkbox" name="grade7"/></td>
<td class="checkbox">7:<input type="checkbox" name="grade8"/></td></td>
<td class="checkbox">8:<input type="checkbox" name="grade9"/></td></tr>
<tr><td class="checkbox">Select All:<input type="checkbox" name="selectAll"/></td>
<td class="checkbox">9:<input type="checkbox" name="grade10"/></td>
<td class="checkbox">10:<input type="checkbox" name="grade11"/></td>
<td class="checkbox">11:<input type="checkbox" name="grade12"/></td>
<td class="checkbox">12:<input type="checkbox" name="grade13"/></td>
</tr>
</tbody>
</table>
<span class="error"><?php echo $GradeErr; ?></span><br>
</div>


</div>
</div>
<div class="middle">
<?php

$sql = "SELECT Name
        FROM theme
        WHERE 1";
        
$result = $con->query($sql);

echo "<div class='leftSide'>Recommended Theme: <select name='theme' onchange='topicDropDown(this.value)'><option selected='true'>Please Select a Theme</option>";

while($row = $result->fetch_assoc()){
    echo "<option value='".$row['Name']."'>".$row['Name']."</option>";
    }
    
echo "</select></div><div class='rightSide'>Recommended Topic: <select id='topicDrop' name='topic'></select></div>";
?>
</div>
<div class="bottom">
<p>Please list the standards that would be most helpful to find this lesson.</p>
<div class="leftSide">
<div id="standard1"><span class="error">* </span>Standard 1:<input id="standardInput1" type="text" name="stan1" placeholder="ex: NGSS-HS-ETS1-2" value="<?php echo $standard1; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 1)'/><ul id='standardSearch1' class='searchResults'></ul><span class="error"><?php echo $StandardErr; ?></span></div><br>
<div id="standard2">Standard 2:<input id="standardInput2" type="text" name="stan2" value="<?php echo $standard2; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 2)'/><ul id='standardSearch2' class='searchResults'></ul></div><br>
<div id="standard3">Standard 3:<input id="standardInput3" type="text" name="stan3" value="<?php echo $standard3; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 3)'/><ul id='standardSearch3' class='searchResults'></ul></div><br>
</div>
<div class="rightSide">
<div id="standard4">Standard 4:<input id="standardInput4" type="text" name="stan4" value="<?php echo $standard4; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 4)'/><ul id='standardSearch4' class='searchResults'></ul></div><br>
<div id="standard5">Standard 5:<input id="standardInput5" type="text" name="stan5" value="<?php echo $standard5; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 5)'/><ul id='standardSearch5' class='searchResults'></ul></div><br>
<div id="standard6">Standard 6:<input id="standardInput6" type="text" name="stan6" value="<?php echo $standard6; ?>" autocomplete="off" onkeyup='standardSearch(this.value, 6)'/><ul id='standardSearch6' class='searchResults'></ul></div><br>
</div>
</div>
<br>
<div id="document"><div class="leftSide"><div>Name: <input id="uploaderNameInput" type="text" name="uploaderName" value="<?php echo $uploaderName; ?>" autocomplete="off"/></div><br>
<div>Email: <input id="emailInput" type="text" name="email" value="<?php echo $email; ?>" autocomplete="off"/></div></div>
<div class="rightSide"><span class="error"> * </span>Word Document:<input type="file" name="pdf"/><br>
<span class="error" style="text-align:center;"><?php echo $FileErr; ?><?php echo $error2; ?></span><br></div></div>
</fieldset>
<br>
<button id = "submit" type="submit">Submit</button>
</form>
<p> <b>Please list the Standards using the following format</b><br> Next Generation Science Standards as NGSS-  <br> Maryland Environmental Literacy Standards as MD-E-Lit- <br> Ocean Literacy Principles as OLP- <br> College, Career, Civic Life as C3- <br> Common Core State Standards/Common College Career Readiness as CCR-</p>


</div>


</div>

<div class="upload">
<?php
  
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
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>


</html>