<?php
session_start();
//se non c'è la sessione registrata
if ($_SESSION["autorizzato"] != "1") {
echo "<h1>Restricted Area, Access Denied.</h1>";
echo "For Login Click <a href='/homemade'></a>";
die;
}

//Altrimenti Prelevo il codice identificatico dell'utente loggato
session_start();
$cod = $_SESSION['cod']; //id cod recuperato nel file di verifica
$id_log=$_SESSION['idusers'];
$profile=$_SESSION['profile'];






//Sezione Funzioni

//Controllo cartella piena
function isDirEmpty($dir)
{
    $content=Array();
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".."){
            $content[] = $entry;
        }
    }
    closedir ($handle);
    if(count($content)>0)
    {
        return true;
    }
    else
    {
        return false;
    }
};

//Funzione estensione
// PHP file extension
// una funzione per ricavare l'estensione di un file partendo dal filename completo
function file_extension($filename) {
    $ext = explode(".", $filename);
    return $ext[count($ext)-1];
}

// Esempio di utilizzo:
//echo file_extension('immagine.jpg'); // Restituisce: jpg



?>