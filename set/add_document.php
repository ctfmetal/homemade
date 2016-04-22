<?php
include("../connect.php");
include ("./grant.php");
$cod = $_SESSION['cod'];
//doc_nome=prova&importo=19%2C00&date=04%2F19%2F2016&usefile=README.md


$importo=$_POST["importo"];
$data=$_POST["date"];
$folder_name_up=$_POST["doc_nome"];
$folder_name=str_replace('/', '-', $folder_name_up); // 'Ciao a tutti'
//$id_categoria=$_POST["id_categoria"];
$scadenza=$_POST["date"];
$importo=$_POST["importo"];
$now=date("d/m/Y");
$secondary_file=$_POST["secondary_file"];
$adfile=$_GET["adf"];
//$det_cat_name=$_GET['dcn'];

$file_id_folder=$_GET['idf'];

$file_upload=$_FILES['FileUtente']['name'];
$id_cat=$_GET['cat'];
$pagata=$_POST['data-pagata'];
$mod_name=$_GET['mod_name'];
$name_modify=$_POST['name_modify'];
$new_name=$_POST['new_name'];
$fp=$_GET['fp'];





//echo "Importo: $importo </br>";
//echo "Data: $data</br>";
//echo "Doc Name: $folder_name</br>";
//echo "Id Categoria: $id_catagoria</br>";
//echo "Data: $now</br>";
//echo "Secondo File: $secondary_file</br>";
//echo "Add File: $adfile</br>";
//echo "Importo: $importo</br>";
//echo "File Upload: $file_upload</br>";
//echo "Id Categoria: $id_cat</br>";
//echo "File Id Folder: $file_id_folder</br>";



if ($mod_name == "1" && $name_modify == "1" ){
    $query = "UPDATE folder SET folder_view ='$new_name' WHERE folder_id='$file_id_folder'";
    $esegui = mysql_query($query) or die(mysql_error());

    $query = "SELECT * FROM folder WHERE folder_id='$file_id_folder'";
    $esegui = mysql_query($query) or die(mysql_error());

    while ($results = mysql_fetch_array($esegui)) {
        $folder_id_category = $results[folder_id_category];


    }



   header("location: ../root.php?p=mod_category&cat=$folder_id_category&fol=$file_id_folder&res=1");




}




if ($adfile == "1") {

    $q_controllo1="SELECT * FROM folder WHERE folder_name='$folder_name'";
    $ris1=mysql_query($q_controllo1)or die(mysql_error());
    $conto=mysql_num_rows($ris1);
    //
    //echo $conto;

    if(mysql_num_rows($ris1) != 0)
    {
        //echo "Trovato un record";
        header("location: ../root.php?p=category&cat=$id_cat&res=3");
        //exit;
    }





    $query = "SELECT * FROM category WHERE idcategory='$id_cat'";
    $esegui = mysql_query($query) or die(mysql_error());

    while ($results = mysql_fetch_array($esegui)) {
        $id = $results[idcategory];
        $name = $results[name];
        $type = $results[type];
        $private = $results[priv];
        $owner = $results[owner];
        $path = $results[structure];

        $structure ="../files$path/$folder_name";

        //echo $structure;

        if (!mkdir($structure, 0777, true)) {
            //die('Failed to create folders...');
            header("location: ../root.php?p=category&cat=$id_cat&res=15");
        }



        $filename = $_FILES["FileUtente"]["name"];

        if ($filename) {




            $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
            $file_ext = substr($filename, strripos($filename, '.')); // get file name
            $filesize = $_FILES["file"]["size"];
            //$allowed_file_types = array('.doc','.docx','.rtf','.pdf');

            $newfilename = md5($file_basename) . $file_ext;
            if (file_exists("../files$path/$folder_name" . $newfilename)) {
                // file already exists error
                //echo "You have already uploaded this file.";
                header("location: ../root.php?p=category&cat=$id_cat&res=15");
            }

            else {

                move_uploaded_file($_FILES["FileUtente"]["tmp_name"], "../files$path/$folder_name/" . $newfilename);
               // echo "File uploaded successfully.";

                $query = "INSERT INTO folder
                          (folder_id,
                           folder_id_category,
                           folder_name,
                           folder_view,
                           folder_name_category,
                           folder_type,
                           folder_priv,
                           folder_path,
                           folder_owner,
                           folder_upload_user,
                           folder_importo,
                           folder_scadenza,
                           folder_data_upload,
                           folder_pagata)
                           VALUES
                           ('',
                            '$id_cat',
                            '$folder_name',
                            '$folder_name',
                            '$name',
                            '$type',
                            '$private',
                            '$path',
                            '$owner',
                            '$cod',
                            '$importo',
                            '$scadenza',
                            '$now',
                            '$pagata')";


                $esegui = mysql_query($query) or die(mysql_error());

                $queryA = "SELECT * FROM folder WHERE folder_name='$folder_name'";
                $eseguiA = mysql_query($queryA) or die(mysql_error());

                while ($results = mysql_fetch_array($eseguiA)) {
                    $id_folder_res = $results[folder_id];


                    $query1 = "INSERT INTO file
                               (idfile,

                                file_id_category,
                                file_id_folder,
                                file_name,
                                file_type,
                                file_priv,
                                file_id_owner,
                                file_path,
                                file_upload_user,
                                file_data_upload)
                               VALUES
                               ('',

                                '$id_cat',
                                '$id_folder_res',
                                '$newfilename',
                                '$type',
                                '$private',
                                '$owner',
                                'files$path/$folder_name',
                                '$cod',
                                '$now')";
                    $eseguiA = mysql_query($query1) or die(mysql_error());
                }
            }
        }

        else {




            $q_controllo1="SELECT * FROM folder WHERE folder_name='$folder_name'";
            $ris1=mysql_query($q_controllo1)or die(mysql_error());
            $conto=mysql_num_rows($ris1);
            //echo $conto;

            if(mysql_num_rows($ris1) != 0)
            {
                //echo "Trovato un record";
               //
               //
               header("location: ../root.php?p=category&cat=$id_cat&res=3");
               // exit;
            }

            $query = "INSERT INTO folder
                      (folder_id,
                       folder_id_category,
                       folder_name,
                       folder_view,
                       folder_name_category,
                       folder_type,
                       folder_priv,
                       folder_path,
                       folder_owner,
                       folder_upload_user,
                       folder_importo,
                       folder_scadenza,
                       folder_data_upload,
                       folder_pagata)
                       VALUES
                       ('',
                        '$id_cat',
                        '$folder_name',
                        '$folder_name',
                        '$name',
                        '$type',
                        '$private',
                        '$path',
                        '$owner',
                        '$cod',
                        '$importo',
                        '$scadenza',
                        '$now',
                        '$pagata')";

            $esegui = mysql_query($query) or die(mysql_error());
        }

    }

   header("location: ../root.php?p=category&cat=$id_cat&res=0");


}



