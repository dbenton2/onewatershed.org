<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="calendar/calendar.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <!--<script src="action/sorttable.js"></script>-->
    
    <script>
    function openadmin(evt, name){
        //variables needed
        var i;
        var tabcontent;
        var tablinks;
        
        //get all ements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++){
            tabcontent[i].style.display = "none";
        }
        
        //get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++){
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        
        //show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(name).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>
    
    <script>
    function search(){
        var username = document.getElementById("username").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search/searchMember.php?x=" +username, true);
        xmlhttp.send();
        document.getElementById("users").style.display = "block";
        document.getElementById("person").value = username;
    }
    </script>
    
    <script>
    function loadTopics(number){
        var x = document.getElementById("selectTheme"+number).value
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadyStatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                topics = this.responseText;
                finaltopics = topics.split(":");
                for(var i = 0; i<finaltopics.length; i++){
                    var opt = document.createElement("option")
                    opt.value = finaltopics[i]
                    opt.innerHTML = finaltopics[i]
                    document.getElementById("selectTopic"+number).appendChild(opt);
                }
                document.getElementById("test").innerHTML = x;  
            }
        };
        xmlhttp.open("GET", "load/loadAllTopics.php?x="+x, true);
        xmlhttp.send();
    }
    </script>
    <script>
    function searchLesson(name){
        if (name.length==0){
            document.getElementById("livesearch").innerHTML = "";
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.display = "block";
            }
        };
        xmlhttp.open("GET", "search/livesearch.php?x="+name, true);
        xmlhttp.send();
    }
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#livesearch').length) {
         document.getElementById("livesearch").style.display = "none";
        }
    });
    </script>
    <script>
    function fill(name){
        var string = name;
        var final = string.toString();
        document.getElementById("search").value = final;
        document.getElementById("livesearch").style.display = "none";
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
    
    <script>
    //display calendar
    
    //variables to know what month is being shown for use with left and right buttons
    var visibleMonth = 0;
    var visibleYear = 0;
    
    function displayCalendar(ID){
 
        //variables needed for displaying the calendar and number of days for each month 
        var htmlContent ="";
        var FebNumberOfDays ="";
        var counter = 1;
 
        //getting the current date and month
        var dateNow = new Date();
        var month = dateNow.getMonth();
        visibleMonth = month;
    
        //setting the next and previous month based on the current date
        var nextMonth = month+1; //+1; //Used to match up the current month with the correct start date.
        var prevMonth = month -1;
        var day = dateNow.getDate();
        var year = dateNow.getFullYear();
        visibleYear = year;
 
 
        //Determing if February (28,or 29)  
        if (month == 1 || month == 2){
           if ( (year%100!=0) && (year%4==0) || (year%400==0)){
             FebNumberOfDays = 29;
           }else{
             FebNumberOfDays = 28;
           }
        }
 
 
        // names of months and week days.
        var monthNames = ["January","February","March","April","May","June","July","August","September","October","November", "December"];
        var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thrusday","Friday", "Saturday"];
        var dayPerMonth = ["31", ""+FebNumberOfDays+"","31","30","31","30","31","31","30","31","30","31"];
 
 
        // days in previous month and next one , and day of week.
        var nextDate = new Date(visibleYear, month, 1,0,0,0,0);
        var weekdays= nextDate.getDay();
        var weekdays2 = weekdays;
        var numOfDays = dayPerMonth[month];
        var tableCells = 0;
     
 
 
       //show the previous months days at the beginning of the calendar if the first day of the current month is not Sunday
       if(month == 0){
            var prevMonthDays = dayPerMonth[12];
        }
        else{ var prevMonthDays = dayPerMonth[month - 1];}
 
        prevMonthDays = prevMonthDays - weekdays + 1;
 
        //sets the previous months days and adds the previous month on click function call 
        while (weekdays>0){
           htmlContent += "<td class='largeMonthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
        // used in next loop.
            weekdays--;
            prevMonthDays++;
            tableCells++;
        }

        var xobj = new XMLHttpRequest();
        xobj.onreadystatechange = function(){
           if (xobj.readyState == 4 && xobj.status == "200"){
              var holder = JSON.parse(this.responseText);      
 
            var i = 0;
            
            if (holder == null){
                    holder = 0;
            }
            
            // loop to build the calander body.
            while (counter <= numOfDays){
                
 
                // When to start new line.
                if (weekdays2 > 6){
                    weekdays2 = 0;
                    htmlContent += "</tr><tr class='cal'>";
                }

               // if counter is current day.
               // highlight current day and add reservation onclick to days of visible month
               if (counter == day){
                   htmlContent +="<td class='largeDayNow'>"+counter+"</td>";
               }else if(counter == holder[i]){
                   if (holder[i+1] == 'no'){
                       htmlContent +="<td class='largeDayRequested'>"+counter+"</td>";
                   }
                   else{
                       htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
                   }
                   i = i+2;
               }else if(counter >= day + 14){
                   htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";  
               }else{ 
                   htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
               }
    
               weekdays2++;
               counter++;
               tableCells++;
            }
 
            var nextMonthDays = 1;

            //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
            while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
                htmlContent += "<td class='largeMonthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
                nextMonthDays++;
                tableCells++;
            }
 
            // building the calendar html body.
            var calendarBody = "<table class='largeCalendar' style='padding-bottom: 15px;'>";
            calendarBody += "<tr class='cal'>";
            calendarBody += htmlContent;
            calendarBody += "</tr></table>";
            //set the content of div 
            document.getElementById("cal-frame").innerHTML=calendarBody;
            document.getElementById("label").innerHTML=monthNames[month]+" "+year;
 
           }
       };
       xobj.open('GET', 'calendar/retrieve_reservations.php?x='+ID+'& y='+monthNames[month]+'& z='+year, true);
       xobj.send();
       
       }   
       
    // this is where the nextMonth function starts for changing which month and year are visible.
    function nextMonth(ID){
        //increment the visible month by one 
    	visibleMonth++;
    	//if the visible month is greater than or equal to 11 reset it to 0 to represent Januaray and incremnet the visible year by 1
    	if(visibleMonth >= 12){
    	    visibleMonth = 0;
    	    visibleYear++;
    	}

    	
    	
    	//varibles for displaying the calendar
        var htmlContent ="";
        var FebNumberOfDays ="";
        var counter = 1;
 
 
        var dateNow = new Date();
        var month = visibleMonth;

        var nextMonth = month+1; //+1; //Used to match up the current month with the correct start date.
        var prevMonth = month -1;
        var day = dateNow.getDate();
        var year = visibleYear;
         
 
        //Determining if February (28,or 29)  
        if (month == 1 || month == 2){
           if ( (year%100!=0) && (year%4==0) || (year%400==0)){
             FebNumberOfDays = 29;
           }else{
             FebNumberOfDays = 28;
           }
        }
 
 
        // names of months and week days.
        var monthNames = ["January","February","March","April","May","June","July","August","September","October","November", "December"];
        var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thrusday","Friday", "Saturday"];
        var dayPerMonth = ["31", ""+FebNumberOfDays+"","31","30","31","30","31","31","30","31","30","31"];
 
 
        // days in previous month and next one , and day of week.
        if(nextMonth == 0){
           var prevYear = year-1;
           var nextDate = new Date(prevYear, month, 1,0,0,0,0);;
        }
        else{var nextDate = new Date(visibleYear, month, 1,0,0,0,0);}
        
        var weekdays= nextDate.getDay();
        var weekdays2 = weekdays;
        var numOfDays = dayPerMonth[month];
        var tableCells = 0;
     
 
 
 
       if(month == 0){
            var prevMonthDays = dayPerMonth[11];
        }
        else{ var prevMonthDays = dayPerMonth[month - 1];}
 
        prevMonthDays = prevMonthDays - weekdays + 1;
 
        // this leave a white space for days of previous month.
        while (weekdays>0){
           htmlContent += "<td class='largeMonthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
        // used in next loop.
            weekdays--;
            prevMonthDays++;
            tableCells++;
        }
 
        var xobj = new XMLHttpRequest();
        xobj.onreadystatechange = function(){
           if (xobj.readyState == 4 && xobj.status == "200"){
              var holder = JSON.parse(this.responseText);      
 
            var i = 0;
            
            if (holder == null){
               holder = 0;
           }
            
        // loop to build the calendar body.
        while (counter <= numOfDays){
 
            // When to start new line.
           if (weekdays2 > 6){
               weekdays2 = 0;
               htmlContent += "</tr><tr>";
           }
 
           // if counter is current day.
           // highlight current day using the CSS defined in header.
           if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter == day){
               htmlContent +="<td class='largeDayNow'>"+counter+"</td>";
           }else if(counter == holder[i]){
                   if (holder[i+1] == 'no'){
                       htmlContent +="<td class='largeDayRequested'>"+counter+"</td>";
                   }
                   else{
                       htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
                   }
                   i = i+2;
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }else{
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }
    
           weekdays2++;
           counter++;
           tableCells++;
        }
 
        var nextMonthDays = 1;
 
        //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
        while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
            htmlContent += "<td class='largeMonthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
            nextMonthDays++;
            tableCells++;
        }
 
 
 
        // building the calendar html body.
        var calendarBody = "<table class='largeCalendar' style='padding-bottom: 15px;'>";
        calendarBody += "<tr>";
        calendarBody += htmlContent;
        calendarBody += "</tr></table>";
        // set the content of div .
        document.getElementById("cal-frame").innerHTML=calendarBody;
        document.getElementById("label").innerHTML=monthNames[month]+" "+year;
        
        }
       };
       xobj.open('GET', 'calendar/retrieve_reservations.php?x='+ID+'& y='+monthNames[visibleMonth]+'& z='+visibleYear, true);
       xobj.send();
 
    }
    
    // this is all the code for the prev month text
    function prevMonth(ID){
        //decrement the visible month by 1
    	visibleMonth--;
    	//if visible month is less than zero reset it to 11 to represent December and decrement the visible year by 1
    	if(visibleMonth < 0){
    	    visibleMonth = 11;
    	    visibleYear--;
    	}
    	
    	
    	
    	//variblaes to display calendar
        var htmlContent ="";
        var FebNumberOfDays ="";
        var counter = 1;
 
 
        var dateNow = new Date();
        var month = visibleMonth;

        var nextMonth = month+1; //+1; //Used to match up the current month with the correct start date.
        var prevMonth = month -1;
        var day = dateNow.getDate();
        var year = visibleYear;
        
        
    	
 
        //Determining if February (28,or 29)  
        if (month == 1 || month == 2){
           if ( (year%100!=0) && (year%4==0) || (year%400==0)){
             FebNumberOfDays = 29;
           }else{
             FebNumberOfDays = 28;
           }
        }
 
 
        // names of months and week days.
        var monthNames = ["January","February","March","April","May","June","July","August","September","October","November", "December"];
        var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thrusday","Friday", "Saturday"];
        var dayPerMonth = ["31", ""+FebNumberOfDays+"","31","30","31","30","31","31","30","31","30","31"];
 
 
        // days in previous month and next one , and day of week.
        if(nextMonth == 11){
           visibleYear = year +1;
           var nextDate = new Date(visibleYear, month, 1,0,0,0,0);
        }
        else{var nextDate = new Date(visibleYear, month, 1,0,0,0,0);}
        
        var weekdays = nextDate.getDay();
        var weekdays2 = weekdays;
        var numOfDays = dayPerMonth[month];
        var tableCells = 0;
     
 
 
 
       if(month == 0){
            var prevMonthDays = dayPerMonth[11];
        }
        else{ var prevMonthDays = dayPerMonth[month - 1];}
 
        prevMonthDays = prevMonthDays - weekdays + 1;
 
        // this leave a white space for days of previous month.
        while (weekdays>0){
           htmlContent += "<td class='largeMonthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
        // used in next loop.
            weekdays--;
            prevMonthDays++;
            tableCells++;
        }
 
        var xobj = new XMLHttpRequest();
        xobj.onreadystatechange = function(){
           if (xobj.readyState == 4 && xobj.status == "200"){
              var holder = JSON.parse(this.responseText);      
 
            var i = 0;
            
            if (holder == null){
               holder = 0;
            }
            
        // loop to build the calander body.
        while (counter <= numOfDays){
 
            // When to start new line.
           if (weekdays2 > 6){
               weekdays2 = 0;
               htmlContent += "</tr><tr>";
           }

           // if counter is current day.
           // highlight current day using the CSS defined in header.
           if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter == day){
               htmlContent +="<td class='largeDayNow'>"+counter+"</td>";
           }else if(counter == holder[i]){
                   if (holder[i+1] == 'no'){
                       htmlContent +="<td class='largeDayRequested'>"+counter+"</td>";
                   }
                   else{
                       htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
                   }
                   i = i+2;
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }else{
               htmlContent +="<td class='largeMonthNow'>"+counter+"</td>";
           }
    
           weekdays2++;
           counter++;
           tableCells++;
        }
 
        var nextMonthDays = 1;
 
        //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
        while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
            htmlContent += "<td class='largeMonthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
            nextMonthDays++;
            tableCells++;
        }
 
 
 
        // building the calendar html body.
        var calendarBody = "<table class='largeCalendar' style='padding-bottom: 15px;'>";
        calendarBody += "<tr>";
        calendarBody += htmlContent;
        calendarBody += "</tr></table>";
        // set the content of div .
        document.getElementById("cal-frame").innerHTML=calendarBody;
        document.getElementById("label").innerHTML=monthNames[month]+" "+year;
 
          }
       };
       xobj.open('GET', 'calendar/retrieve_reservations.php?x='+ID+'& y='+monthNames[visibleMonth]+'& z='+visibleYear, true);
       xobj.send();
    }
    
    </script>
    
    <script>    
    function loadTables(){
        var lessonID = document.getElementById("lesson_select").value;
        document.getElementById("prev").setAttribute("onclick", "javascript: prevMonth("+lessonID+")");
        document.getElementById("next").setAttribute("onclick", "javascript: nextMonth("+lessonID+")");
        document.getElementById("lessonID").setAttribute("value", lessonID);        
        displayCalendar(lessonID);
    }
    </script>
    
    <script>
    function submitForm(ID){
        var table = document.getElementById("requestedDates");
        var rows = table.rows;
        document.getElementById("test").innerHTML = "the number of rows is "+rows.length;
        for (i=rows.length; i > 1; i--){
            if (document.getElementById("checkbox"+i).checked){
                //do ajax call to submit the date and change this request to verified
                var month = document.getElementById("month"+i).value;
                var day = document.getElementById("day"+i).value;
                var year = document.getElementById("year"+i).value;
                var xobj = new XMLHttpRequest();
                xobj.onreadystatechange = function(){
                    if (xobj.readyState == 4 && xobj.status == "200"){
                        document.getElementById("test").innerHTML = this.responseText;
                    }
                };
                xobj.open('POST', 'calendar/verify_date.php?x='+month+'& y='+day+'& z='+year+'& a='+ID, true);
                xobj.send();
            }
        }
        loadTables();
    }
    
    function deleteFromForm(ID){
        document.getElementById("test").innerHTML = 'successfully deleted from this lesson ID '+ID;
        var table = document.getElementById("requestedDates");
        var rows = table.rows;
        for (i=rows.length; i > 1; i--){
            if (document.getElementById("checkbox"+i).checked){
                //do ajax call to submit the date and change this request to verified
                var month = document.getElementById("month"+i).value;
                var day = document.getElementById("day"+i).value;
                var year = document.getElementById("year"+i).value;
                var xobj = new XMLHttpRequest();
                xobj.onreadystatechange = function(){
                    if (xobj.readyState == 4 && xobj.status == "200"){
                        document.getElementById("test").innerHTML = this.responseText;
                    }
                };
                xobj.open('POST', 'calendar/delete_date.php?x='+month+'& y='+day+'& z='+year+'& a='+ID, true);
                xobj.send();
            }
        }
        loadTables();
    }
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
    <script>
    function sortTable(n){
        var table = document.getElementById("lessons");
        var switching = true;
        var dir = "asc";
        var switchCount = 0;
        var i;
        while (switching){
            switching = false;
            var rows = table.getElementsByTagName("TR");
            
            for (i =1; i < (rows.length - 1); i++){
                var shouldSwitch = false;
                 var x = rows[i].getElementsByTagName("TD")[n];
                 var y = rows[i+1].getElementsByTagName("TD")[n];
                 
                 if (dir == "asc"){
                     if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                         shouldSwitch = true;
                         break;
                     }
                 }
                 else if (dir == "desc"){
                     if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()){
                         shouldSwitch = true;
                         break;
                     }
                 }
             }
            if (shouldSwitch){
                rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
                switching = true;
                switchCount++;
            }
            else {
                if (switchCount == 0 && dir  == "asc"){
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
    
    </script>
    
</head>
<body onload="displayCalendar()">
<div id="holder">
<div class="nav">
<div class="links">
<ul class="nav">
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
    echo "<li class='object'><a class='link' id='active' href='admin_page.php'>Admin</a></li>";
}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:login_page.php");
    exit();
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

<div class="tab">
	<button class="tablinks" onclick="openadmin(event, 'verify')">Verify Lessons</button>
        <button class="tablinks" onclick="openadmin(event, 'materials')">Add New Materials</button>
        <button class="tablinks" onclick="openadmin(event, 'lessonMaterials')">Pair Lessons and Materials</button>
        <button class="tablinks" onclick="openadmin(event, 'topic')">Pair Lessons to Topics</button>
	<button class="tablinks" onclick="openadmin(event, 'reserve')">Verify Reservation of Materials</button>
	<button class="tablinks" onclick="openadmin(event, 'assign')">Assign Admin Permissions</button>
	<!--<button class="tablinks" onclick="openadmin(event, 'email')">Email Blast to Users</button>-->
</div>






<!-- This section is for Verify, Deleting or Modifying Lessons in the database -->



<div id="verify" class="tabcontent">
<?php



//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    //create sql statment to select every record in the uploaded_data table 
    $sql = "SELECT uploaded_data.ID, uploaded_data.Name, uploaded_data.Primary_Subject, uploaded_data.Secondary_Subject, grade_range.Grade_Range, uploaded_data.Language, GROUP_CONCAT(standards.Standard),uploaded_data.PDF_link, uploaded_data.Grade_ID, GROUP_CONCAT(standards.ID), uploaded_data.Recommended_Theme, uploaded_data.Recommended_Topic, uploaded_data.Person, uploaded_data.Email
            From uploaded_data
            LEFT JOIN standard_upload_junction on uploaded_data.ID=standard_upload_junction.Name_ID 
            LEFT JOIN standards on standard_upload_junction.Standard_ID=standards.ID 
            LEFT JOIN grade_range on uploaded_data.Grade_ID=grade_range.ID
            GROUP BY uploaded_data.ID";
    
    //connect to the database
    include 'connect.php';

    //run the sql statement and save it in result
    $result = $con->query($sql);
    
    
    //iterate through result and output each result into a table for the user to view   
    if ($result->num_rows > 0){
        //start form to be able to do multiple copies from uploaded_data to live_data
        echo "<form action='action.php' method='post'><section class=''><div class='lesson_container'><table id='lessons' class='lessons sortable'>"; 
        
        echo "<thead><tr><th>Checkbox<div>Checkbox</div></th>";
        echo "<th>Name<div onclick='sortTable(1)'>Name</div></th>";
        echo "<th>Language<div>Language</div></th>";
        echo "<th>Primary Subject<div>Primary Subject</div></th>";
        echo "<th>Secondary Subject<div>Secondary Subject</div></th>";
        echo "<th>Grade(s)<div>Grade(s)</div></th>";
        echo "<th>Standard<div>Standard</div></th>";
        echo "<th>View<div>View</div></th>";
        echo "<th>Uploaders Name<div>Uploaders Name</div></th>";
        echo "<th>Uploaders Email<div>Uploaders Email</div></th></tr></thead><tbody>";
        
        $x = 0;
        while($row = $result->fetch_assoc()){
   	   echo "<tr class='results'><td><input type='checkbox' name='".$x. "'/>";
   	   echo "<input type='hidden' name='Theme".$x."' value='".$row["Recommended_Theme"]."'/>";
   	   echo "<input type='hidden' name='Topic".$x."' value='".$row["Recommended_Topic"]."'/></td>";
   	   echo "<td><input type='hidden' name='Name" .$x."' value='" .$row["Name"]. "'/>" .$row["Name"]. "</td>";
   	   echo "<td><input type='hidden' name='Language" .$x."' value='" .$row["Language"]. "'/>".$row["Language"]. "</td>";
   	   echo "<td><input type='hidden' name='Primary_Subject" .$x."' value='" .$row["Primary_Subject"]. "'/>".$row["Primary_Subject"]. "</td>";
   	   echo "<td><input type='hidden' name='Secondary_Subject" .$x."' value='" .$row["Secondary_Subject"]. "'/>".$row["Secondary_Subject"]. "</td>";
   	   echo "<td><input type='hidden' name='Grade" .$x."' value='" .$row["Grade_Range"]. "'/>" .$row["Grade_Range"]. "</td>";
   	   echo "<td><input type='hidden' name='Standard" .$x."' value='" .$row["GROUP_CONCAT(standards.Standard)"]. "'/>" .$row["GROUP_CONCAT(standards.Standard)"]. "</td>";
   	   echo "<td><input type='hidden' name='Link" .$x."' value='" .$row["PDF_link"]. "'/><a href=PDFs/".$row["PDF_link"]. " target='_blank'>" .$row["PDF_link"]. "</a></td>";
   	   echo "<td><input type='hidden' name='Person" .$x."' value='".$row["Person"]."'/>".$row["Person"]."</td>";
   	   echo "<td>".$row["Email"]."</td>";
   	   echo "<input type='hidden' name='Standards_ID" .$x. "' value='".$row["GROUP_CONCAT(standards.ID)"]."'/></tr>";
   	   $x = $x + 1;
        }
        echo "</tbody></table></div></section><br><div id='buttons'>";
        echo "<button id='submit' type='submit' value='' name='verify'>Verify</button>";
        echo "<button id='submit' type='submit' value='' name='delete'>Delete</button>";
        echo "<button id='submit' type='submit' value='' name='modify'>Modify</button>";
        echo "</div></form>";
        
    }else {
    //let the user know if there is no data in uploaded data
    echo "There are no new lesson plans";
    }
}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:/login_page.php");
    exit();
}

