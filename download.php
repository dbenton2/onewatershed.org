<?php
$file = $_POST['file'];
$file = str_replace(' ', '_', $file);
$filepath = $_POST['filePath'];
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=".$file."");
readfile($filepath);

?>
