<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
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
        xmlhttp.open("GET", "searchSubject.php?x="+name, true);
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
    function topicDropDown(themeName, index){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                var text = this.responseText;
                var topics = text.split(":");
                var x = document.getElementById("topicDrop"+index);
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
    <!-- <li><div class="login"><a href="login_page.php"><img class="logo" src="Images/earth_waterdrop.png"></a></div></li> -->
    <li class="object"><a class="link" href="wheel.php">Home</a></li>
    <li class="object"><a class="link" href="search_start.php">Search</a></li>
    <li class="object"><a class="link" href="upload.php">Upload</a></li>
    <li class="object"><a class="link" href="resources.php">Resources</a></li>
    <li class="object"><a class="link" href="About.php">About</a></li>
    <li class="object"><a class="link" href="partners.php">Partners</a></li>
<?php

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
    echo "<li class='object'><a class='link'  id='active' href='admin_page.php'>Admin</a></li>";
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
<form method="post" action="search_display.php">
<input id="subject" class="search" type="text" name="subject" placeholder="Search.." onkeyup="subjectSearch(this.value)" autocomplete="off"><ul id="searchBar" class="searchBarResults"></ul>
<button class="search"><img class="search" src="Images/search-icon-th.png"></button>
</form>
</div>
</div>
</div>
</div>

<div>
	<form action='admin_page.php' method='post'>
		<div id='button'>
		<button id='submit' type='submit' name='modify'>Return to Admin Page</button>
		</div>
	</form>
</div>

<?php
include 'connect.php';

//start session to check that the person has signed in
session_start();

//do check if the person is logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    
    //if the person is logged in check if they are verifying or deleting and run process

    if (isset($_POST['verify'])){
       //copy selected entries to live_data from uploaded_data as well as all of the info needed to make all connections work
       //and then delete them from uploaded_data so that they do not appear and the user does not need to manual delete them
       //iterate through POST to find which ones were selected and only verify those entries
       
       $sql2 = "SELECT Name
                FROM theme
                WHERE 1";
       
       echo "<form action='action/verify.php' method='post'><section class=''><div class='lesson_container'><table class='lessons'>"; 
        
        echo "<thead><tr><th>Theme & Topic<div>Theme & Topic</div></th>";
        echo "<th>Recommended Theme<div>Recommended Theme</div></th>";
        echo "<th>Recommended Topic<div>Recommended Topic</div></th>";
        echo "<th>Name<div>Name</div></th>";
        echo "<th>Language<div>Language</div></th>";
        echo "<th>Primary Subject<div>Primary Subject</div></th>";
        echo "<th>Secondary Subject<div>Secondary Subject</div></th>";
        echo "<th>Grade(s)<div>Grade(s)</div></th>";
        echo "<th>Standard(s)<div>Standard(s)</div></th>";
        echo "<th>View<div>View</div></th></tr></thead><tbody>";
        $y = 0;
       for($x =0; $x < count($_POST); $x++){
           if ($_POST[$x] == 'on'){
                
                $lessonName = $_POST['Name'.$x];
                $pdfLink = $_POST['Link'.$x];
                $standardIDs = $_POST['Standards_ID'.$x];
                $standards = $_POST['Standard'.$x];
                $primary_subject = $_POST['Primary_Subject'.$x];
                $secondary_subject = $_POST['Secondary_Subject'.$x];
                $language = $_POST['Language'.$x];
                $grade = $_POST['Grade'.$x];
                $recommendedTheme = $_POST['Theme'.$x];
                $recommendedTopic = $_POST['Topic'.$x];
                                               

   	        $result2 = $con->query($sql2);       
   	            echo "<tr class='results'><td><div>Theme: <select name='theme".$y."' onchange='topicDropDown(this.value,".$y.")'><option selected='true'>Please Select a Theme</option>";
   	            while($row2 = $result2->fetch_assoc()){
                        echo "<option value='".$row2['Name']."'>".$row2['Name']."</option>";
                    }
   	        echo "</select> Topic: <select id='topicDrop".$y."' name='topic".$y."'></select></div></td>";
   	        echo "<td>".$recommendedTheme."</td>";
   	        echo "<td>".$recommendedTopic."</td>";
                echo "<td><input type='hidden' name='lessonName".$y."' value='$lessonName'/>". $lessonName."</td>";
                echo "<td><input type='hidden' name='language".$y."' value='$language'/>".$language."</td>";
                echo "<td><input type='hidden' name='primary_subject".$y."' value='$primary_subject'/>".$primary_subject."</td>";
                echo "<td><input type='hidden' name='secondary_subject".$y."' value='$secondary_subject'/>".$secondary_subject."</td>";
                echo "<td><input type='hidden' name='grade".$y."' value='$grade'/>".$grade."</td>";
                echo "<td><input type='hidden' name='standards_ID".$y."' value='$standardIDs'/><input type='hidden' name='standards".$y."' value='$standards'/>".$standards."</td>";
                echo "<td><input type='hidden' name='link".$y."' value='$pdfLink'/><a href=PDFs/$pdfLink target='_blank'>$pdfLink</a></td>";
                
                $y = $y + 1;
           }
       }
       echo "</tbody></table></div></section>";
       echo "<br><button>Submit</button></form>";
    }
    elseif (isset($_POST['delete'])){
        //delete selected entries from uploaded_data without copying them to live_data
        //iterate through POST to find which ones were selected and only verify those entries
        for($x =0; $x < count($_POST); $x++){
            if ($_POST[$x] == 'on'){
                //only do things in this if statement other wise it will create problems
                $lessonName = $_POST['Name'.$x];
                $pdfLink = $_POST['Link' .$x];
                $standardIDs = $_POST['Standards_ID' .$x];
                $ids = explode(",",$standardIDs);
                               
                $sql ="DELETE FROM uploaded_data
                               WHERE uploaded_data.Name='$lessonName' AND uploaded_data.PDF_link='$pdfLink'";
                       if ($con->query($sql) === TRUE){
                           for($i =0; $i < count($ids); $i++){
                               $sql2 ="DELETE FROM standard_upload_junction
                                       WHERE Standard_ID='$ids[$i]'";
                               $con->query($sql2);
                           }
                       }
                       else{
                            echo "The lesson " .$lessonName. " was not deleted!<br>";
                       }
                echo "The lesson ".$lessonName." was deleted<br>";
                
            }
        }
    }
    elseif (isset($_POST['modify'])){
    
        echo "<div><form action='action/commit.php' method='post' enctype='multipart/form-data'><section class=''><div class='lesson_container'><table class='lessons'><thead>";
        
        echo "<tr class='header'><th>Checkbox<div>Checkbox</div></th>";
        echo "<th>Name<div>Name</div></th>";
        echo "<th>Language<div>Language</div></th>";
        echo "<th>Primary Subject<div>Primary Subject</div></th>";
        echo "<th>Secondary Subject<div>Secondary Subject</div></th>";
        echo "<th>Grade(s)<div> Grade(s)</siv></th>";
        echo "<th>Standard(s)<div>Standard(s)</div></th>";
        echo "<th>Lesson Plan<div>Lesson Plan</div></th>";
        echo "<th>Upload New Lesson Plan<div>Upload New Lesson Plan</div></th></tr></thead><tbody>";
        $y = 0;
        for($x =0; $x < count($_POST); $x++){
            if ($_POST[$x] == 'on'){
                //do modify stuff here
                $lessonName = $_POST['Name'.$x];
                $pdfLink = $_POST['Link' .$x];
                $standardIDs = $_POST['Standards_ID' .$x];
                $ids = explode(",",$standardIDs);
                $standards = $_POST['Standard'.$x];
                $primary_subject = $_POST['Primary_Subject' .$x];
                $secondary_subject = $_POST['Secondary_Subject' .$x];
                $language = $_POST['Language' .$x];
                $grade = $_POST['Grade' .$x];
                                               
                echo "<tr><td><input type='checkbox' name='".$y."'/></td>";
                echo "<td><input type='text' name='lessonName".$y."' value='$lessonName'/><input type='hidden' name='oldLessonName".$y."' value='$lessonName'/></td>";
                echo "<td><input type='text' name='language".$y."' value='$language'/></td>";
                echo "<td><input type='text' name='primary_subject".$y."' value='$primary_subject'/><input type='hidden' name='oldPrimarySubject".$y."' value='$primary_subject'/></td>";
                echo "<td><input type='text' name='secondary_subject".$y."' value='$secondary_subject'/></td>";
                echo "<td>$grade</td>";
                echo "<td>$standards</td>";
                echo "<td><a href=PDFs/$pdfLink target='_blank'>$pdfLink</a></td>";
                echo "<td><input type='file' name='pdf".$y."'><br><br></td></tr>";
                //echo "modify button selected<br>";
                
                $y = $y + 1;
            }
        }
        echo "</tbody></table></div></section>";
        echo"<br><button id='submit' type='submit'>Verify</button></form></div>";    
    }
}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:login.php");
}
?>
</div>
<br>
<br>

</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>