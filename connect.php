<?php
$username = "olomaster";
$password = "olodev";
$host = "olodb";
$database = "homemade";
//$port = 3308;

$conn = mysql_connect($host.':'.$port, $username, $password);
//or die (mysql_error());
$db=mysql_select_db($database,$conn)or die(mysql_error());




