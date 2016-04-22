<?php
include("../connect.php");
include ("./grant.php");
//username=user&password=gchhx&sysadmin=on
$id_mod=$_POST["id_modify"];
$modify=$_POST["modify"];
$del_user=$_POST["del_user"];

//echo $id_mod;
//echo $modify;
//echo "</br>";
//echo "$del_user";

if ($del_user && $profile == "0" ){

    $query="DELETE FROM users WHERE idusers = '$del_user' ";
    $esegui=mysql_query($query)or die(mysql_error());
    header("location: ../root.php?p=user&i=1");

}

?>