<?php

$id_category=$_GET['cat'];
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

	<div class="col-md-10">
		<div class="panel-body">

				<div class='content-box-large text-center'>
					<?php echo "<h3><strong><p>$name</p></strong></h3>"?>
				</div>

				<div class="col-md-4">
					<div class="content-box-large">
						<form action="./set/add_document.php?cat=<?php echo $id;?>&adf=1" method="post" enctype="multipart/form-data" >
							<div class="form-group">
								<div class="form-group">
									<label>Document ADD </label>
									<input name="doc_nome" class="form-control" placeholder="Document Name" required type="text">
								</div>
								<?php if($type == "2"){
									echo"
											<div class='form-group'>
												<label>Invoice Import </label>
												<div class='input-group'>
													<span class='input-group-addon'>€</span>
													<input name='importo' class='form-control' id='prepend' placeholder='Euro' type='text'required >
												</div>
											</div>
											<div class='form-group'>
												<div class='input-group'>
													<div class='panel-options'>
														<div>
															<label>Invoice Maturing </label>
															<div class='date'>
																<div class='input-group input-append date' id='dateRangePicker'>
																<span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
																	<input type='text' class='form-control' name='date' />

																</div>
															</div>
														</div>
													</div>
												</div>
											</div>";
								};
								?>
								<div class="form-group">
									<label>File input </label>
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
											echo "<strong style='color:red'>Error: File Too Large Or Exist!</strong> ";
										}
										if($res == "3"){
											echo "<strong style='color:red'>Error: Entry Found</strong>";
										}
										if($res == "15"){
											echo "<strong style='color:red'>Error: Image Exist!</strong>";
										}
									?>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-8">
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

								$query="SELECT * FROM folder WHERE folder_id_category='$id' ORDER BY folder_id DESC";
								$esegui=mysql_query($query)or die(mysql_error());

									while ($results = mysql_fetch_array($esegui)) {
										$id_folder = $results[folder_id];
										$folder_id_category = $results[folder_id_category];
										$folder_name = $results[folder_name];
										$folder_view = $results[folder_view];
										$folder_type = $results[folder_type];
										$folder_owner = $results[folder_owner];
										//$folder_path = $results[det_cat_path];
										$folder_importo = $results[folder_importo];
										$folder_scadenza = $results[folder_scadenza];
										$folder_data_upload = $results[folder_data_upload];
										$folder_pagata = $results[folder_pagata];

										if($folder_pagata == ""){
											$color="red";
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
	</div>