?>
</div>



<!-- This section is for Verify Reservations of Materials in the database -->



<div id="reserve" class="tabcontent">

<div class="top">


<?php
include 'connect.php';

$sql = "SELECT DISTINCT material_reservation.Lesson_ID, live_data.Name
        FROM material_reservation
        LEFT JOIN live_data on live_data.ID = material_reservation.Lesson_ID
        WHERE 1";

$result = $con->query($sql);


echo "<p>Select what lesson you would like to load the calendar for</p><select id='lesson_select' onchange='loadTables()'><option selected='true'>Select a Lesson</option>";
while($row = $result->fetch_assoc()){
    echo "<option value='".$row['Lesson_ID']."'>" .$row['Name']. "</option>";
}
echo "</select>";



echo "</div>";

echo "<div class='leftContainer'>";
echo "<p>This table holds the verified dates for the selected lesson.</p>";
echo "<section class='verified'><div class='dates_container'><table class='verified'>";
echo "<thead><tr><th>Name<div>Name</div></th>";
echo "<th>Date<div>Date</div></th>";
echo "<th>Address<div>Address</div></th>";
echo "<th>Email<div>Email</div></th></tr><thead><tbody id='verified'>";
//the table body will go here
echo "</tbody></table></div></section><br>";
//this closes the leftContainer
echo "</div>";

