<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);    

$cmd ="SELECT * FROM Code";
$query = sqlsrv_query( $con, $cmd );
if( $query === false )
{
   exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

if( sqlsrv_num_fields( $query ) )
{ echo'
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="far fa-file-pdf"></i> &nbsp; &nbsp;Documents</h3>
            </div>            
          </div> 

          <form method="post" action="code.php">       
          <div class="input-group" style="margin-top: 10px;">
            <div class="input-group-prepend">  
              <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" class="form-control" id="LoginUSER2" name="text" onkeyup="myFunction()" placeholder="Rechercher un numéro de série.." >
          </div>
          </form>

        </div> 
        <div class="table-responsive">
          <table id="myTable" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
              <th scope="col">N° Série</th>
                <th scope="col">SOCIETE</th>
                <th scope="col">Année</th>
                <th scope="col">Produit</th>
                <th scope="col">File Name</th>            
                <th scope="col">Éditeur</th>
                <th scope="col">Temps d\'édition</th>
              </tr>
            </thead>
            <tbody>';
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC ) )
        {
            $IDcmd = "SELECT LibelleSociete FROM Societe WHERE IdSOCIETE ='".$row['IdSOCIETE']."'";
            $IDresult = sqlsrv_query($con, $IDcmd);        
            while( $obj = sqlsrv_fetch_object($IDresult))
            {
                $LibelleSociete = $obj->LibelleSociete;
            }
            $IDcmd = "SELECT NomUSER,PrenomUSER FROM USERS WHERE IdUSER ='".$row['IdUSER']."'";
            $IDresult = sqlsrv_query($con, $IDcmd);        
            while( $obj = sqlsrv_fetch_object($IDresult))
            {
                $NomUSER = $obj->NomUSER;
                $PrenomUSER = $obj->PrenomUSER;
            }
      echo'<tr>
            <td>'. $row['NuSerie'] .'</td>
            <td>'. $LibelleSociete . '</td>            
            <td>'. $row['AnneeCODE'] . '</td>  
            <td>'. $row['ProduitCODE'] . '</td>
            <td><a   target="_blank" style="color:#172b4d;font-weight: 600;" href="./CodeGed/'.$LibelleSociete.'/'. $row['AnneeCODE'].'/'.$row['ProduitCODE'].'/'.$row['FileNameCODE'].'" ><i class="fas fa-search"></i>&nbsp;'.$row['FileNameCODE'].' </a></td>                
            <td>'.$PrenomUSER.' '.$NomUSER. '</td> 
            <td>';
              $filename='CodeGed/'.$LibelleSociete.'/'.$row['AnneeCODE'].'/'.$row['ProduitCODE'].'/'.$row['FileNameCODE'];
              echo date ("F d Y H:i", filectime($filename));
          '</td>           
          </tr>';          
        }
        echo'
          </tbody>
        </table>
      </div>         
    </div>
  </div>
</div>'; 
}
        sqlsrv_close ( $con );       


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
          <br>
          <div class="shadow card mb-3">
          <object data="'.$pdf.'" type="application/pdf" height="500">
              <embed src="'.$pdf.'" type="application/pdf" />
          </object>
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

  ?>
<!--             <iframe class="card-img-top" src="'.$pdf.'" width="100%" height="500"></iframe>
 -->



 <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("LoginUSER2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script> 
<script>
  var text = '<?php echo $_GET['text'];?>'; 
  if (text != '') {
  var filter, table, tr, td, i, txtValue;  
  filter = text.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script> 

<?php require "MasterPage/footer.php"; ?>