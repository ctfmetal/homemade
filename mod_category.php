<?php

$id_category=$_GET['cat'];
$id_folder=$_GET['fol'];

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


$q_controllo="SELECT * FROM folder WHERE folder_id='$id_folder' and folder_id_category='$id_category'";
$esegui1=mysql_query($q_controllo)or die(mysql_error());
if(mysql_num_rows($esegui1) == 1){

    while ($results = mysql_fetch_array($esegui1)) {
        $folder_id = $results[folder_id];
        $folder_name = $results[folder_name];
        $folder_view = $results[folder_view];
        $folder_name_category = $results[folder_name_category];
        $folder_type = $results[folder_type];
        $folder_id_owner = $results[folder_id_owner];
        $folder_path = $results[folder_path];
        $folder_importo = $results[folder_importo];
        $folder_scadenze = $results[folder_scadenze];
        $folder_data_upload = $results[folder_data_upload];
        $folder_name_category = $results[folder_name_category];
        $folder_pagata = $results[folder_pagata];

    }
}
?>

<div class="col-md-10">
    <div class="panel-body">
        <div class="col-md-3">
            <div class="content-box-large">
                <div class="form-group">
                    <div class="form-group">
                        <div>
                            <a href="" onclick="goBack()" ><i style='font-size: 30px' class="glyphicon glyphicon-chevron-left"></i></a>
                            <a href="./set/del_document.php?folder_id=<?php echo $folder_id?>&cat=<?php echo $id_category?>" onclick="return confirm('DELETE DOCUMENT: <?php echo "$folder_name_category: $folder_name"?> ?')" ><i align="left" style='font-size: 30px; color:red' class="glyphicon glyphicon-remove"></i></a>

                        </div>

                        <?php
                        $edit=$_GET['edit'];
                        if ($edit == "1"){
                            echo"

                                 <div class='form-group'>
                                      <form action='./set/add_document.php?mod_name=1&adf=2&idf=$folder_id&cat=$id_category' method='post' enctype='multipart/form-data'>
                                          <input type='text' name='new_name' value='$folder_view'>
                                          <button class='btn btn-info btn-xs'><i class='glyphicon glyphicon-refresh'></i> Edit</button>
                                          <input type='hidden' name='name_modify' value='1'>
                                      </form>
                                 </div>


                                ";
                        }

                        ?>

                        <form action="./set/add_document.php?adf=2&idf=<?php echo $folder_id?>&cat=<?php echo $id_category?>" method="post" enctype="multipart/form-data" >
                                <div>
                                    <h5>
                                        <strong><?php echo "$folder_name_category: $folder_view "?>
                                         <?php echo " <a href='./root.php?p=mod_category&cat=$id_category&fol=$id_folder&edit=1'><i class='glyphicon glyphicon-edit'></i></a>";?>
                                        </strong>
                                    </h5>
                                </div>
                                <div>
                                    <?php
                                    if ($folder_type == "2") {
                                        echo "<h5><strong>Paid:";
                                        if ($folder_pagata == ""){
                                            echo "<strong style='color:red'>Not Paid!</strong>";
                                        }else
                                        echo "<strong style='color: green'> $folder_pagata</strong>";
                                    }
                                    ?>
                                </div>
                                </br>


                                <label>Paid : </label>
                                <div class='date'>
                                    <div class='input-group input-append date' id='dateRangePicker'>
                                        <span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
                                        <?php
                                        $queryA = "SELECT * FROM folder WHERE folder_id='$id_folder'";
                                        $eseguiA = mysql_query($queryA) or die(mysql_error());

                                        while ($results = mysql_fetch_array($eseguiA)) {
                                            $pagata_res = $results[folder_pagata];
                                        }

                                        ?>


                                        <input type='text' class='form-control' name='data-pagata' value="<?php echo $pagata_res?>" />

                                    </div>
                                </div>
                                </br>
                                <label>File ADD </label>
                                <input type="hidden" value="1" name="secondary_file">
                                <input class="button" type="file" name="FileUtente" id="FileUtente">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                                <input type='hidden' name='id_categoria' value="<?php echo $id?>">
                                <?php
                                $res=$_GET["res"];
                                if($res == "0"){
                                    echo "Document Added";
                                }
                                if($res == "1"){
                                    echo "Error Upload: Too Large File! ";
                                }
                                if($res == "15"){
                                    echo "<strong style='color:red'>Error: Image Exist!</strong>";
                                }
                                ?>
                            </div>
                            </br>
                            </br>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 ">
                <div class='content-box-large '>


                    <?php

                    $query = "SELECT * FROM file WHERE file_id_folder='$id_folder'";
                    $esegui = mysql_query($query) or die(mysql_error());
                    while ($results = mysql_fetch_array($esegui)) {
                        $file_path = $results[file_path];
                        $file_name = $results[file_name];
                        $file_id = $results[idfile];

                        $file = "$file_path/$file_name";
                        $file_id_category = $results[file_id_category];
                        $estensione = file_extension("$file");
                        //echo $estensione;

                        if ($estensione == "png" || $estensione == "jpg" || $estensione == "jpeg" || $estensione == "JPEG" || $estensione == "JPG") {

                            echo "<a href='root.php?p=view&cat=$file_id_category&file=$file&fid=$file_id&fol_id=$id_folder' onclick='window.open(this.href);return false'>
                            <img src='./image.php?src=./$file&w=200&h=200'/></a>";
                            //echo "./$file";
                        }

                        else {
                            //echo "<a href='$file'><img src='./image.php?src=./images/file.png&w=200&h=200' alt='$file'/></a>";
                            echo "<a href='root.php?p=view&cat=$file_id_category&file=$file&fid=$file_id&fol_id=$id_folder' onclick='window.open(this.href);return false'>
                            <img src='./image.php?src=./images/file.png&w=200&h=200' alt='$file'/></a>
                            ";

                        }
                    }
                    ?>
                </div>
        </div>
    </div>
</div>
