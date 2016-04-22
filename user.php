<?php
$id_mod=$_GET['mod'];
unset($password);
unset($username);
//echo "$profile";
if($profile != "0"){
    session_start();
    $_SESSION = array();
    session_destroy(); //distruggo tutte le sessioni
//creo una varibiale con un messaggio
    $msg = "Informazioni: log-out effettuato con successo.";
//la codifico via urlencode informazioni-logout-effettuato-con-successo
    $msg = urlencode($msg); // invio il messaggio via get
//ritorno a index.php usando GET posso recuperare e stampare a schermo il messaggio di avvenuto logout
    header("location: /homemade");
    exit();
}

//echo $id_mod;

if ($id_mod != ""){
        $query="SELECT * FROM users WHERE idusers = '$id_mod'";
        $esegui=mysql_query($query)or die(mysql_error());
        while ($results = mysql_fetch_array($esegui)) {
            $id = $results[idusers];
            $username = $results[username];
            $prof = $results[profile];
            $ins="value='$username'";

            if ($prof == "0"){
                $checked="checked";
            }
        }
    //echo $id;
    echo "

    <form name='delete' action='./set/del_user.php' method='post'>
    <div class='form-group'>
            <label class='col-md-2 control-label' for='text-field'>Edit User</label>
            <div class='col-md-10'>
                </br>
            <div class='form-group'>
                <label>User</label>
                <input name='username' class='form-control' $ins placeholder='Username' required type='text'>
            </div>
            <div class='form-group'>
                <label>Password</label>
                <input type='password' name='password' class='form-control' placeholder='Password' required type='text'>
            </div>
            <div class='form-inline'>
                <label>Sysadmin</label>
                <input name='sysadmin' type='checkbox' class='checkbox' $checked>
            </div>
            </br>

            <button class='btn btn-info'><i class='glyphicon glyphicon-refresh'></i> Modify</button>
            <input type='hidden' name=modify value='1'>
    </form>
    </br>
    </br>
    <form name='delete' action='./set/del_user.php' method='post'>
            <input type='hidden' name='del_user' value='$id'>
            <button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Delete</button>

     </form>
    ";






    /*$button="<form name='delete' action='./set/del_user.php' method='post'>
             <button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i> Delete</button>
             </form>";
    $button2="<button class='btn btn-info'><i class='glyphicon glyphicon-refresh'></i> Modify</button>";
    $hidden_value="<input type='hidden' name='id_modify' value='$id'>
                   </form>";*/
}else {

    echo"
    <form action='./set/add_user.php' method='post'>
        <div class='form-group'>
            <label class='col-md-2 control-label' for='text-field'>Edit User</label>
            <div class='col-md-10'>
                </br>
            <div class='form-group'>
                <label>User</label>
                <input name='username' class='form-control' $ins placeholder='Username' required type='text'>
            </div>
            <div class='form-group'>
                <label>Password</label>
                <input type='password' name='password' class='form-control' placeholder='Password' required type='text'>
            </div>
            <div class='form-inline'>
                <label>Sysadmin</label>
                <input name='sysadmin' type='checkbox' class='checkbox' $checked>
            </div>
            </br>

            <button class='btn btn-success'><i class='glyphicon glyphicon-plus'></i> Add User</button

</form>

    ";
}
//echo $username;
//echo $ins;


?>





            <br>
            </br>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="categories">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Profile</th>

                </tr>
                </thead>
                <tbody>
                    <?php
                        $query="SELECT * FROM users ORDER BY username";
                        $esegui=mysql_query($query)or die(mysql_error());

                        while ($results = mysql_fetch_array($esegui)) {
                            $id=$results[idusers];
                            $name=$results[username];
                            $prof=$results[profile];
                            if($prof == "1"){
                                $ec_prof="Simple";
                            }else $ec_prof="SysAdmin";

                            if ($name == "admin"){
                                continue;
                            }

                            echo "<tr>";
                            echo "<td>";
                            echo "<a href='./root.php?p=user&mod=$id'>";
                            echo "<i class='glyphicon glyphicon-pencil'></i></a> $name</td>";
                            echo "<td>$ec_prof</td>";

                        };
                    ?>
                </tbody>
            </table>




         </div>
    </div>
