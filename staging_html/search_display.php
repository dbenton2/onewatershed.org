<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Search</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="search_page.css">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    
    <script>    
    function subjectSearchPage(name){
        if (name.length==0){
            document.getElementById("subjectSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("subjectSearch").innerHTML=this.responseText;
                document.getElementById("subjectSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "searchSubjectPage.php?x="+name, true);
        xmlhttp.send();
    }

    function fillSubjectPage(name){
        var string = name;
        var final = string.toString();
        document.getElementById("subjectInput").value = final;
        document.getElementById("subjectSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#subject').length) {
         document.getElementById("subjectSearch").style.display = "none";
        }
    });
    </script>
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
    function standardSearch(name){
        if (name.length==0){
            document.getElementById("standardSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("standardSearch").innerHTML=this.responseText;
                document.getElementById("standardSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchStandard.php?x="+name, true);
        xmlhttp.send();
    }

    function fillStandard(name){
        var string = name;
        var final = string.toString();
        document.getElementById("standardInput").value = final;
        document.getElementById("standardSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#standardSearch').length) {
         document.getElementById("standardSearch").style.display = "none";
        }
    });
    </script>
    <script>    
    function gradeSearch(name){
        if (name.length==0){
            document.getElementById("gradeSearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("gradeSearch").innerHTML=this.responseText;
                document.getElementById("gradeSearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/searchGrade.php?x="+name, true);
        xmlhttp.send();
    }

    function fillGrade(name){
        var string = name;
        var final = string.toString();
        document.getElementById("gradeInput").value = final;
        document.getElementById("gradeSearch").style.display = "none";
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#gradeSearch').length) {
         document.getElementById("gradeSearch").style.display = "none";
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
</head>

<body>

<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" href="wheel.php">Home</a></li>
    <li class="object"><a class="link" id="active" href="search_start.php">Search</a></li>
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
<form method="post" action="search_display.php">
<input id="subject" class="search" type="text" name="subject" placeholder="Search.." onkeyup="subjectSearch(this.value)" autocomplete="off"><ul id="searchBar" class="searchBarResults"></ul>
<button class="search"><img class="search" src="Images/search-icon-th.png"></button>
</form>
</div>
</div>
</div>
</div>

<div class="title">
<img class="title" src="Images/onewatershed_VI.png">
</div>


<div>    
<?php

include 'connect.php';
//create variables needed
  
$searchSubject = test_input($_POST['subject']);
$searchGrade = test_input($_POST['grade']);
$searchStandard = test_input($_POST['standard']);
$searchLanguage = test_input($_POST['language']);


?>

<div id='search'><form action="search_display.php" method='post' autocomplete='off'>
<div>Subject: <input id='subjectInput' type='text' name='subject' value="<?php echo $searchSubject; ?>" autocomplete='off' onkeyup='subjectSearchPage(this.value)' ><ul id='subjectSearch' class='searchResults'></ul></div><br>
<div>Grade: <input id='gradeInput' type='text' name='grade' value="<?php echo $searchGrade; ?>" autocomplete='off' onkeyup='gradeSearch(this.value)'/><ul id='gradeSearch' class='searchResults'></ul></div><br>
<div>Standard: <input id='standardInput' type='text' name='standard' value="<?php echo $searchStandard; ?>" autocomplete='off' onkeyup='standardSearch(this.value)'/><ul id='standardSearch' class='searchResults'></ul></div><br>
<div>Language: <input id='languageInput' type='text' name='language' value="<?php echo $searchLanguage; ?>" autocomplete='off' onkeyup='languageSearch(this.value)'/><ul id='languageSearch' class='searchResults'></ul></div><br>
<button id = 'submit' type='submit'>Search Lessons</button>
</form></div><br><br>  

<?php

//create sql statment to select what the user is looking for 
if ($searchStandard == '' && $searchSubject == '' && $searchGrade == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%')
        GROUP BY live_data.ID";
}
elseif($searchGrade == '' && $searchStandard == '' && $searchLanguage == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject')
        GROUP BY live_data.ID";
}
elseif($searchGrade == '' && $searchSubject == '' && $searchLanguage == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (standards.Standard LIKE '%$searchStandard%')
        GROUP BY live_data.ID";
}
elseif ($searchStandard == '' && $searchLanguage == '' && $searchSubject ==''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max)
        GROUP BY live_data.ID";
}
elseif ($searchGrade == '' && $searchStandard == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject')
        GROUP BY live_data.ID";
}
elseif ($searchSubject == '' && $searchGrade == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND (standards.Standard LIKE '%$searchStandard%')
        GROUP BY live_data.ID";
}
elseif($searchSubject == '' && $searchStandard == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max)
        GROUP BY live_data.ID";
}
elseif($searchLanguage == '' && $searchGrade == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject') AND (standards.Standard LIKE '%$searchStandard%')
        GROUP BY live_data.ID";
}
elseif($searchLanguage == '' && $searchStandard == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject') AND ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max)
        GROUP BY live_data.ID";
}
elseif($searchLanguage == '' && $searchSubject == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max) AND (standards.Standard LIKE '%$searchStandard%')
        GROUP BY live_data.ID";
}
elseif($searchLanguage == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max) AND (standards.Standard LIKE '%$searchStandard%') AND (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject')
        GROUP BY live_data.ID";
}
elseif($searchGrade == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND (standards.Standard LIKE '%$searchStandard%') AND (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject')
        GROUP BY live_data.ID";
}
elseif($searchSubject == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND (standards.Standard LIKE '%$searchStandard%') AND ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max)
        GROUP BY live_data.ID";
}
elseif($searchStandard == ''){
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE (live_data.Language LIKE '%$searchLanguage%') AND (live_data.Primary_Subject LIKE'$searchSubject' OR live_data.Secondary_Subject LIKE'$searchSubject') AND ('$searchGrade' BETWEEN grade_range.Min AND grade_range.Max)
        GROUP BY live_data.ID";
}
else{
$sql = "Select  live_data.ID, live_data.Name, live_data.Primary_Subject, grade_range.Grade_Range, live_data.PDF_link, GROUP_CONCAT(standards.Standard), live_data.Language 
        FROM live_data 
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID 
        WHERE 1
        GROUP BY live_data.ID";
}
//run the sql statement and save it in result
$result = $con->query($sql);

//iterate through result and output each result into a table for the user to view   
if ($result->num_rows > 0){
   echo "<div class='search_results'><section class=''><div class='container'><table class='results'>";
   echo "<thead><tr class='header'><th>Lesson Plan Name<div>Lesson Plan Name</div></th>";
   echo "<th>Lesson Plan Language<div>Lesson Plan Language</div></th>";
   echo "<th>Primary Subject<div>Primary Subject</div></th>";
   echo "<th>Secondary Subject<div>Secondary Subject</div></th>";
   echo "<th>Grade(s)<div>Grade(s)</div></th>";
   echo "<th>Standards of Learning<div>Standards of Learning</div></th>";
   echo "<th>Lesson Plan<div>Lesson Plan</div></th>";
   echo "<th>Download<div>Download</div></th></tr></thead>";
   echo "<tbody>";
   while($row = $result->fetch_assoc()){
   	echo "<tr><td>" .$row["Name"]. "</td>";
   	echo "<td>" .$row["Language"]. "</td>";
   	echo "<td> " .$row["Primary_Subject"]. "</td>";
   	echo "<td> " .$row["Secondary_Subject"]. "</td>";
   	echo "<td> " .$row["Grade_Range"]. "</td>";
   	echo "<td>" .$row["GROUP_CONCAT(standards.Standard)"]. "</td>";
   	echo "<td><form action='single_lesson.php' method='post'><input type='hidden' name='lesson' value='".$row["Name"]. "'/><button>View</button></form></td>";
   	echo "<td><form action='download.php' method='post'><button type='submit'>Download</button><input type='hidden' name='file' value='".$row["Name"]."'/><input type='hidden' name='filePath' value='PDFs/".$row["PDF_link"]. "'/></form></td></tr>";
   }
   echo "</tbody></table></div></section></div>";
}else {
   echo "0 results";
}



function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
</div>
<br>
<br>
</div>
</body>


<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>



</html>