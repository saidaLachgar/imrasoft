
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    
    // --NomUSER2  PrenomUSER2  EmailUSER2  TelephoneUSER2  NomUSER2  PassUSER2  CompteUSER2 ActiveUSER2 ConnectedUSER2

$EmailUSER=$_POST['EmailUSER'];
$TelephoneUSER=$_POST['TelephoneUSER'];
$NomUSER=$_POST['Nom'];
$PassUSER=$_POST['password2'];
$ConnectedUSER=0;

        $query = "SELECT * FROM USERS WHERE EmailUSER='".$EmailUSER."'";
        $result = sqlsrv_query($con, $query);
        
        if($result === false)
        {
          $_SESSION["Erreur"]= print_r( sqlsrv_errors(), true);
          header('Location: ../login2.php');
          exit; 
        }

        if(sqlsrv_has_rows($result) >= 1) 
        {
           $_SESSION["Erreur"]=  "Cet email est déjà utilisé";
           header('Location: ../login2.php');
           exit; 
        } 
        else 
        {       
            $query= "insert into USERS values('$NomUSER','Null','$EmailUSER','$TelephoneUSER','Null','$PassUSER','Null',0,$ConnectedUSER,'Defualt.png',1)";
        	$result = sqlsrv_query($con, $query);        
                
             if( $result === false )
            {
                    die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
            }

    $NotificationsQuery= "insert into Notifications ([from],CompteUSER,[Message],Url,Icon,Date) values(19,'A','Nouvelle demande d''inscription','Requests.php',1,getdate())"; 
    $NotificationsResult = sqlsrv_query($con, $NotificationsQuery);
     if($NotificationsResult === false )
    {
        die('<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$NotificationsQuery.'</pre>');                           
    }  
        }

    header("Location:../login.php");
    exit();    
 



