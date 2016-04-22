<?php

$id_category=$_GET['cat'];
$file=$_GET['file'];
$fid=$_GET['fid'];
$id_folder=$_GET['fol_id'];
$filename=$_GET['fn'];

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
?>

<div class="col-md-1" align="center">
    <div class='content-box-large text-center'>
        <div class="form-group">
            <a href="./set/del_file.php?file=<?php echo $file?>&cat=<?php echo $id_category?>&fol_id=<?php echo $id_folder?>&file_id=<?php echo $fid?>" onclick="return confirm('DELETE FILE: <?php echo $file?>?');"><i class='glyphicon glyphicon-floppy-remove' style='font-size: 30px;color:red;'></i></a>
            <a href='javascript:window.print()'><i class='glyphicon glyphicon-print' style='font-size: 30px;'></i></a>
            <a href='<?php echo "$file"?>'><i class='glyphicon glyphicon-download' style='font-size: 30px;'></i></a>


        </div>
    </div>
</div>



<div class="col-md-8">
    <div class="panel-body">
        <div class='content-box-large text-center'>
            <?php
            $estensione = file_extension("$file");

            if ($estensione == "png" || $estensione == "jpg" || $estensione == "jpeg" || $estensione == "JPEG" || $estensione == "JPG") {
                echo "<img src='./image.php?src=./$file&w=768&h=1024'/></a>";
            }
            else {
                echo "<a href='$file''>$file</a>";
            }
           ?>
        </div>
    </div>
</div>