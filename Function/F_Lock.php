<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "UID" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
        
   echo $password = $_POST['pass'];
   echo $pass =  $_SESSION['Pass'];
try
{    
    if(empty($_POST['pass']))
    {
        $_SESSION["ErreurLogin"]= "Fill all the fields!";
        header("Location: ../Lock.php?UserLogin=".$_SESSION['UserLogin']."");
        exit; 
    }
    else
    {                                                   
       if ($pass == $password)
        {                                                                       
            $_SESSION["ErreurLogin"]= '';    
            $_SESSION['LoginTime'] = time();                                                      
            header('Location: '.$_SESSION['CurrentPage'].'');
            exit;
        }                                    
        else
        {
           $_SESSION["ErreurLogin"]= 'Le mot de passe est incorrect';
            header("Location: ../Lock.php?UserLogin=".$_SESSION['UserLogin']."");
            exit; 
        }
    } 
}            
catch(Exception $e)
{
    $_SESSION["ErreurLogin"]=  $e->getMessage();
    header("Location: ../Lock.php?UserLogin=".$_SESSION['UserLogin']."");  
    exit;
}

