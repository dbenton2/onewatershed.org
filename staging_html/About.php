<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - About</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="about.css"> 
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
    <li class="object"><a class="link" href="search_start.php">Search</a></li>
    <li class="object"><a class="link" href="upload.php">Upload</a></li>
    <li class="object"><a class="link" href="resources.php">Resources</a></li>
    <li class="object"><a class="link" id="active" href="About.php">About</a></li>
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

<div class="title_text">
<p><h2> Washington College Center for Environment & Society – Program Catalog<br>
For K-12 Formal & Informal Educators, Home School, Citizen Science of All Disciplines<br>
Aligned with MD Environmental Literacy, Global Ocean Literacy & Next Gen Science Standards 
</h2></p>

 <p><h1>Our Goal is to provide Educators with educator authored lesson plans by topic, with assessments, resouces, and evaluations "at a click".</h1></p>

</div>

<div class="text">

<p><b>1.</b>  <i>Agro-Ecology</i> – Concepts of agriculture and farming and ecology are explored to support sustainability.  Demonstration gardens are designed, installed and monitored on school grounds.</p>

<p><b>2.</b>  <i>Aquabotz</i> – Design, build, and operate a working underwater robot in about an hour.  “Engineers” down to the 3rd grade construct a working ROV and “fly” them in a pool.  Educators wire their own controllers and custom design their Aquabotz in this two-day workshop.  Program kits include underwater cameras and service 30 students at a time.</p>

<p><b>3.</b>	<i>BOBs and FLOs</i> – Authentic data is measured and plotted using water quality monitoring systems and weather stations.  Visually explicit data changes (<a href="http://data-fountain.rpsasa.com" target="_blank">Data Fountain</a>) are monitored through the day and shown on large monitors installed in common school areas. Causal relationships are visualized between water chemistry, weather, and land use. <a href="https://buoybay.noaa.gov/" target="_blank">NOAA Chesapeake Bay Interpretive Buoy System</a></p>

<p><b>4.</b>	<i>Build a Buoy</i> – K-12 students are challenged to break the world’s record for a small buoy holding golf balls.  Small buoys are built with PVC pieces that hold over 50 golf balls, or stand a meter high without falling over.  An indoor/outdoor thermometer is attached to create an observation buoy that measures water and air temperature. BABs program kits that service 30 students at a time will be available as a user resource. A website holds photos of records and prints certificates of achievement. Students leave knowing that buoys “mark underwater roads” and collect/transmit data.</p>

<p><b>5.</b>	<i>Issues Investigation</i> – the skill of identifying social issues that pervade in environmental investigations and using real data to support different viewpoints   will be demonstrated. Engage, Explore, Explain, Elaborate, and Evaluate – In our programs, a 6th “e” is added as “Empowerment” – which is defined as an “action item” where intrinsic worth adds intangible value to the lesson.</p>

<p><b>6.</b>	<i>Its Electric</i> – Educators work with solar panels and miniature turbines to convert sun and wind to electricity.  They also explore battery science with fruits and vegetables.  All that is learned will be transferrable to K-12 classrooms. This incorporates a “green challenge” where students work to reduce their school’s per capita energy use in competition with others in their Schoolshed. <i>(Add model railroading to explore circuitry & (and transportation))</i></p>

<p><b>7.</b>	<i>It’s for the Birds</i> – Educators are taught bird identification and basic avian science. Links are made to climate and weather, biology, geography (bird migrations), and pollination. 30 sets of binoculars and bird ID books are available for delivery to schools. Birdhouses, Bee hives, Bat Houses, Butterfly houses and gardens are installed on school properties.</p>

<p><b>8.</b>	<i>K-12 Curriculum Integration</i> – Jemima Clark works with counties to align all One Watershed programs with Federal, State, and Local standards of learning.</p>

<p><b>9.</b>	<i>Educational Passages</i> – Using a free floating, unanchored “buoy” with a sail, we explore ocean currents and how to use this as a vehicle to connect students to foreign cultures, unfamiliar climates, and varying habitats. Drifters, Floaters… <a href="http://educationalpassages.com/" target="_blank">Educational Passages</a></p>

<p><b>10.</b>   <i>Overflight</i> – Educators are taken up in an airplane and shown their watershed from the air.</p>

<p><b>11.</b>	<i>Sense-It</i> - electronic components and a multi-meter show educators how to build sensors that use voltage to measure change and use graphs and math to convert the voltage to physical measurements – temperature, conductivity, and more. (adapted from Liesl Hotaling, Sense-It)</p>

<p><b>12.</b>	<i>Sense of Place</i> – Research Boats, kayaks, canoes, and hiking are used to transit water bodies across the park limits, using observation and sampling devices to characterize the different habitats and bring “intimacy” between the park and its’ educators. This PDM may extend over two days.</p>

<p><b>13.</b>	<i>Shipwrecks</i> – In areas where submerged cultural artifacts are identified, they will be imaged with seafloor mapping equipment and their history and provenance identified.  This interdisciplinary opportunity touches governance, economics, industry, social history, ag-history, and technology. The underwater imagery has been plotted on 30’ x 25’ on billboard vinyl – students walk on it and interpret as if underwater.</p>

<p><b>14.</b>	<i>StoryMap</i> – Educators learn how to use handheld GPS units, computer based maps and online tools to create virtual and real fieldtrips incorporating learning objectives and storytelling tied to local landmarks.</p>

<p><b>15.</b>	<i>TREEs (Tree Research for Environmental Education)</i> – Trees in schoolyards are tagged with QR-codes.   Each tag is linked to the mapped, GPS coordinates of the tree, its species, height, and girth (at 1m). A photo is archived in the web-searchable data base each year.  The trees are adopted/assigned to students and monitored throughout their academic career (12 yrs).  In the future, trees will be DNA fingerprinted and that information archived in a searchable database.  This program was developed to meet NGSS research needs of all ages.</p>

<p><b>16.</b>	<i>Up, Up and Away</i> - Flight Science – Kites, Balloons, Paper Airplanes, Unmanned Aerial Systems (Drones) are brought systemically into K-12 classrooms.  Educators learn flight science and remote sensing and how to present it to their students at all ages. Select educators will qualify for their certificate to legally pilot Unmanned Aerial System (UAS).</p>

<p><b>17.</b>	<i>KITEs (Kites in Technology Education)</i> – Using kites with an attached remote sensing system, video is recorded and atmospheric measurements are collected. This is part of a NASA funded STEM program.  20 kite systems are available for shipping to trained and certified educators. </p>

<p><b>18.</b>	<i>That’s fishy to me</i> – Educators learn the basics of fly-fishing – along the way learn entomology and the art of raising fish in the classroom (need aquaria, fishing poles, etc.) </p>

<p><b>19.</b>	<i>Weather or Not… </i>– Learn the basics of weather reporting, weather forecasting, reading weather maps, and differentiate between weather and climate (Kites – see up, up, and away).</p>

<p><b>20.</b>	<i>Virtual Field Trips - X,Y,Z,</i> – Use remote control boats and trucks to collect GPS referenced data – spectral imagery, thermal mapping, bathymetry. (in planning) </p>


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