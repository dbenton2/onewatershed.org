<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWatershed</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="calendar/calendar.css">
    <link rel="stylesheet" type="text/css" href="lesson.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript">
        function changeView(source, ID) { 
            var table = document.getElementById("topic");
            var row = document.getElementsByClassName("selected");
            for (var i = 0; i < row.length; i++){
                row[i].setAttribute("class", "normal");
            }
            document.getElementById(source).setAttribute("class", "selected");
            loadMaterials(ID);
            document.getElementById("iframe").setAttribute("src", "http://docs.google.com/gview?url=http://onewatershed.org/PDFs/" + source + "&embedded=true");
            document.getElementById("iframe").setAttribute("onload", "loadMaterials("+ID+")"); 
        }
    </script>
    <script type="text/javascript">
        function loadMaterials(ID){        
        
            //use ajax to create list of needed materials based on what lesson is showing
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    //break the list into bulleted points instead of comma seperated
                    var needed = this.responseText;
                    var finalneeded = needed.split(",");
                    //only perform this code if the array has content
                    if(finalneeded.length > 1){
                        var htmlContent="<ul>";
                        for(i=0; i < finalneeded.length; i++){
                            htmlContent+="<li>"+finalneeded[i]+"</li>";
                        }
                        htmlContent+="</ul>";
                        document.getElementById("needed").innerHTML = htmlContent;
                        //make this section visible only if there is content in it
                        document.getElementById("neededdiv").style.display = "block";
                    }
                }
            };
            xmlhttp.open("GET", "load/loadMaterials.php?x=" +ID, true);
            xmlhttp.send();
            
            //use ajax to create list of avalaible materials based on what lesson is showing
            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    //break the list into bulleted points instead of comma seperated
                    var available = this.responseText;
                    var finalavailable = available.split(",");
                    //only perform this code if the array has content
                    if(finalavailable.length > 1){
                        var htmlContent ="<ul>";
                        for(i=0; i < finalavailable.length; i++){
                            htmlContent+="<li>"+finalavailable[i]+"</li>";
                        }
                        htmlContent +="</ul>";
                        document.getElementById("available").innerHTML = htmlContent;
                        //make this section visible only if there is content in it
                        document.getElementById("availablediv").style.display = "block";
                        document.getElementById("calHolder").style.display = "block";
                    }                
                }
            };
            xmlhttp2.open("GET", "load/loadAvailableMaterials.php?x=" +ID, true);
            xmlhttp2.send();           
            
            //use ajax to create list of standards that are met based on what lesson is showing
            var xmlhttp3 = new XMLHttpRequest();
            xmlhttp3.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    //break the comma seperated list into a bulleted list
                    var Standards = this.responseText;
                    var finalStandards = Standards.split(",");
                    var htmlContent ="<ul>";
                        for(i=0; i < finalStandards.length; i++){
                            htmlContent +="<li>"+finalStandards[i]+"</li>";                          
                        }
                    htmlContent +="</ul>";
                    document.getElementById("alignment").innerHTML = htmlContent;
                }
            };
            xmlhttp3.open("GET", "load/loadStandards.php?x=" +ID, true);
            xmlhttp3.send();
            //there should always be standards so this is always displayed after being loaded
            document.getElementById("standards").style.display = "block";
            document.getElementById('lessonID').value = ID;
            displayCalendar(ID);
            document.getElementById("prev").setAttribute("onclick", "javascript: prevMonth("+ID+")");
            document.getElementById("next").setAttribute("onclick", "javascript: nextMonth("+ID+")");
        }
       
        
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
           htmlContent += "<td class='monthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
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
                   htmlContent +="<td class='dayNow'>"+counter+"</td>";
                   if (day == holder[i]){
                       i = i+2;
                   }
               }else if(counter == holder[i]){
                   htmlContent +="<td class='dayReserved'>"+counter+"</td>";
                   i = i+2;
               }else if(counter >= day + 14){
                   htmlContent +="<td class='monthNow' onclick='reserveDay(" + month+ ", "+counter+", " + year + ")'>"+counter+"</td>";  
               }else{ 
                   htmlContent +="<td class='monthNow'>"+counter+"</td>";
               }
    
               weekdays2++;
               counter++;
               tableCells++;
            }
 
            var nextMonthDays = 1;

            //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
            while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
                htmlContent += "<td class='monthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
                nextMonthDays++;
                tableCells++;
            }
 
            // building the calendar html body.
            var calendarBody = "<table class='curr' style='padding-bottom: 15px;'>";
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
           htmlContent += "<td class='monthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
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
               htmlContent +="<td class='dayNow'>"+counter+"</td>";
               if (day == holder[i]){
                   i = i+2;
               }
           }else if (counter == holder[i]){
                   htmlContent +="<td class='dayReserved'>"+counter+"</td>";
                   i = i+2;
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='monthNow' onclick='reserveDay(" + visibleMonth + ", " + counter + ", " + visibleYear + ")'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='monthNow' onclick='reserveDay(" + visibleMonth + ", " + counter + ", " + visibleYear + ")'>"+counter+"</td>";
           }else{
               htmlContent +="<td class='monthNow'>"+counter+"</td>";
           }
    
           weekdays2++;
           counter++;
           tableCells++;
        }
 
        var nextMonthDays = 1;
 
        //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
        while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
            htmlContent += "<td class='monthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
            nextMonthDays++;
            tableCells++;
        }
 
 
 
        // building the calendar html body.
        var calendarBody = "<table class='curr' style='padding-bottom: 15px;'>";
        calendarBody += "<tbody><tr>";
        calendarBody += htmlContent;
        calendarBody += "</tr></tbody></table>";
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
        nextDate = new Date(visibleYear, month, 1,0,0,0,0);        
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
           htmlContent += "<td class='monthPre' onclick='prevMonth("+ID+")'>"+prevMonthDays+"</td>";
 
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
               htmlContent +="<td class='dayNow'>"+counter+"</td>";
               if (day == holder[i]){
                   i = i+2;
               }
           }else if(counter == holder[i]){
                   htmlContent +="<td class='dayReserved'>"+counter+"</td>";
                   i = i+2;
           }else if (visibleYear == dateNow.getFullYear() && month == dateNow.getMonth() && counter >= day +14){
               htmlContent +="<td class='monthNow' onclick='reserveDay(" + visibleMonth + ", " + counter + ", " + visibleYear + ")'>"+counter+"</td>";
           }else if (visibleYear > dateNow.getFullYear() || month > dateNow.getMonth()){
               htmlContent +="<td class='monthNow' onclick='reserveDay(" + visibleMonth + ", " + counter + ", " + visibleYear + ")'>"+counter+"</td>";
           }else{
               htmlContent +="<td class='monthNow'>"+counter+"</td>";
           }
    
           weekdays2++;
           counter++;
           tableCells++;
        }
 
        var nextMonthDays = 1;
 
        //finish off the calendar to be square with days of the next month and set their onclick to advance the month 
        while ((tableCells < 35 && tableCells != 28) || (tableCells > 35 && tableCells < 42)){
            htmlContent += "<td class='monthNex' onclick='nextMonth("+ID+")'>"+nextMonthDays+"</td>";
            nextMonthDays++;
            tableCells++;
        }
 
 
 
        // building the calendar html body.
        var calendarBody = "<table class='curr' style='padding-bottom: 15px;'>";
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
    
    function reserveDay(month, day, year){
        var monthNames = ["January","February","March","April","May","June","July","August","September","October","November", "December"];
        var displayMonth = monthNames[month];
        var displayDay = day;
        var displayYear = year;
        document.getElementById('date').innerHTML = displayMonth+" "+displayDay+", "+displayYear;
        document.getElementById('date2').innerHTML = displayMonth+" "+displayDay+", "+displayYear;
        document.getElementById('day').value = displayDay;
        document.getElementById('month').value = displayMonth;
        document.getElementById('year').value = displayYear;
        document.getElementById('calendarModal').style.display = "block";
    }
    
    function closeModal(){
        var modal = document.getElementById("calendarModal");
        modal.style.display = "none";
    }
    </script>
    
    <script>
       window.onresize = function(event) {
    if(event.currentTarget.outerWidth >= 800){
        console.info("showing");
        $("#article").show();
    }else{
        console.info("hiding");
        $("#article").hide();
    }
    
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
<body >

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
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
    echo "<li class='object'><a class='link' href='admin_page.php'>Admin</a></li>";
}
elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == ''){
    echo "<li class='object'><a class='link' href='member_page.php'>". $_SESSION['username']."</a><li>";
}

