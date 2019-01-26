<html>
<head>
<link rel="shortcut icon" type="images/x-icon" href="favicon.ico" />
<title>OneWatershed - User Account</title>
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
    <li class="object"><a class="link" href="wheel.php">Home</a></li>
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
    echo "<li class='object'><a class='link' id='active' href='member_page.php'>". $_SESSION['username']."</a><li>";
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

<div>
<?php
include 'connect.php';

$username = $_SESSION['username'];

$sql = "SELECT Name, email, organization, language, grade
        FROM members
        WHERE username = '$username'";
     
$result = $con->query($sql);
$row = $result->fetch_assoc();

$email = $row['email'];
$organization = $row['organization'];
$language = $row['language'];
$grade = $row['grade'];
$name = $row['Name'];

echo "<h2>Welcome,</h2>";
echo "<h2>" .$name. "</h2><br>";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $organization = test_input($_POST['organization']);
    $language = test_input($_POST['language']);
    $grade = test_input($_POST['grade']);
    $updatePassword = 0;
    if($_POST['password'] != $_POST['password2']){
        $passwordErr = "The passwords do not match. Please retype them.";
    }
    else{
        $userPass = test_input($_POST['password']);
        $salt = mcrypt_create_iv(32, MCRYPT_DEV_URANDOM);

        //set options for hashing of password
        $options = [
            'cost' => 10,
            'salt' => $salt
        ];

        //generate the hashed password
        $userhash = password_hash((string)$userPass, PASSWORD_BCRYPT, $options);
                
        $updatePassword = 1;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $emailErr = "This is not a valid email format.";
        if($updatePassword = 1){
            $passwordErr = "Please retype your new password.";
        }
    }
    else{
        $email = test_input($_POST['email']);
    }
    
    if ($updatePassword == 0){
        $sql = "UPDATE members
                SET members.email = '$email', members.organization = '$organization', members.language = '$language', members.grade = '$grade'
                WHERE members.username = '$username'";
    }
    else{
        $sql = "UPDATE members
                SET members.email = '$email', members.organization = '$organization', members.language = '$language', members.grade = '$grade', members.hash = '$userhash'
                WHERE members.username = '$username'";
    }
    

            
    if ($con->query($sql) === TRUE){
        $success = "Your information has been successfully updated.";
    }
    else{
        $fail = "Sorry, your information was not updated. Please try again.";
        if($updatePassword = 1){
            $passwordErr = "Please retype your new password.";
        }
    }
    
    
}

echo "<span>$success $fail</span><br>";
echo "<form name='member' action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data' autocomplete='off'>";
echo "New Password: <input type='password' name='password' autocomplete='off' /><span class='error'>$passwordErr</span><br><br>";
echo "Confirm New Password: <input type='password' name='password2' autocomplete='off' /><span class='error'>$passwordErr</span><br><br>";
echo "Email: <input type='email' name='email' value='$email' autocomplete='off'/><span class='error'>$emailErr</span><br><br>";
echo "Organization: <input type='text' name='organization' value='$organization' autocomplete='off' /><br><br>";
echo "Language: <input type='text' name='language' value='$language' autocomplete='off' /><br><br>";
echo "Grade: <input type='text' name='grade' value='$grade' autocomplete='off' /><br><br>";
echo "<button>Update</button>";
echo "</form><br><br><br><br>";



  
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
</div>

</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/" target="_blank"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu" target="_blank"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>