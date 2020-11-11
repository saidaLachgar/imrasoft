<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    
    $id=$_GET['id'];
   
        
$query1 = sqlsrv_query( $con, "select * from users where IdUSER=".$id."");//users
if( sqlsrv_num_fields( $query1 ) )
{
  while( $row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC ) )
  {
    $NomUSER= $row1['NomUSER'];
    $PrenomUSER= $row1['PrenomUSER'];
  }
}
    $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." supprimer le collaborateur ".$NomUSER." ".$PrenomUSER."','#',1, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);

     if($Historyresult === false )
    {
        die('<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>');                           
    }  
     $query= "DELETE FROM USERS WHERE IdUSER=".$id."";
    $result = sqlsrv_query($con, $query);

    header("Location:../Users.php");
    exit();    
