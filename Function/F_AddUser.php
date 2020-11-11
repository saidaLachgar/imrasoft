
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    
    // --NomUSER2  PrenomUSER2  EmailUSER2  TelephoneUSER2  LoginUSER2  PassUSER2  CompteUSER2 ActiveUSER2 ConnectedUSER2
$NomUSER=$_POST['NomUSER2'];
$PrenomUSER=$_POST['PrenomUSER2'];
$EmailUSER=$_POST['EmailUSER2'];
$TelephoneUSER=$_POST['TelephoneUSER2'];
$LoginUSER=$_POST['LoginUSER2'];
$PassUSER=$_POST['PassUSER2'];
$CompteUSER=$_POST['CompteUSER2'];
$ConnectedUSER=0;
if(isset($_POST['ActiveUSER2'])) {

	 $ActiveUSER2=$_POST['ActiveUSER2'];

}else{

	 $ActiveUSER2=0;
}
 
        $query0 = "SELECT * FROM USERS WHERE LoginUSER='".$LoginUSER."'";
        $result0 = sqlsrv_query($con, $query0);        

        $query1 = "SELECT * FROM USERS WHERE EmailUSER='".$EmailUSER."'";
        $result1 = sqlsrv_query($con, $query1);        

        if(sqlsrv_has_rows($result0) >= 1)
        {
           $_SESSION["ErreurLogin"]=  "* Le nom ".$LoginUSER." est déjà utilisé. S'il vous plaît essayer un autre nom";
           header('Location: ../Ajouter.php');
           exit; 
        }elseif(sqlsrv_has_rows($result1) >= 1){
            $_SESSION["ErreurLogin"]=  "* Cet email est déjà utilisé";
           header('Location: ../Ajouter.php');
           exit; 
        } 
        else 
        {       
            $query2= "insert into USERS values('$NomUSER','$PrenomUSER','$EmailUSER','$TelephoneUSER','$LoginUSER','$PassUSER','$CompteUSER',$ActiveUSER2,$ConnectedUSER,'Defualt.png',0)";
        	$result2 = sqlsrv_query($con, $query2);        
                
             if( $result2 === false )
            {
                    die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
            }

    $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." ajouter le collaborateur ".$NomUSER." ".$PrenomUSER."','Users.php?text=".$NomUSER."',2, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        die('<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>');                           
    }  
        }

    header("Location:../Users.php");
    exit();    
 



