<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed - Resources</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resources.css">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="calendar/calendar.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    
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
                   while (day == holder[i]){
                       i = i+2;
                   }
               }else if(counter == holder[i]){
                   htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
                   while (counter == holder[i]){
                       i = i+2;
                   }
               }else if(counter >= day + 14){
                   htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";  
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
               while (day == holder[i]){
                       i = i+2;
                   }
           }else if(counter == holder[i]){
               htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
               while (counter == holder[i]){
                       i = i+2;
                   }
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";
           }else{
               htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";
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
           visibleYear = year;
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
               while (day == holder[i]){
                   i = i+2;
               }
           }else if(counter == holder[i]){
                   htmlContent +="<td class='largeDayVerified'>"+counter+"</td>";
                   while (counter == holder[i]){
                       i = i+2;
                   }
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='largeMonthNow' onclick='reserveDate("+counter+")'>"+counter+"</td>";
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
    
    function collectionType(){
        if(document.getElementById("multiple").checked == true){
            document.getElementById("reserve_form").setAttribute("action", "calendar/reserve_date_multiple.php");
            document.getElementById("dates").classList.remove("multiple");
            document.getElementById("date").classList.add("multiple");
            document.getElementById("day").setAttribute("value"," ");
            document.getElementById("month").setAttribute("value"," ");
            document.getElementById("year").setAttribute("value"," ");
            document.getElementById("selected").innerHTML = "";
        }
        else{
            document.getElementById("reserve_form").setAttribute("action", "calendar/reserve_date.php");
            document.getElementById("dates").classList.add("multiple");
            document.getElementById("date").classList.remove("multiple");
            while(document.getElementById("reservation_list").rows.length > 1){
                document.getElementById("reservation_list").deleteRow(-1);
            }
        }
    }

    function reserveDate(day){
        var monthYear = document.getElementById("label").innerHTML;
        var holder = monthYear.split(" ");
        if(document.getElementById("multiple").checked == false){
            document.getElementById("month").setAttribute("value", holder[0]);
            document.getElementById("year").setAttribute("value", holder[1]);
            document.getElementById("day").setAttribute("value", day);
            document.getElementById("selected").innerHTML = "<input type='hidden' name='day' value='"+day+"'><input type='hidden' name='month' value='"+holder[0]+"'><input type='hidden' name='year' value='"+holder[1]+"'>"+holder[0]+" "+ day +", "+ holder[1];
        }
        else{
        //do stuff to add to table view
        var table = document.getElementById("reservation_list");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var rowNum = document.getElementById("reservation_list").rows.length - 1;
        cell1.innerHTML = "<input id='month"+rowNum+"' type='hidden' name='month"+rowNum+"' value='"+holder[0]+"'>"+holder[0]+" ";
        cell2.innerHTML = "<input id='day"+rowNum+"' type='hidden' name='day"+rowNum+"' value='"+day+"'>"+day+",";
        cell3.innerHTML = "<input id='year"+rowNum+"' type='hidden' name='year"+rowNum+"' value='"+holder[1]+"'>"+holder[1];
        cell4.innerHTML = "<div id='"+rowNum+"' class='error' onclick='removeDate("+rowNum+")'>X</div>";
        }
    }
    </script>
    
    <script>
    function removeDate(rowNum){
        var countOfRows = document.getElementById("reservation_list").rows.length;
        var nextRow = 0;
        document.getElementById("reservation_list").deleteRow(rowNum);
        while(nextRow <= countOfRows){
            if(nextRow >= rowNum){
                document.getElementById("day"+(nextRow+1)).setAttribute("name", 'day'+nextRow);
                document.getElementById("day"+(nextRow+1)).setAttribute("id", 'day'+nextRow)
                document.getElementById("month"+(nextRow+1)).setAttribute("name", 'month'+nextRow);
                document.getElementById("month"+(nextRow+1)).setAttribute("id", 'month'+nextRow);
                document.getElementById("year"+(nextRow+1)).setAttribute("name", 'year'+nextRow);
                document.getElementById("year"+(nextRow+1)).setAttribute("id", 'year'+nextRow);
                document.getElementById(nextRow+1).setAttribute("onclick", 'removeDate('+nextRow+')');
                document.getElementById(nextRow+1).setAttribute("id", nextRow);
                nextRow = nextRow + 1;
            }
            else{
                nextRow = nextRow + 1;
            }
        }
    }
    </script>

</head>
<body onload="displayCalendar()">
<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" href="wheel.php">Home</a></li>
    <!--<li class="object"><a class="link" href="search_start.php">Search</a></li>-->
    <li class="object"><a class="link" href="upload.php">Upload</a></li>
    <li class="object"><a id="active" class="link" href="resources.php">Resources</a></li>
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

<div id="holder">
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $check = test_input($_GET['response']);
    if($check == 'success'){
        echo "<p id='response'>Thank You. Your resource request has been successfully submitted, you will recieve an email stating if the request was accepted or denied.</p>";
    }
    
}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<p id='instructions'>Select what Resources you would like to reserve</p>
  <select id='lesson_select' onchange='loadTables()'><option selected='true'>Select a Lesson</option>
    <!--<option value="">Kid Wind & Solar</option>-->
    <!--<option value="">SnapCircuits</option>-->
    <option value="92">Build a Buoy</option>
    <!--<option value="">TREE</option>-->
    <!--<option value="">Water Quality</option>-->
    <!--<option value="">Its for the Birds</option>-->
    <!--<option value="">Sea Level Rise</option>-->
    <!--<option value="">Sum of the Parts</option>-->
    <!--<option value="">Aquabotz</option>-->
    <!--<option value="">Up Up & Away Kites</option>-->
  </select>

