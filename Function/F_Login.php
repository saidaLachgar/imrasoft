<?php
    session_name('SESSION');
    session_start ();

if(isset($_SESSION['username'])) { // if already login
   header("location: ../index.php"); // send to home page
   exit; 
}

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "UID" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
    
    $user = $_POST['user'];
    $password = $_POST['pass'];
    $query = null;
 
try
{    
   if (filter_var($user, FILTER_VALIDATE_EMAIL)) 
    {
        $query = "SELECT * FROM USERS WHERE EmailUSER='".$user."'";
    }else{
        $query = "SELECT * FROM USERS WHERE LoginUSER='".$user."'";
  
    }
    $result = sqlsrv_query($con, $query);
    
   
    if(sqlsrv_has_rows($result) != 1)
    {
       $_SESSION["ErreurLogin"]=  "* L’e-mail ou le nom d'utilisateur entré ne correspond à aucun compte.";
       header('Location: ../login.php');
       exit; 
    } 
    else 
    {                  
        while( $obj = sqlsrv_fetch_object($result))
        {            
            $IdUSER= $obj->IdUSER; 
            if ($obj->PassUSER==$password)
            {
                if($obj->ActiveUSER==1)
                    {
                        $_SESSION['UserLogin']= $obj->LoginUSER;                        
                        $_SESSION['IdUser'] = $obj->IdUSER;                        
                        $_SESSION['Pass'] = $obj->PassUSER;
                        $_SESSION['NomComplet']= $obj->NomUSER.' '.$obj->PrenomUSER;
                        $_SESSION['CompteUSER']= $obj->CompteUSER;
                        $_SESSION['Avatar']= $obj->Avatar;
                        $_SESSION["ErreurLogin"]= '';    
                        $_SESSION['LoginTime'] = time();   

                        $sql_Update = "UPDATE USERS SET ConnectedUSER=1 WHERE LoginUSER='".$obj->LoginUSER."'";
                        $stmt = sqlsrv_query( $con, $sql_Update);
                        $_SESSION['ConnectedUSER'] = $obj->ConnectedUSER;                            
                            
                            header('Location: ../index.php');
                            exit;                            
                    }
                    else
                    {
                        $_SESSION["ErreurLogin"]= '* Compte est desactivé';
                        header('Location: ../login.php');
                        exit;
                    }
            }
            else
            {
               $_SESSION["ErreurLogin"]= '* Le mot de passe est incorrect';
                header('Location: ../login.php');
                exit; 
            }
        } 
    } 
                        
} 
catch(Exception $e)
{
    $_SESSION["ErreurLogin"]=  $e->getMessage();
    header('Location: ../login.php');
    exit;
}

