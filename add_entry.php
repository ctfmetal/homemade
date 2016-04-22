
<form action="./set/add_entry.php" method="get">
            <div class="form-group">
                <label class="col-md-2 control-label" for="text-field">Add Category</label>
                <div class="col-md-10">
                    </br>

                    <div class="form-group">
                        <label>Category Name</label>
                        <input name="nome" class="form-control" placeholder="Name" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Category Type</label>
                        <select class="form-control" name="tipo">
                            <option value="1">Documents</option>
                            <option value="2">Invoices</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                    <div class="form-inline">
                        <label>Category Private</label>
                        <input name="private" type="checkbox" class="checkbox">

                    </div>

                         </br>
                     <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>

                    <?php
                    $entry=$_GET["i"];
                    if ($entry == "1" ){
                        echo "Entry Added";
                    }
                    if ($entry == "0" ){
                        echo "Entry Found";
                    }?>

                        <br>
                        </br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="categories">
                        <thead>
                        <tr>
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
                            echo "<td>$ec_priv</td>";
                            echo "<td>$name</td>";
                            echo "<td>$cat</td>";
                            echo "<td>$owner</td>";
                            echo "</tr>";

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
</form>


