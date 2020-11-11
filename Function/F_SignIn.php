
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    

$EmailUSER=$_POST['Email'];
$LoginUSER=$_POST['username'];
$PassUSER=$_POST['password'];
$ConnectedUSER=1;
$ActiveUSER2=1;
$CompteUSER='U';
  // --NomUSER2  PrenomUSER2  EmailUSER2  TelephoneUSER2  LoginUSER2  PassUSER2  CompteUSER2 ActiveUSER2 ConnectedUSER2


  
    
 if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['Email']))
    {
        $_SESSION["ErreurLogin"]= "Fill all the fields!";
        header('Location: ../login.php');
        exit; 
    }
        $query = "SELECT * FROM USERS WHERE LoginUSER='".$LoginUSER."'";
        $result = sqlsrv_query($con, $query);
        
        if($result === false)
        {
          $_SESSION["ErreurLogin"]= print_r( sqlsrv_errors(), true);
          header('Location: ../login.php#');
          exit; 
        }

        if(sqlsrv_has_rows($result) >= 1)
        {
           $_SESSION["ErreurLogin"]=  "Le nom ".$LoginUSER." est déjà utilisé. S'il vous plaît essayer un autre nom";
           header('Location: ../login.php');
           exit; 
        } 
        else 
        {                                                  
                $_SESSION['UserLogin']= $LoginUSER;                                       
                $_SESSION['Pass'] = $PassUSER;
                $_SESSION['NomComplet']= $LoginUSER;
                $_SESSION['CompteUSER']= $CompteUSER;
                $_SESSION["ErreurLogin"]= '';    
                $_SESSION['LoginTime'] = time();                                   
                $_SESSION['ConnectedUSER'] = $ConnectedUSER;

                $query1= "insert into USERS(EmailUSER,LoginUSER,PassUSER,CompteUSER,ActiveUSER,ConnectedUSER) values('$EmailUSER','$LoginUSER','$PassUSER','$CompteUSER',$ActiveUSER2,$ConnectedUSER)";
                $result1 = sqlsrv_query($con, $query1);   


                while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){
                    $_SESSION['IdUser']=  $row['IdUser'] ;
                }                      
                header('Location: ../profile.php');
                exit;
            
        }

