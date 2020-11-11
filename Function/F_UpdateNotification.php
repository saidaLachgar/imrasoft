
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

$IdNoti=$_GET['IdNoti'];    
$message=$_POST['message'];
$CompteUSER=$_POST['CompteUSER2'];        
              
$query= "Update Notifications set CompteUSER='".$CompteUSER."' ,[Message] ='".$message."' Where IdNoti=".$IdNoti."";
$result = sqlsrv_query($con, $query);        
    
 if( $result === false )
{
        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

        

    header("Location:../UpdateNotification.php");
    exit();    
 



