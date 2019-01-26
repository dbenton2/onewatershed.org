<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>TEST PAGE</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="calendar/calendar.css">
    <link rel="stylesheet" type="text/css" href="test.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script    
</head>
<body>


<div id="holder">

<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link"  href="wheel.php">Home</a></li>
    <li class="object"><a class="link" href="search_start.php">Search</a></li>
    <li class="object"><a class="link" href="About.php">About</a></li>
    <li class="object"><a class="link" href="upload.php">Upload</a></li>
<?php

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    echo "<li class='object'><a class='link' href='admin_page.php'>Admin</a></li>";
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
}
?>
</ul>
</div>
<div>
<div class="nav_tooltip">
<a href="login_page.php"><img class="logo" src="Images/earth_waterdrop.png"></a>
<span id="login" class="tooltiptext">Login</span>
</div>

</div>
<div>
<form method="post" action="search_display.php">
<input class="search" type="text" name="subject" placeholder="Search..">
<button class="search"><img class="search" src="Images/search-icon-th.png"></button>
</form>
</div>
</div>
<form>
<textarea rows="8" cols="60">
</textarea>
<button>POST</button>
</form>
<iframe id="news_feed" src="http://www.onewatershed.org/staging_html/news_feed.php"></iframe>

</div>
</div>
</body>


<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>



</html>