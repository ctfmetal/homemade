<?php
include("../connect.php");
include ("./grant.php");
$cod = $_SESSION['cod'];



$cat_name=$_GET["nome"];

$cat_type=$_GET["tipo"];
$cat_private=$_GET["private"];

//echo $cod;
//echo $id_log;
//echo $profile;

//echo $cat_name;
//echo $cat_type;

if ($cat_private == "on"){
      $ins_private="1";
}else $ins_private="0";


$q_controllo="SELECT * FROM category WHERE name='$cat_name'";
$ris=mysql_query($q_controllo)or die(mysql_error());
if(mysql_num_rows($ris) == 1)
{
    //echo "Trovato un record";
    header("location: ../root.php?p=add_entry&i=0");
}
else
{

    $structure = "../files/$id_log/$cat_name";
    $structure_php = "/$id_log/$cat_name";

    if (!mkdir($structure, 0777, true)) {
        die('Failed to create folders...');
    }

    //echo "Non ho trovato nessun record";
    $query="INSERT INTO category (idcategory, name, type, priv, owner, structure)
            VALUES ('', '$cat_name', '$cat_type', '$ins_private', '$cod', '$structure_php')";

    mysql_query($query)or die(mysql_error());




    header("location: ../root.php?p=add_entry&i=1");
}







    /*
    while ($results = mysql_fetch_array($ris)) {
        $id = $results[idcategory];
            echo $id;
        if ($id == ""){
            $query="INSERT INTO category (idcategory, name, type) VALUES ('', '$cat_name', '$cat_type')";
            mysql_query($query)or die(mysql_error());
            echo "ok";

        }else echo "patate";

    }


//header("location: ../index.php?p=add_entry");


/*
$query="INSERT INTO category (idcategory, name, type) VALUES ('', '$cat_name', '$cat_type')";
mysql_query($query)or die(mysql_error());
*/
?>