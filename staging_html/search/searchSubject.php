<?php
//database connection info
include '../connect.php';

$sql = "SELECT DISTINCT Primary_Subject, Secondary_Subject
        FROM live_data
        WHERE 1";

        
$result = $con->query($sql);
while ($row = $result->fetch_assoc()){
    $names[] = $row['Primary_Subject'];
    $names[] = $row['Secondary_Subject'];
}

$x = test_input($_REQUEST['x']);

$hint = "";

if ($x !== ""){
    $x = strtolower($x);
    $len = strlen($x);
    foreach($names as $answer){
        if (stristr($x, substr($answer, 0, $len))){
            if ($hint === ""){
                $hint = "<li class='subjectSearch' onclick='fillSubject(\"".$answer."\")'>".$answer."</li>";
            }
            else{
                $hint .= "<li class='subjectSearch' onclick='fillSubject(\"".$answer."\")'>".$answer."</li>";
            }
        }
    }
}

echo $hint === "" ? "no suggestion" : $hint;

  
  //clean data to ensure security
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>