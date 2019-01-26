<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Register</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="register_page.css">
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //connecting to server
    include 'connect.php';

    //user information to add to members table
    $checks = 1;
    if (empty($_POST['username'])){
        $userNameErr = "Username is required.";
        $error = "Please retype your password.";
        $checks = 0;
    }
    else{
        $userName = test_input($_POST['username']);
    }
    
    if (empty($_POST['password']) || empty($_POST['password2']) || $_POST[password] != $_POST['password2']){
        $passwordErr = "Passwords do not match.";
        $checks = 0;
    }
    else{
        $userPass = test_input($_POST['password']);
        $userPass2 = test_input($_POST['password2']);
    }
    
    $firstName = test_input($_POST['firstName']);
    $lastName = test_input($_POST['lastName']);
    $name = $firstName. " ". $lastName;
    if (empty($_POST['email'])){
        $emailErr = "Email is required.";
        $error = "Please retype your password.";
        $checks = 0;
    }
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $emailErr = "This is not a valid email format.";
        $error = "Please retype your password.";
        $checks = 0;
    }
    else{
        $email = test_input($_POST['email']);
    }
    $organization = test_input($_POST['organization']);
    $language = test_input($_POST['language']);
    $grade = test_input($_POST['grade']);
    //$accessLevel = "user";
    $salt = mcrypt_create_iv(32, MCRYPT_DEV_URANDOM);

    //set options for hashing of password
    $options = [
        'cost' => 10,
        'salt' => $salt
    ];

    //generate the hashed password
    $userhash = password_hash((string)$userPass, PASSWORD_BCRYPT, $options);

    $sql = "SELECT members.username
            FROM members
            WHERE members.username = '$username'";
            
    $sql2 = "SELECT members.email
             FROM members
             WHERE members.email = '$email'";
         
    $result = $con->query(sql);
    $result2 = $con->query(sql2);

    if ($checks == 1){
        if ($result->num_rows >= 1){
            $userNameErr = "That Username is Taken. Please Select Another Username.";
            $error = "Please retype your password.";
            $checks = 0;
        }
        elseif ($result2->num_rows >= 1){
            $emailErr = "That email is registered with an account already.";
            $error = "Please retype your password.";
            $checks = 0;
        }
        else{
            $sql2 = "INSERT INTO members (username, hash, Name, email, organization, language, grade)
                     VALUES ('$userName', '$userhash', '$name', '$email', '$organization', '$language', '$grade')";

            //run sql query
            if ($con->query($sql2) === TRUE){
                $success = "You are registered and can now login";
                $userName = '';
                $firstName = '';
                $lastName = '';
                $email = '';
                $organization = '';
                $language = '';
                $grade = '';
            }
            else{
                $fail = "Sorry, you have not been registered. Please try again.";
            }
        }
    }
}
?>

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
<br>
<br>
<?php echo $success;?>
<?php echo $fail;?>
<br>
<div id="form">
<span class="error">* required field</span><br>

<form name="register" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
<fieldset>
<div id="leftSide">
<div id="username"><span class="error">*</span>Username: <input id="usernameInput" type="text" name="username" value="<?php echo $userName; ?>" autocomplete="off" /><span class="error"><?php echo $userNameErr;?></span></div><br>
<div id="password"><span class="error">*</span>Password: <input id="passwordInput" type="password" name="password" autocomplete="off" /><span class="error"><?php echo $passwordErr;?><?php echo $error;?></span></div><br>
<div id="confirm"><span class="error">*</span>Confirm Password: <input id="password2Input" type="password" name="password2" autocomplete="off" /><span class="error"><?php echo $passwordErr;?><?php echo $error;?></span></input></div><br>
<div id="email"><span class="error">*</span>Email: <input id="emailInput" type="email" name="email" value="<?php echo $email; ?>" autocomplete="off" /><span class="error"><?php echo $emailErr;?></span></div><br>
</div>
<div id="rightSide">
<div id="name">First Name: <input id="nameInput" type="text" name="firstName" value="<?php echo $firstName; ?>" autocomplete="off" /> Last Name: <input id="name2Input" type="text" name="lastName" value="<?php echo $lastName; ?>" autocomplete="off" /></div><br>
<div id="organization">Organization: <input id="organizationInput" type="text" name="organization" value="<?php echo $organization; ?>" autocomplete="off" /></div><br>
<div id="language">Language you teach in: <input id="languageInput" type="text" name="language" value="<?php echo $language; ?>" autocomplete="off" /></div><br>
<div id="grade">Grade Level you work with: <input id="gradeInput" type="text" name="grade" value="<?php echo $grade; ?>" autocomplete="off" /></div><br>
<div><span id="info" >You may enter multiple Organizations, Languages and Grade Levels seperated by a comma</span><br></div>
</div>
<div>
<button type="submit" name="submit" value="Register">Register</button><br><br>
</div>
</fieldset>
</form>
</div>
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
<a href="https://www.washcoll.edu/centers/ces/" target="_blank"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu" target="_blank"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>