echo "<div class='rightContainer'>";
echo "<p>This table holds the dates people have requested materials for.<br>To Verify dates check the checkbox next to the date and click the verify button below the table.<br>To delete a date check the checkbox next to the date and click the delete button below the table.</p>";
echo "<form method='post' action='calendar/verify_date.php'><section class='requested'><div class='dates_container'><table id='requestedDates' class='requested'>";
echo "<thead><tr><th>Checkbox<div>Checkbox</div></th>";
echo "<th>Name<div>Name</div></th>";
echo "<th>Date<div>Date</div></th>";
echo "<th>Address<div>Address</div></th>";
echo "<th>Email<div>Email</div></th></tr></thead><tbody id='requested'>";
//the table body will go here

echo "</tbody></table></div></section><br>";
echo "<input type='hidden' id='lessonID' value='' name='lesson'>";
echo "<button id='verifyDate' name='verify' >Verify</button> <button id='deleteDate' name='delete'>Delete</button></form>";

//closes the class rightContainer
echo "</div>";

?>

<div class="center">
 <p>Dates highlighted in red have been requested and dates highlighted in blue have been verified.</p>
 <div id='calHolder'>
	<div class='calendar' id='largeCal'>
		
		<div class='large_header'>
    			<span class='left button' id='prev' onclick='prevMonth()'> &lang; </span>
    			<span class='left hook'></span>
    			<span class='month-year' id='label'></span>
    			<span class='right hook'></span>
    			<span class='right button' id='next' onclick='nextMonth()'> &rang; </span>
		</div>

		<table id='days' class='largeCalendar'>
  			<tbody class='cal'>
  				<tr class='cal'>
    					<td>sun</td>
    					<td>mon</td>
    					<td>tue</td>
    					<td>wed</td>
    					<td>thu</td>
    					<td>fri</td>
   				 	<td>sat</td>
  				</tr>
  			</tbody>
		</table>

		<div id='cal-frame'>
  			
		</div>
	</div></div>
  </div>



