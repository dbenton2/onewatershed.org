<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />  
<title>OneWatershed - Search</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="search_page.css">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
<div id="holder">
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



<div id="search"><form action="search_display.php" method="post" autocomplete="off" >
<div>Subject: <input id="subjectInput" type="text" name="subject" autocomplete="off" onkeyup="subjectSearchPage(this.value)" ><ul id="subjectSearch" class="searchResults"></ul></div><br>
<div>Grade: <input id="gradeInput" type="text" name="grade" autocomplete="off" onkeyup="gradeSearch(this.value)"/><ul id="gradeSearch" class="searchResults"></ul></div><br>
<div>Standard: <input id="standardInput" type="text" name="standard" autocomplete="off" onkeyup="standardSearch(this.value)"/><ul id="standardSearch" class="searchResults"></ul></div><br>
<div>Language: <input id="languageInput" type="text" name="language" autocomplete="off" onkeyup="languageSearch(this.value)"/><ul id="languageSearch" class="searchResults"></ul></div><br>
<button id = "submit" type="submit">Search Lessons</button>
</form></div><br><br>   


</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/" target="_blank"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu" target="_blank"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>