elseif ($adfile == "2" && $file_id_folder != "") {

    $filename = $_FILES["FileUtente"]["name"];

    if ($filename) {

        $query = "SELECT * FROM folder WHERE folder_id='$file_id_folder'";
        $esegui = mysql_query($query) or die(mysql_error());
        while ($results = mysql_fetch_array($esegui)) {
            $folder_id = $results[folder_id];
            $folder_id_category=$results[folder_id_category];
            $folder_name = $results[folder_name];
            $folder_name_category = $results[folder_name_category];
            $folder_type = $results[folder_type];
            $folder_priv = $results[folder_priv];

            $folder_path = $results[folder_path];
            $folder_owner = $results[folder_owner];

            $folder_importo = $results[folder_importo];
            $folder_scadenza = $results[folder_scadenza];
            $folder_data_upload = $results[folder_data_upload];
            $folder_pagata = $results[folder_pagata];


            $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
            $file_ext = substr($filename, strripos($filename, '.')); // get file name
            $filesize = $_FILES["file"]["size"];
            //$allowed_file_types = array('.doc','.docx','.rtf','.pdf');

            $file_path = "files/$folder_path/$folder_name";
           // echo $file_path;

            $newfilename = md5($file_basename) . $file_ext;
            if (file_exists("../$file_path/" . $newfilename)) {
                // file already exists error
                //echo "You have already uploaded this file.";
                header("location: ../root.php?p=mod_category&cat=$folder_id_category&fol=$folder_id&res=15");
            } else {
                move_uploaded_file($_FILES["FileUtente"]["tmp_name"], "../$file_path/" . $newfilename);
                //echo "File uploaded successfully.";

                $queryA = "SELECT * FROM folder WHERE folder_name='$folder_name'";
                $eseguiA = mysql_query($queryA) or die(mysql_error());

                while ($results = mysql_fetch_array($eseguiA)) {
                    $id_folder_res = $results[folder_id];


                    $query1 = "INSERT INTO file
                                   (idfile,

                                    file_id_category,
                                    file_id_folder,
                                    file_name,
                                    file_type,
                                    file_priv,
                                    file_id_owner,
                                    file_path,
                                    file_upload_user,
                                    file_data_upload)
                                   VALUES
                                   ('',

                                    '$folder_id_category',
                                    '$id_folder_res',
                                    '$newfilename',
                                    '$folder_type',
                                    '$folder_priv',
                                    '$folder_owner',
                                    '$file_path',
                                    '$cod',
                                    '$now')";
                    $eseguiA = mysql_query($query1) or die(mysql_error());






                }header("location: ../root.php?p=mod_category&cat=$folder_id_category&fol=$id_folder_res&res=0");
            }
        }
    }

    if ($pagata != "" && $adfile == "2" && $filename == "" && $mod_name != "1"){

       // echo "PAGATA: $pagata";

        $queryA = "UPDATE folder SET folder_pagata='$pagata' WHERE folder_id='$file_id_folder'";
        $eseguiA = mysql_query($queryA) or die(mysql_error());
       header("location: ../root.php?p=category&cat=$id_cat");


    }

    if ($pagata == "" && $adfile == "2" && $filename == "" && $mod_name != "1"){
        $queryA = "UPDATE folder SET folder_pagata='$pagata' WHERE folder_id='$file_id_folder'";
        $eseguiA = mysql_query($queryA) or die(mysql_error());
        header("location: ../root.php?p=category&cat=$id_cat");


    }




}






else header("location: ../root.php?p=category&cat=$folder_id_category&fol=$id_folder_res&res=1");






?>



