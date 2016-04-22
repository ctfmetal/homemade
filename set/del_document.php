<?php
include("../connect.php");
include ("./grant.php");

$id_category=$_GET['cat'];
$folder_id=$_GET['folder_id'];

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



    $query3="SELECT * FROM file  WHERE file_id_folder='$folder_id'";
    $esegui3=mysql_query($query3)or die(mysql_error());
    $conto=mysql_num_rows($esegui3);
    //echo $conto;


    if(mysql_num_rows($esegui3) != 0){

        while ($results3 = mysql_fetch_array($esegui3)) {
            $file_id = $results3[idfile];
            $file_path = $results3[file_path];
            $file_name = $results3[file_name];
            //$file_id_folder = $results3[file_id_folder];


            $file = "$file_path/$file_name";
            //echo $folder_id;

            //echo "Dentro != 0";


            if (file_exists("../$file")) {

                echo "1";
                echo $file_path;

                unlink("../$file");
                rmdir("../$file_path");


                $querydel = "DELETE FROM file WHERE idfile = '$file_id' ";
                $eseguidel = mysql_query($querydel) or die(mysql_error());


                $querydelfolder = "DELETE FROM folder WHERE folder_id = '$folder_id' ";
                $eseguidelfolder = mysql_query($querydelfolder) or die(mysql_error());


            }

            else {

                echo "2";
                echo $file_path;

                rmdir("../$file_path");
                //echo"1";
                $querydelfolder = "DELETE FROM folder WHERE folder_id = '$folder_id' ";
                $eseguidelfolder = mysql_query($querydelfolder) or die(mysql_error());
            }


           header("location: ../root.php?p=category&cat=$id_category");


        }
    }

    else
    {
        $query3="SELECT * FROM folder  WHERE folder_id='$folder_id'";
        $esegui3=mysql_query($query3)or die(mysql_error());

        //echo $query3;

        while ($results3 = mysql_fetch_array($esegui3)) {

            $folder_path = $results3[folder_path];
            $folder_name = $results3[folder_name];
            //$file_id_folder = $results3[file_id_folder];
        }

        echo "3";
       // echo "../files/$folder_path/$folder_name";

        rmdir("../files/$folder_path/$folder_name");
        $querydelfolder = "DELETE FROM folder WHERE folder_id = '$folder_id' ";
        $eseguidelfolder = mysql_query($querydelfolder) or die(mysql_error());
        header("location: ../root.php?p=category&cat=$id_category");
        //echo "2";
    }