//create variables
include 'connect.php';

$topicName = test_input($_GET['topic']);
$topic = urlencode($topicName);

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

<div id="test"></div>

<div id="content">

<div id="calendarModal" class="modal">
<div id="calendarModal" class="modal-content">
<div id="calendarModal" class="modal_header">
<span class="close" onclick="closeModal()">&times;</span>
<h1>Reserve Materials for <span id="date"></span></h1>
</div>
<div class="modal_body">
<p>Please fill out all of the information below to reserve the available materials for <span id="date2"></span>. </p>
<form method="post" action="calendar/reserve_date.php"><br><br>
<fieldset>
<div id="name">Name: <input id="nameInput" type="text" name="Name" autocomplete="off"/></div>
<div id="email">Email: <input id="emailInput" type="email" name="email" autocomplete="off"/></div><br><br>
<div id="address">Address: <input id="addressInput" type="text" name="address" autocomplete="off"/></div><br><br>
<div id="city">City: <input id="cityInput" type ="text" name="city" autocomplete="off"/></div>
<div id="state">State: <select name="state"><option selected="true"></option><option>AL</option><option>AK</option><option>AZ</option><option>AR</option><option>CA</option><option>CO</option><option>CT</option><option>DE</option><option>FL</option><option>GA</option><option>HI</option><option>ID</option><option>IL</option><option>IN</option><option>IA</option><option>IA</option><option>KS</option><option>KY</option><option>LA</option><option>ME</option><option>MD</option><option>MA</option><option>MI</option><option>MN</option><option>MS</option><option>MO</option><option>MT</option><option>NE</option><option>NV</option><option>NH</option><option>NJ</option><option>NM</option><option>NY</option><option>NC</option><option>ND</option><option>OH</option><option>OK</option><option>OR</option><option>PA</option><option>RI</option><option>SC</option><option>SD</option><option>TN</option><option>TX</option><option>UT</option><option>VT</option><option>VA</option><option>WA</option><option>WV</option><option>WI</option><option>WY</option></select></div>
<div id="zip">Zip: <input id="zipInput" type="text" name="zip" autocomplete="off"/></div>
<input type="hidden" id="day" value="" name="day"/>
<input type="hidden" id="month" value="" name="month"/>
<input type="hidden" id="year" value="" name="year"/>
<input type="hidden" id="lessonID" value="" name="lessonID"/>
<input type="hidden" id="topic" value="<?php echo $topic; ?>" name="topic"/>
</fieldset><br>
<button>Reserve Date</button>
</form>
</div>
</div>
</div>