</div>



<!-- This is the section for assigning a User Admin Permissions -->



<div id="assign" class="tabcontent">

<form>
Username: <input id="username" type="text" name="username" onkeyup="search()" autocomplete="off" >
</form>
<button>Search</button>
<form  id="users" method="post" action="action/add_admin.php">
<table>
<td><input type="checkbox" id="checkbox" name="check"><input id="person" name="user" type="hidden"></td>
<td><div id="results"></div></td></table>
<button>Submit</button>
</form>


</div>



<!-- This is the section for adding New Materials -->



<div id="materials" class="tabcontent">
<form action="action/addMaterials.php" method="post">
<section class=""><div class="lesson_container"><table class="lessons"><tr><th>Material<div>Material</div></th><th>Availability<div>Availability</div></th></tr>
<tbody>
<tr><td><input type="text" name="material1" autocomplete="off" /></td><td><select name="provider1"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material2" autocomplete="off" /></td><td><select name="provider2"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material3" autocomplete="off" /></td><td><select name="provider3"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material4" autocomplete="off" /></td><td><select name="provider4"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material5" autocomplete="off" /></td><td><select name="provider5"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material6" autocomplete="off" /></td><td><select name="provider6"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material7" autocomplete="off" /></td><td><select name="provider7"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material8" autocomplete="off" /></td><td><select name="provider8"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
<tr><td><input type="text" name="material9" autocomplete="off" /></td><td><select name="provider9"><option value="needed">Teacher Provides</option><option value="available">We Provide</option></select></td></tr>
</tbody>
</table></div></section>
<br><button>Add Materials</button>
</form>

