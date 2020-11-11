<?php 

  $db = parse_ini_file("assets/ini/Config.ini");  
  $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
  $con = sqlsrv_connect($db['host'], $connectionInfo);
// -------------------------------------
if(empty($_SESSION))
{
  // session_set_cookie_params(0);
    session_name('SESSION');
    session_start();
}
// -------------------------------------
if(!isset($_SESSION['UserLogin'])) 
{
   header("Location: login.php");
   exit;
}    

// -------------------------------------------------------------------------------------------------------Lock
$LoginDuration = 60*15; 
if(isset($_SESSION["UserLogin"])) {  
 
  if(isset($_SESSION['LoginTime']))
  {  
    if((time() - $_SESSION['LoginTime']) >= $LoginDuration)
    { 
      if(basename($_SERVER['REQUEST_URI'])== $db['Folder_Container'])
      {
         $_SESSION['CurrentPage'] ='../index.php';
      }
      else
      {
          $_SESSION['CurrentPage'] ='../'.basename($_SERVER['REQUEST_URI']);           
      }
        // $_SESSION['CurrentPage'] = $_SERVER['PHP_SELF'];
      header("Location: Lock.php"); 
      exit;
    } 
  }
}
// -------------------------------------------------------------------------------------------------------
$query5 = sqlsrv_query( $con, "select count(idUSER) as [count] from users" );
$query6 = sqlsrv_query( $con, "select count(IdSociete) as [count] from Societe" );
$query7 = sqlsrv_query( $con, "select  count(IdCODE) as [count]  from Code" );
$query8 = sqlsrv_query( $con, "select  count(IdUSER) as [count]  from users where Request=1" );
$query9 = sqlsrv_query( $con, "select  count(IdNoti) as [count]  from Notifications where CompteUSER='".$_SESSION['CompteUSER']."'" );
if( sqlsrv_num_fields( $query5 ) )
{
  while( $row5 = sqlsrv_fetch_array( $query5, SQLSRV_FETCH_ASSOC ) )
  {
    $Collaborateur= $row5['count'];
  }
}if( sqlsrv_num_fields( $query6 ) )
{
  while( $row6 = sqlsrv_fetch_array( $query6, SQLSRV_FETCH_ASSOC ) )
  {
    $Société= $row6['count'];
  }
}if( sqlsrv_num_fields( $query7 ) )
{
  while( $row7 = sqlsrv_fetch_array( $query7, SQLSRV_FETCH_ASSOC ) )
  {
    $code= $row7['count'];
  }
}if( sqlsrv_num_fields( $query8 ) )
{
  while( $row8 = sqlsrv_fetch_array( $query8, SQLSRV_FETCH_ASSOC ) )
  {
    $demandes= $row8['count'];
  }
}if( sqlsrv_num_fields( $query9 ) )
{
  while( $row9 = sqlsrv_fetch_array( $query9, SQLSRV_FETCH_ASSOC ) )
  {
    $NotificationsCount= $row9['count']+1;
  }
}
// -------------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
 
<head>  
  <meta charset="UTF-8">
  <link rel="icon" href="assets/img/brand/imra.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GED :: IMRASOFT</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- navbar -->
  <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />
  <!-- Search -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.css" rel="stylesheet"/>  
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <!-- fontawesome -->
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Argon CSS -->
    <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(e){
    $( document ).on( 'click', '.bs-dropdown-to-select-group .dropdown-menu li', function( event ) {
      var $target = $( event.currentTarget );
    $target.closest('.bs-dropdown-to-select-group')
      .find('[data-bind="bs-drp-sel-value"]').val($target.attr('data-value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.bs-dropdown-to-select-group')
        .find('[data-bind="bs-drp-sel-label"]').text($target.context.textContent);
    return false;
      });
    });
    </script>
<style type="text/css">
  #myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
} 
</style>

</head>

