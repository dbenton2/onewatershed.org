<?php
include '../connect.php';

//start session to check that the person has signed in
session_start();

//do check if the person is logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['accessLevel'] == 'admin'){
    
    $check = $_POST["check"];
    if($check == 'on'){
        $username = $_POST["user"];
        
        $sql = "UPDATE members
                SET members.Access_level = 'admin'
                WHERE members.username = '$username'";
                
        if ($con->query($sql) == TRUE){
            header("Location:/staging_html/admin_page.php");
            exit();
        }
        else{echo "There was an issue with the admin update";}
    }
    
    
}
else{
    //if the user is not logged in redirect them to the login page
    header("Location:/staging_html/login_page.php");
    exit();
}
?>