</div>



<!--This is the section for pairing Materials with Lessons -->



<div id="lessonMaterials" class="tabcontent">
<?php
include 'connect.php';

$sql = "SELECT ID,Name
        FROM materials
        WHERE 1";
        
$sql2 = "SELECT ID, Name
         FROM available_materials
         WHERE 1";
         
//run the sql statement and save it in result
$result = $con->query($sql);
$result2 = $con->query($sql2);

//start the form for pairing materials with lessons. The lesson will be selected here and then materials chosen from the two tables below this.
echo "<form method='post' action='action/pairMaterials.php' autocomplete='off' >";
echo "<div>Lesson to Pair with Materials:<input id='search' type='text' name='lessonName' onkeyup='searchLesson(this.value)' value='' autocomplete='off' /><ul id='livesearch' class='searchResults'></ul></div>";   
//iterate through result and output each result into a table for the user to view   
$x = 0;
echo "<div id='leftSide'><p>Needed Materials</p>";
echo "<section class='' ><div class='container' ><table class='materials' ><thead><tr class='header' ><th>Checkbox<div>Checkbox</div></th><th>Material Name<div>Material Name</div></th></tr></thead><tbody>";
while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td><input type='checkbox' name='".$x. "'/></td><td>" .$row['Name']. "<input type='hidden' name='material" .$x. "' value='" .$row['Name']. "'/><input type='hidden' name='table" .$x. "' value='material_name_junction'/><input type='hidden' name='fromTable" .$x. "' value='materials'/></td>";
    echo "</tr>";
    $x = $x + 1;
}
echo "</tbody></table></div></section></div>";
echo "<div id='rightSide'><p>Available Materials</p>";
echo "<section class='' ><div class='container' ><table class='materials' ><thead><tr class='header'><th>Checkbox<div>Checkbox</div></th><th>Material Name<div>Material Name</div></th></tr></thead><tbody>";
while($row2 = $result2->fetch_assoc()){
    echo "<tr>";
    echo "<td><input type='checkbox' name='" .$x. "'/></td><td>" .$row2['Name']. "<input type='hidden' name='material" .$x. "' value='" .$row2['Name']. "'/><input type='hidden' name='table" .$x. "' value='available_name_junction'/><input type='hidden' name='fromTable" .$x. "' value='available_materials'/></td>";
    echo "</tr>";
    $x = $x + 1;
}    
echo "</tbody></table></div></section></div><br>";
echo "<button>Submit</button></form>";

