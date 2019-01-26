<?php
//database connection info
include '../connect.php';

$sql = "SELECT Name
        FROM topic
        WHERE 1";
        
$result = $con->query($sql);
while ($row = $result->fetch_assoc()){
    $names[] = $row['Name'];

}

$x = test_input($_REQUEST['x']);
$q = test_input($_REQUEST['q']);

$hint = "";

if ($x !== ""){
    $x = strtolower($x);
    $len = strlen($x);
    foreach($names as $answer){
        if (stristr($x, substr($answer, 0, $len))){
            if ($hint === ""){
                $hint = "<li class='liveSearch' onclick='fillTopic(\"".$answer."\", ".$q.")'>".$answer."</li>";
            }
            else{
                $hint .= "<li class='liveSearch' onclick='fillTopic(\"".$answer."\", ".$q.")'>".$answer."</li>";
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