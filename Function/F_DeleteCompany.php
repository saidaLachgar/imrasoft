<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
 // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville 
    $LibelleSociete=$_GET['NOM'];
    $id=$_GET['id'];
    $query= "DELETE FROM Societe WHERE IdSociete='$id'";
    $result = sqlsrv_query($con, $query);


function removeDirectory($path) {
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    return;
}

removeDirectory('../CodeGed/'.$LibelleSociete);


 $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." supprimer la société ".$LibelleSociete."','#',1, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
    }

    header("Location:../Company.php");
    exit();    
