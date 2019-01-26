<html>
<head>
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="wheel.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript">
    var themeIndex = 1;
     function getTopic(topicIndex, themeIndex){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                var text = this.responseText;
                var checkText = text.split("#");
                if(checkText.length > '3'){
                    var finalText = checkText[1] + " " + checkText[2] + " " + checkText[3];
                    var finalText2 = "";
                    for( i = 4; i < checkText.length; i++){
                        finalText2 = finalText2 + " " + checkText[i];  
                    }
                    document.getElementById("topic" + topicIndex).innerHTML = finalText;
                    document.getElementById("topic" + topicIndex + "B").innerHTML = finalText2;
                }
                else if(checkText.length > '2'){
                    document.getElementById("topic" + topicIndex).innerHTML = checkText[1] + " " + checkText[2];
                    document.getElementById("topic" + topicIndex + "B").innerHTML = " ";
                }
                else{
                    document.getElementById("topic" + topicIndex).innerHTML = checkText[1];
                    document.getElementById("topic" + topicIndex + "B").innerHTML = " ";
                }
                document.getElementById("reference" + topicIndex).setAttribute("xlink:href", "lesson.php?topic=" + checkText[0]);
            }
        };
        xmlhttp.open("GET", "load/loadTopic.php?q=" + themeIndex + "&y=" + topicIndex, true);
        xmlhttp.send();
    }
      
    function spinWheelRight(){
        themeIndex++;
        var xmlhttp = new XMLHttpRequest();
        if(themeIndex >19){themeIndex = 1;}
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("theme").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "load/loadTheme.php?q=" + themeIndex, true);
        xmlhttp.send();
            for (i = 1; i < 9; i++){
                getTopic(i, themeIndex);
            }
        var locationString = "Images/Pie_Slices/Pie_Slice_" + themeIndex +".png";               
        document.getElementById("indicator_img").setAttribute('src',locationString);
    }
    
    function spinWheelLeft(){
        themeIndex--;
        var xmlhttp = new XMLHttpRequest();
        if(themeIndex < 1){themeIndex = 19;}
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("theme").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "load/loadTheme.php?q=" + themeIndex, true);
        xmlhttp.send();
            for (i = 1; i < 9; i++){
                getTopic(i, themeIndex);
            }
        var locationString = "Images/Pie_Slices/Pie_Slice_" + themeIndex +".png";
        document.getElementById("indicator_img").setAttribute('src',locationString);
    }
    </script>
    
    <script>
    var previousIndex = 0;
    function loadSlice(index){
        
        themeIndex = index;
        document.getElementById("dropdown_"+index).classList.toggle("show");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("theme").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "load/loadTheme.php?q=" + index, true);
        xmlhttp.send();
            for (var i = 1; i < 9; i++){
                getTopic(i, index);
            }
       var locationString = "Images/Pie_Slices/Pie_Slice_" + themeIndex +".png";
        document.getElementById("indicator_img").setAttribute('src',locationString);
    
    window.onclick = function(event) {
        if(!event.target.matches('.dropbtn')){

            var dropdowns = document.getElementsByClassName("dropdown-content");
            var x;
            for (x = 0; x < dropdowns.length; x++) {
                var openDropdown = dropdowns[x];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
        else if(previousIndex != index - 1){
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var x;
            for (x = 0; x < dropdowns.length; x++) {
                var openDropdown = dropdowns[x];
                if (x != index - 1 && openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    previousIndex = index - 1;
                }
            }
        }
     }
    }
    </script>
    
    <script>
    function openModal(){
         var modal = document.getElementById("helpModal");
        modal.style.display = "block";
    }    
        
    function closeModal(){
        var modal = document.getElementById("helpModal");
        modal.style.display = "none";
    }
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
  
</head>

<body>

<div id="holder">

<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" id="active" href="wheel.php">Home</a></li>
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

<div id="helpModal" class="modal">
<div id="helpModal" class="modal-content">
<div id="helpModal" class="modal_header">
<span class="close" onclick="closeModal()">&times;</span>
<h1>Help Section</h1>
</div>
<div class="modal_body">
<p>How to use the Lesson Selection Wheel</p>
<img class="modal_animation" src="Images/animation.gif">
</div>
</div>
</div>

<div id="wheel">



<div class="title">
<img class="title" src="Images/onewatershed_VI.png">
</div>

<div id="right_column">
</div>

<div id="left_column">
  <div class="dropdown">
    <button onclick="loadSlice(1)" class="dropbtn">Agro-Ecology Literate</button>
    <div id="dropdown_1" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Selective Breeding Adaptions GMOs');?>">Selective Breeding Adaptions GMOs</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Soil Types Best Ag Practices');?>">Soil Types Best Ag Practices</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Land Use & Management Run Off');?>">Land Use & Management Run Off</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ideal Growth, Seasons Conditions & Variables');?>">Ideal Growth, Seasons Conditions & Variables</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Soil Organisms & Natural Change');?>">Soil Organisms & Natural Change</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Seeds & Pollinators');?>">Seeds & Pollinators</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Gardening & Planting Seeds');?>">Gardening & Planting Seeds</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Seasons & Farm Animals');?>">Seasons & Farm Animals</a> 
    </div>
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(2)" class="dropbtn">Bird Literate</button>
    <div id="dropdown_2" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Symbiotic Relationships Bioaccumulation');?>">Symbiotic Relationships Bioaccumulation</a>
      <a href="lesson.php?topic=<?php  echo urlencode('ECC Climate Change Population Math');?>">ECC Climate Change Population Math</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Adaptation - Classification Evolution of Beak Shape');?>">Adaptation - Classification Evolution of Beak Shape</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Owl Pellets/Food Web');?>">Owl Pellets/Food Web</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sound, Flight (Patterns)');?>">Sound, Flight (Patterns)</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Habitat');?>">Habitat</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Camouflage');?>">Camouflage</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Geography Characteristics');?>">Geography Characteristics</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(3)" class="dropbtn">Buoy Literate</button>
    <div id="dropdown_3" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Forcasting & Modeling');?>">Forcasting & Modeling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Data Analysis');?>">Data Analysis</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Data Buoys & Data Fountain');?>">Data Buoys & Data Fountain</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sampling & Statistics');?>">Sampling & Statistics</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sensors');?>">Sensors</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Buoy Building');?>">Buoy Building</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Buoy Purposes');?>">Buoy Purposes</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sink or Float');?>">Sink or Float</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(4)" class="dropbtn">Chesapeake Bay Literate</button>
    <div id="dropdown_4" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Climate Change Sea Level');?>">Climate Change Sea Level</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Fish, Waterfowl, Bivalves');?>">Fish, Waterfowl, Bivalves</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Bay Grasses, Wetlands, Sediment');?>">Bay Grasses, Wetlands, Sediment</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Nutrients & Water Quality');?>">Nutrients & Water Quality</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Agriculture');?>">Agriculture</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Weather');?>">Weather</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Population Growth');?>">Population Growth</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Watershed, Rivers and Streams');?>">Watershed, Rivers and Streams</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(5)" class="dropbtn">Direct Sampling Literate</button>
     <div id="dropdown_5" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Otter Trawl/Oyster Scrape');?>">Otter Trawl/Oyster Scrape</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Direct vs Indirect Sampling');?>">Direct vs Indirect Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Plankton Tow');?>">Plankton Tow</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Coring - Vibracore/Box');?>">Coring - Vibracore/Box</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Coring(Piston)');?>">Coring(Piston)</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Coring(Drop)');?>">Coring(Drop)</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Grab Samples');?>">Grab Samples</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Water Samples');?>">Water Samples</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(6)" class="dropbtn">Energy Literate</button>
    <div id="dropdown_6" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Buildings');?>">Buildings</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Climate Change');?>">Climate Change</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Communitites');?>">Communities</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Efficiency');?>">Efficiency</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Industry');?>">Industry</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Public Health');?>">Public Health</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Transportation');?>">Transportation</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Renewable vs Non Renewable');?>">Renewable vs Non Renewable</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(7)" class="dropbtn">Engineering Literate</button>
    <div id="dropdown_7" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Autonomous Underwater Vehicles');?>">Autonomous Underwater Vehicles</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Remotely Operated Vehicles');?>">Remotely Operated Vehicles</a>
      <a href="lesson.php?topic=<?php  echo urlencode('CNC Controls Computer Numerical Controls');?>">CNC Controls Computer Numerical Controls</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Software Controls');?>">Software Controls</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Wiring, Electricity, Current, Amps & Volts');?>">Wiring, Electricity, Current, Amps & Volts</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Race Boat');?>">Race Boat</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Build a Boat');?>">Build a Boat</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Tools & Assembly');?>">Tools & Assembly</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(8)" class="dropbtn">GIS, GPS, Mapping Literate</button>
    <div id="dropdown_8" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Watershed & Schoolshed mapping and Data Analysis');?>">Watershed & Schoolshed mapping and Data Analysis</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Maps & GIS Layers Adding Data');?>">Maps & GIS Layers Adding Data</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Using GPS Units');?>">Using GPS Units</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Adding Z to the X,Y');?>">Software Controls</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Map Coordinates X,Y');?>">Map Coordinates X,Y</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Map Type & Classification');?>">Map Type & Classification</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Map Reading');?>">Map Reading</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sense of Place');?>">Sense of Place</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(9)" class="dropbtn">Issues Investigation Literate</button>
    <div id="dropdown_9" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Interpreting Data/Constructing Explanations');?>">Interpreting Data/Constructing Explanations</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Designing Investigations');?>">Designing Investigations</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Discovery and Defining Problems');?>">Discovery and Defining Problems</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Asking Questions');?>">Asking Questions</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Recognizing Anomolies');?>">Recognizing Anomolies</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Recognizing Patterns');?>">Recognizing Patterns</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Natural Phenomena');?>">Natural Phenomena</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Curiosity');?>">Curiosity</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(10)" class="dropbtn">Ocean Literate</button>
    <div id="dropdown_10" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean Exploration');?>">Ocean Exploration</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean & Human Linkage');?>">Ocean & Human Linkage</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean Live Diversity');?>">Ocean Live Diversity</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean Life Ecosystems');?>">Ocean Life Ecosystems</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean Makes Earth Habitable');?>">Ocean Makes Earth Habitable</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean Influence on Weather and Climate');?>">Ocean Influence on Weather and Climate</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ocean and Ocean Life Shape Earth Features');?>">Ocean and Ocean Life Shape Earth Features</a>
      <a href="lesson.php?topic=<?php  echo urlencode('One Big Ocean Many Features');?>">One Big Ocean Many Features</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(11)" class="dropbtn">Pollinator Literate</button>
    <div id="dropdown_11" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Genetically Modified Organisms & Seed Banks');?>">Genetically Modified Organisms & Seed Banks</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Invasive Species & Competition');?>">Invasive Species & Competition</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Plant Anatomy & Pollination');?>">Plant Anatomy & Pollination</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Gardening & Planting Seeds');?>">Gardening & Planting Seeds</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Types of Pollinators');?>">Types of Pollinators</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Growing Season & Food');?>">Growing Season & Food</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Plants/Animals & Seed Pollinators');?>">Plants/Animals & Seed Pollinators</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Bees');?>">Bees</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(12)" class="dropbtn">Remote Sensing Literate</button>
    <div id="dropdown_12" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('AUV/ROV & Remote Sampling');?>">AUV/ROV & Remote Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Mapping');?>">Mapping</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sonar and Radar');?>">Sonar and Radar</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Unmanned Systems');?>">Unmanned Systems</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Direct & Indirect Sampling');?>">Direct & Indirect Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Spatial & Temporal Sampling');?>">Spatial & Temporal Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Global Positioning');?>">Global Positioning</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Maps');?>">Maps</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(13)" class="dropbtn">Research Literate</button>
    <div id="dropdown_13" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Evaluate Action');?>">Evaluate Action</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Design Issues & Ask Questions');?>">Design Issues & Ask Questions</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Construct, Communicate, Refine');?>">Construct, Communicate, Refine</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Analyze & Interpret Data');?>">Analyze & Interpret Data</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Plan & Conduct Investigations');?>">Plan & Conduct Investigations</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Define Issues Ask Questions');?>">Define Issues Ask Questions</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Driving Questions');?>">Driving Questions</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Learning Objective');?>">Learning Objective</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(14)" class="dropbtn">Science Literate</button>
    <div id="dropdown_14" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Physics');?>">Physics</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Geology');?>">Geology</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Ecology');?>">Ecology</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Chemistry');?>">Chemistry</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Earth Sciences');?>">Earth Sciences</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Biology');?>">Biology</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Atmosphere');?>">Atmosphere</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Math');?>">Math</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(15)" class="dropbtn">Social Sciences Literate</button>
    <div id="dropdown_15" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Family, Self, School Community');?>">Family, Self, School Community</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Local Government, Zoning & Policy');?>">Local Government, Zoning & Policy</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Maryland Settlement, Gov\'t Communitites (Colonial)');?>">Maryland Settlement, Gov&#39t Communitites (Colonial)</a>
      <a href="lesson.php?topic=<?php  echo urlencode('World Geography');?>">World Geography</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Early & Late American');?>">Early & Late American</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Colonial Revolution Exploration');?>">Colonial Revolution Exploration</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Government Economics');?>">Government Economics</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sense of Plcae');?>">Sense of Plcae</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(16)" class="dropbtn">Underwater Exploration Literate</button>
    <div id="dropdown_16" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('AUVs and ROVs');?>">AUVs and ROVs</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sub Bottom Profiler');?>">Sub Bottom Profiler</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Magnetometer');?>">Magnetometer</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Side Scan Sonar');?>">Side Scan Sonar</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Bathymetry');?>">Bathymetry</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Sampling');?>">Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Global Positioning');?>">Global Positioning</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Maps');?>">Maps</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(17)" class="dropbtn">Water Quality Literate</button>
    <div id="dropdown_17" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Water Chemistry & Sampling');?>">Water Chemistry & Sampling</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Pollution Tolerant Index Benthic Macro Invertebrate Index');?>">Pollution Tolerant Index Benthic Macro Invertebrate Index</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Biotic Factors - Biology');?>">Biotic Factors - Biology</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Dissolved Oxygen/ pH');?>">Dissolved Oxygen/ pH</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Salinity/Nutrients');?>">Salinity/Nutrients</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Turbidity');?>">Turbidity</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Runoff');?>">Runoff</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Temperature');?>">Temperature</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(18)" class="dropbtn">Watershed Literate</button>
    <div id="dropdown_18" class="dropdown-content">
      <a href="lesson.php?topic=<?php  echo urlencode('Stewardship Projects');?>">Stewardship Projects</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Eutrophication');?>">Eutrophication</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Soil, Sediments, Runoff');?>">Soil, Sediments, Runoff</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Physical Parameters');?>">Physical Parameters</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Watershed Delineation');?>">Watershed Delineation</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Chemical Parameters');?>">Chemical Parameters</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Biiological Parameters');?>">Biological Parameters</a>
      <a href="lesson.php?topic=<?php  echo urlencode('Maps & Mapping');?>">Maps & Mapping</a>
    </div> 
  </div>
  <div class="dropdown">
    <button onclick="loadSlice(19)" class="dropbtn">Weather Literate</button>
    <div id="dropdown_19" class="dropdown-content">
      <a href="lesson.php?topic=<?php echo urlencode('Climate & Weather Relationship to Earth Systems');?>">Climate & Weather Relationship to Earth Systems</a>
      <a href="lesson.php?topic=<?php echo urlencode('Satellite Tools: GIS/GPS');?>">Satellite Tools: GIS/GPS</a>
      <a href="lesson.php?topic=<?php echo urlencode('Modeling: Clouds, Wind, Rainfall');?>">Modeling: Clouds, Wind, Rainfall</a>
      <a href="lesson.php?topic=<?php echo urlencode('Climate vs Weather');?>">Climate vs Weather</a>
      <a href="lesson.php?topic=<?php echo urlencode('Weather Prediction');?>">Weather Prediction</a>
      <a href="lesson.php?topic=<?php echo urlencode('Air Temp/Precipitation');?>">Air Temp Precipitation</a>
      <a href="lesson.php?topic=<?php echo urlencode('Data Collection');?>">Data Collection</a>
      <a href="lesson.php?topic=<?php echo urlencode('Observe & Measure');?>">Observe & Measure</a>
    </div> 
  </div>