<?php

$sql = "SELECT live_data.ID, live_data.Name, live_data.Primary_Subject, live_data.Secondary_Subject, live_data.Language, GROUP_CONCAT(standards.Standard), live_data.PDF_link, grade_range.Grade_Range 
        FROM `topic` 
        LEFT JOIN topic_lesson_junction on topic.ID = topic_lesson_junction.Topic_ID
        LEFT JOIN live_data on topic_lesson_junction.Name_ID = live_data.ID
        LEFT JOIN standard_name_junction on live_data.ID=standard_name_junction.Name_ID
        LEFT JOIN standards on standard_name_junction.Standard_ID=standards.ID
        LEFT JOIN grade_range on live_data.Grade_ID=grade_range.ID
        WHERE topic.Name = '$topicName'
        GROUP BY live_data.ID";
        
//run the sql statement and save it in result
$result = $con->query($sql);
   $holder = $result->fetch_assoc();
   
//iterate through result and output each result into a table for the user to view   
if ($holder['Name'] === NULL){
echo "Sorry, there are no lessons currently available for this topic.";
}
else {
   echo "<div class='leftSide'>";
   echo "<span><p>Currently showing lessons for <select><option value='English'>English</option></select></p></span>";
   echo "<p>Select a lesson from the table below to preview the Lesson Plan, Alignments and Materials List.</p>";
   echo "<div><section class=''><div class='container'><table id='topics' class='topic'>";
   echo "<thead><tr><th>Lesson Plan Name<div>Lesson Plan Name</div></th>";
   echo "<th>Lesson Plan Language<div>Lesson Plan Language</div></th>";
   echo "<th>Grade(s)<div>Grade(s)</div></th>";
   echo "<th>Download<div>Download</div></th></tr></thead>";
   echo "<tbody>";

   $first = $holder["PDF_link"];
   echo "<tr id='" .$holder["PDF_link"]. "' class='selected' onclick='changeView(\"" .$holder["PDF_link"]. "\", " .$holder["ID"]. ")'><td>" .$holder["Name"]. "</td>";
   	echo "<td>" .$holder["Language"]. "</td>";
   	echo "<td> " .$holder["Grade_Range"]. "</td>";
   	echo "<td><form action='download.php' method='post'><button type='submit'>Download</button><input type='hidden' name='file' value='".$holder["Name"]."'/><input type='hidden' name='filePath' value='PDFs/".$holder["PDF_link"]. "'/></form></td></tr>";
   while($row = $result->fetch_assoc()){
   	echo "<tr id='" .$row["PDF_link"]. "' onclick='changeView(\"" .$row["PDF_link"]. "\", " .$row["ID"]. ")'><td>" .$row["Name"]. "</td>";
   	echo "<td>" .$row["Language"]. "</td>";
   	echo "<td> " .$row["Grade_Range"]. "</td>";
   	echo "<td><form action='download.php' method='post'><button type='submit'>Download</button><input type='hidden' name='file' value='".$row["Name"]."'/><input type='hidden' name='filePath' value='PDFs/".$row["PDF_link"]. "'/></form></td></tr>";
   }
   echo "</tbody></table></div></section></div>";  

 echo "<div class='scheduling_materials'>";
        echo "<div id='standards'><h3>Alignments:</h3>";
        echo "<div id='alignment'></div></div>";
 	echo "<div id='all_materials'>";
	echo "<div id='neededdiv'><h3>Needed Materials:</h3><div id='needed'></div></div>";
	echo "<div id='availablediv'><h3>Available Materials:</h3><div id='available'></div></div></div><br><br>";

        echo "<div id='calHolder'><p>Select a date on the calendar to reserve the Available Materials for that day.</p>";
	echo "<div class='calendar' id='cal'>";
		
		echo "<div class='cal_header'>";
    			echo "<span class='left button' id='prev' onclick='prevMonth()'> &lang; </span>";
    			echo "<span class='left hook'></span>";
    			echo "<span class='month-year' id='label'></span>";
    			echo "<span class='right hook'></span>";
    			echo "<span class='right button' id='next' onclick='nextMonth()'> &rang; </span>";
		echo "</div>";

		echo "<table id='days' class='calendar'>";
  			echo "<tbody class='cal'>";
  				echo "<tr class='cal'>";
    					echo "<td>sun</td>";
    					echo "<td>mon</td>";
    					echo "<td>tue</td>";
    					echo "<td>wed</td>";
    					echo "<td>thu</td>";
    					echo "<td>fri</td>";
   				 	echo "<td>sat</td>";
  				echo "</tr>";
  			echo "</tbody>";
		echo "</table>";

		echo "<div id='cal-frame'>";
  			
		echo "</div>";
	echo "</div></div>";


echo "</div>";
echo "</div>";  
   echo "<div id='article'><article class='iframe_holder'>
         <iframe id='iframe' class='doc' onload='loadMaterials(" .$holder["ID"]. ")' src='http://docs.google.com/gview?url=http://onewatershed.org/staging_html/PDFs/" .$first. "&embedded=true'></iframe>
         </article></div>";
}

//function call to ensure there is no code be run on imput 
function test_input($data){
    $data = urldecode($data);
    $data = trim($data);
    $data = stripslashes($data);
    //$data = htmlspecialchars($data);
    $data = strip_tags($data);
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