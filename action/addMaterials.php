<html>
<div id="holder">
<head>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<title>OneWaterShed - Admin</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="nav.css">
    
</head>
<body>
<div id="holder">
<div class="nav">
<div class="links">
<ul class="nav">
    <li class="object"><a class="link" href="index.php">Home</a></li>
    <li class="object"><a class="link" href="search_start.php">Search</a></li>
    <li class="object"><a class="link" href="upload.php">Upload</a></li>
    <li class="object"><a class="link" href="About.php">About</a></li>
    <li class="object"><a class="link" href="partners.php">Partners</a></li>
<?php

//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    echo "<li class='object'><a class='link' href='/staging_html/member_page.php'>". $_SESSION['username']."</a><li>";
    echo "<li class='object'><a class='link' id='active' href='/staging_html/admin_page.php'>Admin</a></li>";
}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:/staging_html/login_page.php");
    exit();
}

?>
</ul>
<div>
<a href="login_page.php"><img class="logo" src="/staging_html/Images/earth_waterdrop.png"></a>
</div>
</div>
</div>
<?php
//start session to check that the person has signed in
session_start();

//do check if the person is logged in and if they are show the uploaded_data table for them to be verified and copied to live_data
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){

    //database connection info
    include '../connect.php';
  
    $material_1 = test_input($_POST['material1']);
    $material_2 = test_input($_POST['material2']);
    $material_3 = test_input($_POST['material3']);
    $material_4 = test_input($_POST['material4']);
    $material_5 = test_input($_POST['material5']);
    $material_6 = test_input($_POST['material6']);
    $material_7 = test_input($_POST['material7']);
    $material_8 = test_input($_POST['material8']);
    $material_9 = test_input($_POST['material9']);
    
    if($material_1 != ''){
        $check = $_POST['provider1'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_1'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_1')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_1. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_1. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_2 != ''){
        $check = $_POST['provider2'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_2'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_2')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_2. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_2. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_3 != ''){
        $check = $_POST['provider3'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_3'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_3')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_3. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_3. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_4 != ''){
        $check = $_POST['provider4'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_4'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_4')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_4. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_4. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_5 != ''){
        $check = $_POST['provider5'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_5'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_5')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_5. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_5. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_6 != ''){
        $check = $_POST['provider6'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_6'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_6')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_6. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_6. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_7 != ''){
        $check = $_POST['provider7'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_7'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_7')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_7. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_7. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_8 != ''){
        $check = $_POST['provider8'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_8'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_8')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_8. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_8. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }
    if($material_9 != ''){
        $check = $_POST['provider9'];
        if($check == 'needed'){
            $table = 'materials';
            
        }else{
            $table = 'available_materials';
            
        }
        
        $sql1 = "SELECT ID, Name
                 FROM ".$table."
                 WHERE Name = '$material_9'";
                      
        $result = $con->query($sql1);
        $row = $result->fetch_assoc();
        $item = $row['Name'];
        echo "the item you got in the search was " .$item. "<br>";
        
        if($item == ''){       
            $sql = "INSERT INTO ".$table." (Name)
                    VALUES ('$material_9')";
                
            if ($con->query($sql) === True){
                echo "the sql query ran and added " .$material_9. " to the table " .$table. "<br>";
                header("Location:/staging_html/admin_page.php");
                exit();
            }
            else{
                echo "The sql statement failed and " .$material_9. " was not added to  the database.<br>";
            }
        }
        else{
            header("Location:/staging_html/admin_page.php");
            exit();
        }
    }

}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:/staging_html/login_page.php");
    exit();
}

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
</div>
</body>

<div id="images"><span>
<a href="https://www.washcoll.edu/centers/ces/"><img class="CES" src="Images/CES.png" alt="CES"></a>
<a href="https://www.washcoll.edu"><img class="WAC" src="Images/Black_sig_MD.png" alt="Washington College"></a>
</span></div>

</html>