</div>


<div id="indicator">
<img id="indicator_img" class="indicator" src="Images/Pie_Slices/Pie_Slice_1.png">
</div>
<div class="buttons">
<div id="leftButton"><div class="tooltip"><img class="leftButton" onclick="spinWheelLeft()" src="Images/left_arrow.png" alt="Left Arrow"><span id="previous" class="tooltiptext">Previous Slice</span></div></div>
<div id="rightButton"><div class="tooltip"><img class="rightButton" onclick="spinWheelRight()" src="Images/right_arrow.png" alt="Right Arrow"><span id="next" class="tooltiptext">Next Slice</span></div></div>
<div id="themeName">
<h2><span id="theme">Agro-Ecology Literate</span></h2>
</div>
<span class="pieSlice">


<svg width="385" height="712">
   <g>
   <a  class="pieSlice" id="reference1" xlink:href="lesson.php?topic=<?php  echo urlencode('Selective Breeding Adaptions GMOs');?>">
   <polygon points="5,10 17.5,96.25 367.5,96.25 380,10" stroke="black" stroke-width="4" fill="white" />
   <text id="topic1" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="53.125">Selective Breeding Adaptions</text>
   <text id="topic1B" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="73.125"> GMOs</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference2" xlink:href="lesson.php?topic=<?php  echo urlencode('Soil Types Best Ag Practices');?>">
   <polygon points="17.5,96.25 30,182.5 355,182.5 367.5,96.25" stroke="black" stroke-width="4" fill="white" />
   <text id="topic2" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="139.375">Soil Types Best</text>
   <text id="topic2B" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="159.375"> Ag Practices</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference3" xlink:href="lesson.php?topic=<?php  echo urlencode('Land Use & Management Run Off');?>">
   <polygon points="30,182.5 42.5,268.75 342.5,268.75 355,182.5" stroke="black" stroke-width="4" fill="white" />
   <text id="topic3" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="225.625">Land Use &</text>
   <text id="topic3B" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="245.625"> Management Run Off</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference4" xlink:href="lesson.php?topic=<?php  echo urlencode('Ideal Growth, Seasons Conditions & Variables');?>">
   <polygon points="42.5,268.75 55,355 330,355 342.5,268.75" stroke="black" stroke-width="4" fill="white" />
   <text id="topic4" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="311.875">Ideal Growth, Seasons</text>
   <text id="topic4B" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="331.875">Conditions & Variables</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference5" xlink:href="lesson.php?topic=<?php  echo urlencode('Soil Organisms & Natural Change');?>">
   <polygon points="55,355 67.5,441.25 317.5,441.25 330,355" stroke="black" stroke-width="4" fill="white" />
   <text id="topic5" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="398.125">Soil Organisms &</text>
   <text id="topic5B" class="pieSlice" alignment-baseline="middle" text-anchor="middle" x="192.5" y="418.125"> Natural Change</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference6" xlink:href="lesson.php?topic=<?php  echo urlencode('Seeds & Pollinators');?>">
   <polygon points="67.5,441.25 80,527.5 305,527.5 317.5,441.25" stroke="black" stroke-width="4" fill="white" />
   <text id="topic6" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="484.375">Seeds & Pollinators</text>
   <text id="topic6B" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="504.375"></text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference7" xlink:href="lesson.php?topic=<?php  echo urlencode('Gardening & Planting Seeds');?>">
   <polygon points="80,527.5 92.5,613.75 292.5,613.75 305,527.5" stroke="black" stroke-width="4" fill="white" />
   <text id="topic7" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="570.625">Gardening & Planting</text>
   <text id="topic7B" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="590.625"> Seeds</text>
   </a>
   </g>
   <g>
   <a class="pieSlice" id="reference8" xlink:href="lesson.php?topic=<?php  echo urlencode('Seasons & Farm Animals');?>">
   <polygon points="92.5,613.75 105,700 280,700 292.5,613.75" stroke="black" stroke-width="4" fill="white" />
   <text id="topic8" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="656.875">Seasons & Farm </text>
   <text id="topic8B" class="pieSlice" alignment-baseline="middle"  text-anchor="middle" x="192.5" y="676.875">Animals</text>
   </a>
   </g>
</svg>
</span>

</div>

</div>
</div>

</body>
<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>
</html>