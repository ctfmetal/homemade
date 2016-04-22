<?php

include("../connect.php");
include ("./grant.php");

$id_canc=$_GET["scelta"];

$query="SELECT * FROM category WHERE idcategory='$id_canc'";
$esegui=mysql_query($query)or die(mysql_error());

while ($results = mysql_fetch_array($esegui)) {
    $id = $results[idcategory];
    $name = $results[name];
    $type = $results[type];
    $private = $results[priv];
    $owner = $results[owner];
    $path = $results[structure];
}
$path1=("../files/$path");
$aut = isDirEmpty($path1);
//echo $aut;

if($aut == "") {

    if ($profile == "0" || $private == 0 || $owner == $cod) {


        $query = "DELETE FROM category WHERE idcategory='$id_canc'";
        $ris = mysql_query($query) or die(mysql_error());
        header("location: ../root.php?p=mod_entry&i=1");

        //echo $path1;
        rmdir($path1);

    }
}else header("location: ../root.php?p=mod_entry&i=2");