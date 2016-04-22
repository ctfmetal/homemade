




<div class="form-group">
    <label class="col-md-2 control-label" for="text-field">Edit  Category</label>
    </br>
    </br>
    <div class="col-md-10">
        <form action="./set/del_entry.php" method="get">

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="categories">
                <thead>
                <tr>

                    <th>Select</th>
                    <th>Privacy</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Owner</th>


                </tr>
                </thead>
                <tbody>
                <?php
                        $query="SELECT * FROM category ORDER BY owner";
                        $esegui=mysql_query($query)or die(mysql_error());

                        while ($results = mysql_fetch_array($esegui)) {
                            $id=$results[idcategory];
                            $name=$results[name];
                            $type=$results[type];
                            $private=$results[priv];
                            $owner=$results[owner];
                            if($private == "1"){
                                $ec_priv="Private";
                            }else $ec_priv="Public";

                            if ($profile != "0") {

                                if ($owner != $cod) {
                                    continue;
                                };
                            };
                            if ($type ==  "1"){
                                $cat="Documents";
                            };
                            if ($type ==  "2"){
                                $cat="Invoices";
                            };
                            if ($type ==  "3"){
                                $cat="Others";
                            };
                                echo "<tr>";
                                echo "<td><input name='scelta' type='radio' value='$id'></td>";
                                echo "<td>$ec_priv</td>";
                                echo "<td>$name</td>";
                                echo "<td>$cat</td>";
                                echo "<td>$owner</td>";
                                echo "</tr>";

                         }
                ?>



                </tbody>
            </table>
            <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button>
            <?php
            $entry=$_GET["i"];
            if ($entry == "1" ){
            echo "Entry Deleted";
            };
            if($entry == "2"){
                echo "Error: Path Not Empty!";
            }
            ?>
        </form>
    </div>
</div>
