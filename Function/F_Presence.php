<?php
    session_name('SESSION');
    session_start();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    $prs=(int)$_GET['prs'];
    $id=(int)$_GET['id'];

  $query1 = sqlsrv_query( $con, "select * from users where IdUSER=".$id."");//users
    if( sqlsrv_num_fields( $query1 ) )
    {
      while( $row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC ) )
      {
        $NomUSER= $row1['NomUSER'];
        $PrenomUSER= $row1['PrenomUSER'];
      }
    }

if($prs == 0)
    {
    $query= "UPDATE USERS SET ActiveUSER=1 WHERE IdUSER='".$id."'";
    $result = sqlsrv_query($con, $query);
  
    $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." activer le compte du collaborateur ".$NomUSER." ".$PrenomUSER."','Users.php?text=".$NomUSER."',4)"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        die('<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>');
    }

    header("Location:../Users.php");
    exit(print_r( sqlsrv_errors(), true));    
    }
elseif ($prs == 1){
    $query= "UPDATE USERS SET ActiveUSER=0 WHERE IdUSER='".$id."'";
    $result = sqlsrv_query($con, $query); 

    $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'Vous avez désactiver le compte du collaborateur ".$NomUSER." ".$PrenomUSER."','Users.php?text=".$NomUSER."',4, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        die('<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>');
    }       
    header("Location:../Users.php");
    exit(print_r( sqlsrv_errors(), true));    
}
else{
    die(print_r( sqlsrv_errors(), true));
}
header("Location:../Users.php");
exit;