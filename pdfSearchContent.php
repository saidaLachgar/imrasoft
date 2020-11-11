<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo' 
<form method="post" action="pdfSearchContent.php">
	 <div class="row" style="margin-bottom: 40px;">
	 	<div class="col-12">
	 		<div class="input-group" style="margin-top: 10px;">
	  			<div class="input-group-prepend">  
	    			<span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
	  			</div> 
	  		<input type="text" name="text" class="form-control" placeholder="Search for pdf.." >  
		</div>
	  </div>
	</div>
</form>';

$path="C:\inetpub\wwwroot\Ged\CodeGed\\";

	$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    $files = array(); 
    foreach ($rii as $file) {
        if ($file->isDir()){ 
            continue;
        }
        $files[] = $file->getPathname();
    }
    if(isset($_POST["text"]))
    {
    	$text=$_POST["text"];
    }
    elseif(isset($_GET["text"]))
    {
    	$text=$_GET["text"];
    }

	if(isset($text))
	{
	    for ($i=0; $i<count($files); $i++) 
	    { 
	        if(strtolower(pathinfo($files[$i],PATHINFO_EXTENSION))=="txt")
	        { 
	            $FullPath= $files[$i];
	            $FilePath=dirname($FullPath);
	            $FileName= basename($files[$i], ".txt");
	            $pdf=str_replace("C:\inetpub\wwwroot\Ged\\", "",$FilePath)."\\".$FileName.".pdf";			
				$searchfor =$text;
				// the following line prevents the browser from parsing this as HTML.
				// header('Content-Type: text/plain');
				// get the file contents, assuming the file to be readable (and exist)
				$contents = file_get_contents($FullPath);
				// escape special characters in the query
				$pattern = preg_quote($searchfor, '/');
				// finalise the regular expression, matching the whole line
				$pattern = "/^.*$pattern.*\$/m";
				// search, and store all matching occurences in $matches
				if(preg_match_all($pattern, $contents, $matches))
				{			   
					
					echo'
					<div class="shadow card mb-3">
						<iframe class="card-img-top" src="'.$pdf.'" width="100%" height="500"></iframe>
					  <div class="card-body">
					    <h5 class="card-title"></h5>
					    <p class="card-text">Line: '.implode("  ", $matches[0]).'</p>
					    <p class="card-text"><small class="text-muted">'.$FileName.'</small></p>
					  </div>
					</div>';
				}			            
	        }
	    }
	}

 require "MasterPage/footer.php"; 
 ?>
