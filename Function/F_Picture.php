<?php 

session_name('SESSION');
session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

$_SESSION["Erreur"]= '';

 $newfilename= date('dmYHis').str_replace(" ", "",  basename($_FILES["fileToUpload"]["name"]));      
 $target_dir ='../assets/avatar/'; //dir where the file is going to be placed
 $target_file = $target_dir .$newfilename; //path of the file to be uploaded
 $uploadOk = 1;
 $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //holds the file extension of the file

// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION["Erreur"]= ' file already exists.';    
    $uploadOk = 0;
}
// Allow certain file formats
 if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif" && $FileType != "svg" ) {
    echo " only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION["Erreur"]= ' Your file was not uploaded.'.$_SESSION["Erreur"];
    }
     else 
     {// if everything is ok, try to upload file
     
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {            
                $IDcmd = "SELECT * FROM USERS WHERE IdUSER=".$_SESSION['IdUser']."";
                $IDresult = sqlsrv_query($con, $IDcmd);    
                if( $IDresult === false )
              {
                   $_SESSION["Erreur"]= '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '<br/>'.$IDcmd.$IDresult.'</pre>' ;
                   $uploadOk = 0;
               }
               while( $obj = sqlsrv_fetch_object($IDresult))
                {
                   $IdUSER = $obj->IdUSER;                  
                       $query= "UPDATE USERS SET avatar='". $newfilename."'WHERE IdUSER=".$_SESSION['IdUser'].""; 
                        $result = sqlsrv_query($con, $query);
                         if($result === false )
                        {
                            $_SESSION["Erreur"]= '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '<br/>'.$query.'</pre>' ;
                            $uploadOk = 0;
                        }   
                         $_SESSION['Avatar']=$newfilename;                 
                }                                 
        } 
        else 
        {
            $_SESSION["Erreur"]= 'Sorry, there was an error uploading your file.';
        }
    }
 header("Location:../profile.php");    
    exit();
?>