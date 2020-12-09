<?php
header("Content-Type: application/pdf");
header("Content-Length: ".strlen($certified['certificate'])); 
header('Content-Disposition: attachment; filename='.$filecert);
echo $certified['certificate'];
?>