<br>
<div class="left">
<p id="formDesc">Please fill out all of the information below to reserve the available materials for <br><span id="date2"></span> </p>
<form id="reserve_form" method="post" action="calendar/reserve_date.php">

<fieldset>
<div id="name"><span class="error">* </span>Name: <input id="nameInput" type="text" name="Name" autocomplete="off"/></div>
<div id="email"><span class="error">* </span>Email: <input id="emailInput" type="email" name="email" autocomplete="off"/></div><br><br>
<div id="address"><span class="error">* </span>Address: <input id="addressInput" type="text" name="address" autocomplete="off"/></div><br><br>
<div id="city"><span class="error">* </span>City: <input id="cityInput" type ="text" name="city" autocomplete="off"/></div>
<div id="state"><span class="error">* </span>State: <select name="state"><option selected="true"></option><option>AL</option><option>AK</option><option>AZ</option><option>AR</option><option>CA</option><option>CO</option><option>CT</option><option>DE</option><option>FL</option><option>GA</option><option>HI</option><option>ID</option><option>IL</option><option>IN</option><option>IA</option><option>IA</option><option>KS</option><option>KY</option><option>LA</option><option>ME</option><option>MD</option><option>MA</option><option>MI</option><option>MN</option><option>MS</option><option>MO</option><option>MT</option><option>NE</option><option>NV</option><option>NH</option><option>NJ</option><option>NM</option><option>NY</option><option>NC</option><option>ND</option><option>OH</option><option>OK</option><option>OR</option><option>PA</option><option>RI</option><option>SC</option><option>SD</option><option>TN</option><option>TX</option><option>UT</option><option>VT</option><option>VA</option><option>WA</option><option>WV</option><option>WI</option><option>WY</option></select></div>
<div id="zip"><span class="error">* </span>Zip: <input id="zipInput" type="text" name="zip" autocomplete="off"/></div>
<input type="hidden" id="day" value="" name="day"/>
<input type="hidden" id="month" value="" name="month"/>
<input type="hidden" id="year" value="" name="year"/>
<input type="hidden" id="lessonID" value="" name="lessonID"/>
</fieldset><br>
<p id="reqText"><span class="error">* </span>Indicates a required field.</p>

<div id="date" class="single">
<p>Date you have selected to reserve materials for:</p>
<p id="selected"></p>
</div>

<div id="dates" class="multiple">
<p>List of Dates for multiple day selection</p>
<table id="reservation_list" class="reservation_days"><tbody class="reservation_days">
<tr><th>Month</th><th>Day,</th><th>Year</th><th></th></tr>
</tbody></table>
</div>

<button>Reserve Date</button>
</form>

</div>

<div class="right">
<p>Please click on a date to reserve resources for that date. If you would like to reserve resources for multiple days<br> please check the checkbox and then select the dates you would like. <br><br>Multiple Days<input id="multiple" type="checkbox" onchange="collectionType()"/></p>
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
	<p id="explanation">Resources may be reserved at least two weeks after todays date.</p>
</div>

</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>