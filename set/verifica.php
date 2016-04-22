<?php
session_start(); //inizio la sessione
//includo i file necessari a collegarmi al db con relativo script di accesso
include("../connect.php");


//variabili POST con anti sql Injection
$username=mysql_real_escape_string($_POST['username']); //faccio l'escape dei caratteri dannosi
$password=mysql_real_escape_string(md5($_POST['password'])); //sha1 cifra la password anche qui in questo modo corrisponde con quella del db


$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
$ris = mysql_query($query) or die (mysql_error());
$riga=mysql_fetch_array($ris);

/*Prelevo l'identificativo dell'utente */
$cod=$riga['username'];
$id_log=$riga['idusers'];
$profile=$riga['profile'];

/* Effettuo il controllo */
if ($cod == NULL) $trovato = 0 ;
else $trovato = 1;



/* Username e password corrette */
if($trovato === 1) {

    /*Registro la sessione*/
   // session_register('autorizzato');

    $_SESSION["autorizzato"] = 1;

    /*Registro il codice dell'utente*/
    $_SESSION['cod'] = $cod;
    $cod=$_SESSION['cod'] = $cod;
    $id_log=$_SESSION['idusers'] = $id_log ;
    $profile=$_SESSION['profile'] = $profile ;



    /*Redirect alla pagina riservata*/
    echo '<script language=javascript>document.location.href="../root.php?p=dashboard"</script>';



} else {

/*Username e password errati, redirect alla pagina di login*/
    header('Location: /homemade');

}
?>