<body style="background-color: white !important">     
  <div class="context">
      <!-- Sidenav -->
  <nav data-simplebar data-simplebar-auto-hide="false" class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main" style="z-index: 10000;overflow-y: unset;box-shadow: 0 0 0rem 0 #fff !important;">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button"  data-toggle="modal" data-target="#exampleModal">
        <span class="navbar-toggler-icon"></span>
      </button>
     

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="exampleModalLabel"><a class="navbar-brand pt-0 pb-0" href="./index.php">
        <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Navigation -->
       <div class="row">
         <div class="col-12">
          <div class="row justify-content-center">
              <div class="user-img">
                  <img src="./assets/avatar/<?=$_SESSION['Avatar']?>" alt="user-img" class="rounded-circle img-thumbnail img-responsive" style="width: 87px;height: 87px;">                            
              </div>
          </div>
          <div class="row" style="margin-top: 6px"></div>
          <div class="row justify-content-center">
              <h5 style="color: #98a6ad;"><?=$_SESSION['NomComplet']?></h5>
          </div>
          <div class="row justify-content-center">
              <ul style="list-style: none; display: flex; padding-left:0px">                                              
                  <li>
                      <a href="profile.php">
                          <i class="fas fa-cog" style="color:rgba(0, 0, 0, .5)" onMouseOver="this.style.color='#71b6f9'"onMouseOut="this.style.color='rgba(0, 0, 0, .5)'"></i>
                      </a> 
                  </li>
                  <li>
                      <a href="Function/F_Logout.php">
                        <i class="fas fa-sign-out-alt" style="color:#71b6f9;margin-left: 8px;"></i>
                      </a>
                  </li>
              </ul>
          </div>
          </div>
        </div>                  
        <!-- Heading -->
        <h5 class="navbar-heading text-muted">Navigation</h5>
        <!-- Navigation -->
        <ul class="navbar-nav">
               <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="ni ni-tv-2"></i> Accueil
            </a>
          </li>
         <?php if($_SESSION['CompteUSER']=='A'){?>   
          <li class="nav-item">
            <a class="nav-link" href="Users.php">
              <i class="fas fa-users"></i> Collaborateur &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $Collaborateur ?></span>
            </a>
          </li>  
            <?php }?>
          <li class="nav-item">
            <a class="nav-link" href="Company.php">  
              <i class="fas fa-building"></i> Société &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $Société ?></span>
            </a>
          </li>

          <?php if($_SESSION['CompteUSER']=='I'){?>
            <li class="nav-item">
            <a class="nav-link" style="pointer-events: none;cursor: default;">
              <i class="fas fa-file-pdf"></i> Documents &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: rgba(249, 200, 81, .7);color: white;"><?= $code ?></span>
            </a>
          </li> 
          <?php }else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="code.php">
              <i class="fas fa-file-pdf"></i> Documents &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $code ?></span>
            </a>
          </li> 
          <?php } ?>  
           <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="Requests.php">
              <i class="fas fa-paper-plane"></i> les demandes &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $demandes ?></span>
            </a>
          </li>
           <?php } ?>  
          <li class="nav-item" >
            <a class="nav-link" href="profile.php">
              <i class="fas fa-user"></i> Profile
            </a>
          </li>

           <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="Parametres.php">
              <i class="fas fa-cog"></i> Parametres
            </a>
          </li>
           <?php } ?>  

           <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="CreateNotification.php">
              <i class="fas fa-bell"></i> Notifications
            </a>
          </li>
           <?php } ?>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Links</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="http://pv.imrasoft.ma/" target="_blank">
              <i class="fas fa-file-signature"></i> PV 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://glpi.imrasoft.com/" target="_blank">
              <i class="fas fa-clipboard-check"></i> GLPI
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.imrasoft.ma/" target="_blank">
              <i class="fas fa-globe"></i> Site Web
            </a>
          </li>
        </ul>
      </div>
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>
      <!-- Brand -->
      <a class="navbar-brand pt-0 pb-0" href="./index.php">
        <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>      
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main" style="background-color: #fafafa;">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.php">
                <img src="./assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>       
        <!-- Navigation -->
       <div class="row">
         <div class="col-12">
          <div class="row justify-content-center">
              <div class="user-img">
                  <img src="./assets/avatar/<?=$_SESSION['Avatar']?>" alt="user-img" class="rounded-circle img-thumbnail img-responsive" style="width: 87px;height: 87px;">                            
              </div>
          </div>
          <div class="row" style="margin-top: 6px"></div>
          <div class="row justify-content-center">
              <h5 style="color: #98a6ad;"><?=$_SESSION['NomComplet']?></h5>
          </div>
          <div class="row justify-content-center">
              <ul style="list-style: none; display: flex; padding-left:0px">                                              
                  <li>
                      <a href="profile.php">
                          <i class="fas fa-cog" style="color:rgba(0, 0, 0, .5)" onMouseOver="this.style.color='#71b6f9'"onMouseOut="this.style.color='rgba(0, 0, 0, .5)'"></i>
                      </a> 
                  </li>
                  <li>
                      <a href="Function/F_Logout.php">
                        <i class="fas fa-sign-out-alt" style="color:#71b6f9;margin-left: 8px;"></i>
                      </a>
                  </li>
              </ul>
          </div>
          </div>
        </div>                  
        <!-- Heading -->
        <h5 class="navbar-heading text-muted">Navigation</h5>
        <!-- Navigation -->
        <ul class="navbar-nav">
               <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="ni ni-tv-2"></i> Accueil
            </a>
          </li>
         <?php if($_SESSION['CompteUSER']=='A'){?>   
          <li class="nav-item">
            <a class="nav-link" href="Users.php">
              <i class="fas fa-users"></i> Collaborateur &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $Collaborateur ?></span>
            </a>
          </li>  
            <?php }?>  
          <li class="nav-item">
            <a class="nav-link" href="Company.php">  
              <i class="fas fa-building"></i> Société &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $Société ?></span>
            </a>
          </li>

          <?php if($_SESSION['CompteUSER']=='I'){?>
            <li class="nav-item">
            <a class="nav-link" style="pointer-events: none;cursor: default;">
              <i class="fas fa-file-pdf"></i> Documents &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: rgba(249, 200, 81, .7);color: white;"><?= $code ?></span>
            </a>
          </li> 
          <?php }else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="code.php">
              <i class="fas fa-file-pdf"></i> Documents &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $code ?></span>
            </a>
          </li> 
          <?php } ?>  
           <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="Requests.php">
              <i class="fas fa-paper-plane"></i> les demandes &nbsp;&nbsp;&nbsp; <span class="badge" style="background-color: #f9c851;color: white;"><?= $demandes ?></span>
            </a>
          </li>
           <?php } ?> 
          <li class="nav-item" >
            <a class="nav-link" href="profile.php">
              <i class="fas fa-user"></i> Profile
            </a>
          </li>
          <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="Parametres.php">
              <i class="fas fa-cog"></i> Parametres
            </a>
          </li>
           <?php } ?> 

            <?php if($_SESSION['CompteUSER']=='A'){?>
          <li class="nav-item" >
            <a class="nav-link" href="CreateNotification.php">
              <i class="fas fa-bell"></i> Notifications
            </a>
          </li>
           <?php } ?>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Links</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="http://pv.imrasoft.ma/" target="_blank">
              <i class="fas fa-file-signature"></i> PV 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://glpi.imrasoft.com/" target="_blank">
              <i class="fas fa-clipboard-check"></i> GLPI
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.imrasoft.ma/" target="_blank">
              <i class="fas fa-globe"></i> Site Web
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="content1">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main" >
      <div class="container-fluid" style="background-color: white;margin-top: -16px;">
           

        <div class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex">
        
          <a href="#" onclick="testt()">             
            <span class="profile-text" style="font-size: 13px;"><i class="fas fa-bars" style="margin-left: -30px;background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i></span>
          </a>
          <!-- <div class="clock" style="font: small-caps bold 24px/1 sans-serif;color: rgba(255, 255, 255, .7);"></div> -->
          
        </div>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item ">
            <a  class="nav-link pr-0" href="History.php" role="button" style="margin-right: 11px;">
              <div class="media align-items-center" style="height: 60px;">
               <span class="profile-text" style="font-size: 14px;background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-history"></i>&nbsp; Historique</span>                
              </div>
            </a>            
          </li>        
          <li class="nav-item dropdown" style="border-left: 1px solid rgba(0, 0, 0, .1);padding-left: 6px;border-right: 1px solid rgba(0, 0, 0, .1);padding-right: 6px;margin-right: 10px;">          
            <a href="#" class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;padding-left: 0px;background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="far fa-bell"></i>&nbsp; Notifications</a>              
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-arrow dropdown-menu-right py-0 overflow-hidden" style="top: 33px;box-shadow: 0 50px 100px rgba(50, 50, 93, .1), 0 15px 35px rgba(50, 50, 93, .0), 0 5px 15px rgba(0, 0, 0, .1) !important;">
            <!-- Dropdown header -->
            <div class="px-3 py-3">
              <h6 class="text-sm text-muted m-0">You have <strong class="text-primary"><?= $NotificationsCount ?></strong> notifications.</h6>
            </div>
            <!-- List group -->
            <div class="list-group list-group-flush">

          <?php          
          $Notifications ="SELECT Top 6 * FROM Notifications order by IdNoti desc";          
          $resultNoti = sqlsrv_query( $con, $Notifications );          
          if( $resultNoti === false )
          {
              exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
          }
          if( sqlsrv_num_fields($resultNoti) )
          {           
           while( $rowNoti = sqlsrv_fetch_array( $resultNoti, SQLSRV_FETCH_ASSOC ) )
            {                  
              $USERScmd ="SELECT * FROM USERS where IdUSER= ".$rowNoti['from']."";
              $USERSquery = sqlsrv_query( $con, $USERScmd );        
                   
              if( sqlsrv_num_fields( $USERSquery ) )
              {             
                  while( $rowUser = sqlsrv_fetch_object($USERSquery))
                  {                        
                    $NomUSER= $rowUser->NomUSER; 
                    $PrenomUSER= $rowUser->PrenomUSER; 
                  } 
              }
              if($_SESSION['CompteUSER']==$rowNoti['CompteUSER'] or $_SESSION['CompteUSER']=="A" )
              {
                echo '       
                 <a href="'.$rowNoti['Url'].'" class="list-group-item list-group-item-action">
                  <div class="row align-items-center">                  
                    <div class="col ml--2">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h4 class="mb-0 text-sm">'.$NomUSER." ".$PrenomUSER.'</h4>
                        </div>
                        <div class="text-right text-muted">
                          <small>';

                        $today = date("Y-m-d");                      
                        if ($today != $rowNoti['Date']->format('Y-m-d')) 
                        {
                          echo $rowNoti['Date']->format('F j, g:i a');
                        }
                        else
                        {
                          echo $rowNoti['Date']->format('g:i a');
                        } 
                          echo'</small>
                        </div>
                      </div>
                      <p class="text-sm mb-0">'. $rowNoti['Message'].'</p>
                    </div>
                  </div>
                </a>';
              }
            }
          }
        ?>
              <a href="#!" class="list-group-item list-group-item-action">
                <div class="row align-items-center">                  
                  <div class="col ml--2">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h4 class="mb-0 text-sm">Imrasoft :: GED</h4>
                      </div>
                      <div class="text-right text-muted">
                        <small></small>
                      </div>
                    </div>
                    <p class="text-sm mb-0">Salut! Merci de votre inscription 😊 </p>
                  </div>
                </div>
              </a>             
            </div>
            <!-- View all -->
            <a href="Notifications.php" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
          </div>
          </li>
          <li class="nav-item ">
            <a  class="nav-link pr-0" href="#" role="button" style="padding-left: 0px;">
              <div class="media align-items-center" style="height: 60px;">
               <span data-toggle-fullscreen class="profile-text" style="font-size: 14px;background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-expand"></i> &nbsp; Plein écran</span>                
              </div>
            </a>            
          </li>                       
        </ul>
      </div>
    </nav>
 
    <!-- Header -->
    
      <div class="container-fluid" >
        <div class="header-body" style="padding-top: 13%;">
