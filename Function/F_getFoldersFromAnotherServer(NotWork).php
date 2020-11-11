<?php

	$db = parse_ini_file("../assets/ini/Config.ini");
	$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
	$con = sqlsrv_connect($db['host'], $connectionInfo);    
	
	$cmd ="SELECT LibelleSociete FROM Societe";
	$query = sqlsrv_query( $con, $cmd );	
	if( $query === false )
	{
        exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
	}

 
try
{  



//------------------------------------------------------
    // \\192.168.1.250\Users\Administrateur\Dropbox\GED -CODES 


$directory = '..\CodeGed';
$results_array = array();
if (is_dir($directory))
{
    if ($handle = opendir($directory))
    {
        //Notice the parentheses I added:
        while(($file = readdir($handle)) !== FALSE)
        {
                $results_array[] = $file;
        }
        closedir($handle);
    }
}
foreach($results_array as $value)
{
	if ($value == "." || $value == "..") {
		continue;
	}
    echo $value . '<br />';
}

// //------------------------------------------------------
// 		$mystring =$row['LibelleSociete'];
// 		$find   = "'";
// 		$pos = strpos($mystring, $find);
// 		if ($pos != false) {
// 		    $Nom =str_replace("'","\'",$mystring);
// 		} 


//     	 $folder = ECF;
//     	 $Path='code/'.$mystring.'/2019/'.$folder ;

// 		if (!file_exists($Path))
// 		{
// 		    mkdir($Path, 0777, true);
// 		    echo 'done!';
// 		}

//------------------------------------------------------

} 
catch(Exception $e)
{
     echo $e->getMessage();   
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// function filesInDir($tdir)
// {
//  echo ("<p><h1>List of files in ($tdir):</h1></p><hr><br />");
//         $dirs = scandir($tdir);
//         foreach($dirs as $file)
//         {
//                 if (($file == '.')||($file == '..'))
//                 {
//                 }
//                 elseif (is_dir($tdir.'/'.$file))
//                 {
//                         filesInDir($tdir.'/'.$file);
//                 }
//                 else
//                 {
//                         echo $tdir.'/'.$file.' ---  '.date("F d Y H:i:s", filemtime('$file'))."<br>";
//                 }
//         }
// }

// filesInDir('192.168.1.250\Users');

// $dir1 = scandir("\\\\192.168.1.250\\Users\\");
// var_dump($dir1);

// $dir2 = scandir('\\\\192.168.1.250\\Users\\');
// var_dump($dir2);

// $dir3 = scandir("//192.168.1.250/Users/");
// var_dump($dir3);

// $dir4 = scandir("//192.168.1.250/Users/");
// var_dump($dir4);

// $isFolder = is_dir("192.168.1.250:/Users");
// var_dump($isFolder); //FALSE

// $files = scandir('\\192.168.1.250\\Users');
// var_dump($files);
	
// $files = scandir("\\192.168.1.250\Users");
// var_dump($files);

