<?php
session_start();
session_destroy(); 
echo "<h1 style=\"color:#009688\">Log Out Successful</h1>";
header('Refresh:2;url="index.php"');
?>
