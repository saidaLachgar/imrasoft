<?php

$db = parse_ini_file("../assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "UID" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo); 

$IdUSER= $_GET['IdUSER'];
$IdSOCIETE=$_GET['IdSOCIETE']; 


$queryusercompany = "SELECT * FROM usercompany WHERE IdUSER=".$IdUSER." and IdSOCIETE=".$IdSOCIETE."";
$resultusercompany = sqlsrv_query($con, $queryusercompany);

if( $resultusercompany === false )
{
	die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}   

if(sqlsrv_has_rows($resultusercompany) != 1)
{
	$query1= "insert into usercompany values(".$IdUSER.",".$IdSOCIETE.")";
	$result1 = sqlsrv_query($con, $query1);        
        
     if( $result1 === false )
    {
            die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
    }
}
else
{
	$query2= "DELETE FROM usercompany WHERE IdUSER=".$IdUSER." and IdSOCIETE=".$IdSOCIETE."";
	$result2 = sqlsrv_query($con, $query2);

	 if( $result2 === false )
    {
            die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
    }
}

header("Location: ../UserCompany.php?id=".$IdUSER."");
exit();