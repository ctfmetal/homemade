<?php



$result = mysql_query("SELECT count(*) from folder WHERE folder_type='2' AND folder_pagata !='' AND folder_priv != '1' ;");
$pagata_res = mysql_result($result, 0);

$result = mysql_query("SELECT count(*) from folder WHERE folder_type='2' AND folder_pagata='' AND folder_priv != '1';");
$non_pagata_res = mysql_result($result, 0);
?>



<div class="col-md-10">
    <div class="panel-body">
        <div class="col-md-6">
            <div class='content-box-large '>
                <h3><strong><p>Payd Invoices: <?php echo $pagata_res?></p></strong></h3>
                <div class="content-box-large">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>Import</th>
                            <th>Maturing</th>
                            <th>Paid</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        //$query="SELECT * FROM folder WHERE folder_type='2' ";
                        $query="SELECT * FROM folder WHERE folder_type='2' ORDER BY folder_id ";
                        $esegui=mysql_query($query)or die(mysql_error());

                        while ($results = mysql_fetch_array($esegui)) {
                            $id_folder = $results[folder_id];
                            $folder_id_category = $results[folder_id_category];
                            $folder_name = $results[folder_name];
                            $folder_view = $results[folder_view];
                            $folder_type = $results[folder_type];
                            $folder_priv = $results[folder_priv];
                            $folder_owner = $results[folder_owner];
                            //$folder_path = $results[det_cat_path];
                            $folder_importo = $results[folder_importo];
                            $folder_scadenza = $results[folder_scadenza];
                            $folder_data_upload = $results[folder_data_upload];
                            $folder_pagata = $results[folder_pagata];

                            if ($folder_priv != 0){
                                continue;
                            }

                            if($folder_pagata == ""){
                                $color="red";
                                continue;
                            }else $color="green";



                            echo"
                                                <tr class='odd gradeX'>
                                                <td style='color:$color'>
                                                    <a href='./root.php?p=mod_category&cat=$folder_id_category&fol=$id_folder'>
                                                    <i class='glyphicon glyphicon-cog'></i></a>
                                                    $folder_view
                                                </td>
                                                <td style='color:$color'>$folder_importo</td>
                                                <td style='color:$color'>$folder_scadenza</td>
                                                <td style='color:$color'>$folder_pagata</td>

                                            </tr>


                                            ";



                        }

                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">

                <div class='content-box-large '>
                    <h3><strong><p> To Pay Invoices: <?php echo $non_pagata_res?></p></strong></h3>

                    <div class="content-box-large">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th>Import</th>
                                <th>Maturing</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $query="SELECT * FROM folder WHERE folder_type='2' ORDER BY folder_id";
                            $esegui=mysql_query($query)or die(mysql_error());

                            while ($results = mysql_fetch_array($esegui)) {
                                $id_folder = $results[folder_id];
                                $folder_id_category = $results[folder_id_category];
                                $folder_name = $results[folder_name];
                                $folder_view = $results[folder_view];
                                $folder_type = $results[folder_type];
                                $folder_owner = $results[folder_owner];
                                $folder_priv = $results[folder_priv];
                                //$folder_path = $results[det_cat_path];
                                $folder_importo = $results[folder_importo];
                                $folder_scadenza = $results[folder_scadenza];
                                $folder_data_upload = $results[folder_data_upload];
                                $folder_pagata = $results[folder_pagata];

                                if ($folder_priv != 0){
                                    continue;
                                }

                                if($folder_pagata == ""){
                                    $color="red";
                                }else {
                                    $color="green";
                                    continue;
                                }



                                echo"
                                                    <tr class='odd gradeX'>
                                                    <td style='color:$color'>
                                                        <a href='./root.php?p=mod_category&cat=$folder_id_category&fol=$id_folder'>
                                                        <i class='glyphicon glyphicon-cog'></i></a>
                                                        $folder_view
                                                    </td>
                                                    <td style='color:$color'>$folder_importo</td>
                                                    <td style='color:$color'>$folder_scadenza</td>


                                                </tr>


                                                ";



                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>