?>
</div>



<!-- This section is for pairing Lessons to Topics -->



<div id="topic" class="tabcontent">
<?php
include 'connect.php';

$sql = "SELECT ID,Name, Primary_Subject, Secondary_Subject, PDF_link
        FROM live_data
        WHERE 1";
        

$sql2 = "SELECT Name
         FROM theme
         WHERE 1";

//run the sql statement and save it in result
$result = $con->query($sql);

    
//iterate through result and output each result into a table for the user to view   
if ($result->num_rows > 0){
    //start form to be able to do multiple copies from uploaded_data to live_data
    echo "<form action='action/pairTopic.php' method='post'><section class=''><div class='lesson_container'><table class='lessons'>";     
    echo "<thead><tr><th>Topic<div>Topic</div></th>";
    echo "<th>Name<div>Name</div></th>";
    echo "<th>Primary Subject<div>Primary Subject</div></th>";
    echo "<th>Secondary Subject<div>Secondary Subject</div></th>";
    echo "<th>View<div>View</div></th></tr></thead><tbody>";
    
    $x = 0;
    while($row = $result->fetch_assoc()){ 
        $result2 = $con->query($sql2);       
   	echo "<tr class='results'><td><div><input type='checkbox' name='" .$x. "'/> Theme: <select name='theme".$x."' onchange='topicDropDown(this.value,".$x.")'><option selected='true'>Please Select a Theme</option>";
   	while($row2 = $result2->fetch_assoc()){
            echo "<option value='".$row2['Name']."'>".$row2['Name']."</option>";
        }
   	echo "</select> Topic: <select id='topicDrop".$x."' name='topic".$x."'></select></div></td>";
   	echo "<td>" .$row["Name"]. "<input type='hidden' value='".$row["ID"]."' name='lessonID" .$x. "'></input><input type='hidden' value='".$row["Name"]."' name='lessonName" .$x. "'></input></td>";
   	echo "<td>".$row["Primary_Subject"]. "</td>";
   	echo "<td>".$row["Secondary_Subject"]. "</td>";
   	echo "<td><a href=PDFs/".$row["PDF_link"]. " target='_blank'>" .$row["Name"]. "</a></td>";
   	$x = $x + 1;
    }
    echo "</tbody></table></div></section><br><div id='buttons'>";
    echo "</div><button>Submit</button></form>";
    echo "<div id='test'></div>";
}
?>
</div>
</div>
</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>