<?php

$db = parse_ini_file("../assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "UID" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo); 

$check_list= $_POST['check_list'];
$folder=$_POST['folder']; 


$QuDEL= "DELETE from Hide where folder='".$folder."'";
$RsDel = sqlsrv_query($con, $QuDEL);
if( $RsDel === false )
{
    die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}   

foreach($_POST['check_list'] as $IdUSER) 
{
    $query1= "insert into Hide values(".$IdUSER.",'".$folder."')";
    $result1 = sqlsrv_query($con, $query1);   

     if( $result1 === false )
    {
            die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
    }   
}



header("Location:".$_POST['CurrentPage']."");
exit();