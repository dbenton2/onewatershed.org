<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
<title>OneWaterShed - Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../admin.css">
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
    echo "<li class='object'><a class='link' id='active' href='../admin_page.php'>Admin</a></li>";
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

<?php 
include '../connect.php';

$lessonName = $_POST['lessonName'];

$sql = "SELECT ID
        FROM live_data
        WHERE Name = '$lessonName'";
        
$result = $con->query($sql);
$row = $result->fetch_assoc();
if ($row == 0){
    echo "That lesson " .$lessonName. " could not be found in the database. Please try a different lesson name.<br>";
}
$lesson_ID = $row['ID'];

for ($x=0; $x < count($_POST); $x++){
    if ($_POST[$x] == 'on'){
        $uploadOk = 1;
        $material = $_POST['material'.$x];
        $table = $_POST['table'.$x];
        $fromTable = $_POST['fromTable'.$x];
        
        $sql = "SELECT ID
                FROM ".$fromTable."
                Where Name = '$material'";
                
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $material_ID = $row['ID'];
        
        $sql2 = "INSERT INTO ".$table."(Name_ID, Material_ID)
                 Values ('$lesson_ID', '$material_ID')";
                 
        if ($con->query($sql2) == TRUE){
            echo $material. "was paired with " .$lessonName. "<br>";
        }
    }    
}



?>
<br>
<form action="../admin_page.php">
<button>Return to Admin Section</button>
</form>
</div>
</div>
</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="../Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="../Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>