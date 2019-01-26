<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Register</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
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
  
</head>

<body>


<div id="holder">

<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" id="active" href="wheel.php">Home</a></li>
    <!--<li class="object"><a class="link" href="search_start.php">Search</a></li>-->
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
<!--<div id="search">-->
<!--<form method="post" action="search_display.php">-->
<!--<input id="subject" class="search" type="text" name="subject" placeholder="Search.." onkeyup="subjectSearch(this.value)" autocomplete="off"><ul id="searchBar" class="searchBarResults"></ul>-->
<!--<button class="search"><img class="search" src="Images/search-icon-th.png"></button>-->
<!--</form>-->
<!--</div>-->
</div>
</div>
</div>


<div class="title">
<img class="title" src="Images/onewatershed_VI.png">
</div>

<?php
include 'connect.php';

if ($_POST['login'] == 'Login'){
    //get username and password from login page
    $username=test_input($_POST['username']);
    $user_pass=test_input($_POST['password']);
    
     $sql="SELECT username, hash, Access_level FROM members WHERE username='$username'";
    $result=$con->query($sql);
    if($result->num_rows == 1){
        $columns = $result->fetch_assoc();
        $hash = $columns['hash'];
    
        if(password_verify($user_pass, $hash)){
   
            $AccessLevel = $columns['Access_level'];
            session_start();
    
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['accessLevel'] = $AccessLevel;
            header("Location:wheel.php");
            exit();
        }
        else{
            header("Location:login_page.php");
            exit();
        }
    }
    else{
        header("Location:login_page.php");
        exit();
    }
}
elseif ($_POST['register'] == 'Register'){
    header("Location:register_page.php");
    exit();
}
else{
    header("Location:login_page.php");
    exit();
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
<a href="https://www.washcoll.edu/centers/ces/" target="_blank"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu" target="_blank"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>