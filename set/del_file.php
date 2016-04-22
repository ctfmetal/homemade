<?php
include("../connect.php");
include ("./grant.php");

$id_category=$_GET['cat'];
$file=$_GET['file'];
$filename=$_GET['fn'];
$file_id=$_GET['file_id'];
$fol_id=$_GET['fol_id'];

//echo $file;

//echo $id_category;

//Controllo se posso visualizzare la pagina

$q_controllo="SELECT * FROM category WHERE idcategory='$id_category'";
$ris=mysql_query($q_controllo)or die(mysql_error());
if(mysql_num_rows($ris) != 1) {


    echo "OUTGOING MODE. PLEASE RELOGIN";
    exit;

}
else {
    //Controllo che sia effettivamente il proprietario del documento e che non si pubblico.
    $query="SELECT * FROM category WHERE idcategory='$id_category'";
    $esegui=mysql_query($query)or die(mysql_error());

    while ($results = mysql_fetch_array($esegui)) {
        $id = $results[idcategory];
        $name = $results[name];
        $type = $results[type];
        $private = $results[priv];
        $owner = $results[owner];
        $path = $results[structure];

        if($profile != "0") {
            if ($owner != $cod && $private == "1") {
                echo "OUTGOING MODE. PLEASE RELOGIN";
                exit;
            };
        }
    }
}


$file=$_GET['file'];
//echo $filename;
//echo "<br>$file_id_folder";

unlink("../$file");

        if (file_exists("../$file")) {
            unlink("../$file");
            $query="DELETE FROM file WHERE idfile = '$file_id' ";
            $esegui=mysql_query($query)or die(mysql_error());
           //echo " $esegui";
            header("location: ../root.php?p=mod_category&cat=$id_category&fol=$fol_id&d=1");



        }

        else {
            $query="DELETE FROM file WHERE idfile = '$file_id' ";
            $esegui=mysql_query($query)or die(mysql_error());
            //echo " $esegui";
            //echo "$query";
            header("location: ../root.php?p=mod_category&cat=$id_category&fol=$fol_id&d=1");
        }



?>


