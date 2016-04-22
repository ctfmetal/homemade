<?php
include("../connect.php");
include ("./grant.php");
//username=user&password=gchhx&sysadmin=on
$user_add=$_POST["username"];
$user_pwd=$_POST["password"];
$set_pwd=md5($user_pwd);
$sysadmin=$_POST["sysadmin"];
if($sysadmin == "on"){
    $ins_sysad="0";
}else $ins_sysad="1";

$id_mod=$_POST["id_modify"];
$modify=$_POST["modify"];
$del_user=$_POST["del_user"];

//echo $id_mod;
//echo $modify;
//echo "</br>";
//echo "$del_user";

if ($user_add && $user_pwd != "" && $profile == "0" ){

    $query="INSERT INTO users (idusers, username, password, profile )
            VALUES ('', '$user_add', '$set_pwd', '$ins_sysad') ";
    $esegui=mysql_query($query)or die(mysql_error());
    header("location: ../root.php?p=user");

}

?>