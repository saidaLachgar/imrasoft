<?php 
    session_name('SESSION');
    session_start(); 
    $UserLogin= $_SESSION["NomComplet"];
?>
<!doctype html>
<html>
<head>    
<meta charset="UTF-8">	
<title>GED | LOCK</title>    
<meta name="viewport" content="width=device-width">
    <link rel="icon" href="http://pv.imrasoft.ma/img/imra.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/style2.css">
     <link href="./assets/login/css/material-kit.css?v=2.0.5" rel="stylesheet" />
<style>
	body{
		background-color: white;
	}
	.UserLogin{
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
	    font-weight: 300;    
	    font-size: 30px;
	}
</style>
               
    </head>        
    <body>  
             
	<div class="context">
		<div class="container">
		  <div class="info" style="margin-bottom: 0px;padding-bottom: 0px;">
		    <h1>GED | IMRASOFT</h1><span style="text-transform: uppercase;">INTéGRATEUR DES SOLUTIONS SAGE </span>
		  </div>
		</div>
		<div class="form" style="padding: 0">
		  <img style="width: 166px;height: 211.967px" src="assets/img/brand/s.png"/>
		  <form method="post" action="Function/F_Lock.php" autocomplete="off">			  		
		    <div class="info1"><div class="UserLogin" style="padding-bottom: 0px;padding-top: 40px;"><?= $UserLogin ?></div></div>
		    <div class="form-group bmd-form-group" style="width: 100%;text-align: left;">
	          <label for="password" class="bmd-label-floating">Mot de passe</label>
	          <input id="password" type="password" name="pass" required="" autocomplete="off" class="form-control">
	        </div>
            <h6 style="color:#fb6340;margin-bottom: 0px !important;" class="heading-small mb-4"><?= $_SESSION["ErreurLogin"]?></h6></br>
            <?php unset($_SESSION["ErreurLogin"]); ?>
            <button style="background-image: linear-gradient(138deg, #63b4f2, #7369fd);color: #fff !important;border-radius: 20px;padding: 10px 15px;width: 100px;padding-left: 0px;padding-right: 0px;height: 36px;padding-bottom: 0px;padding-top: 0px;font-size: 13px;" type="submit">Débloquer</button>
		    <p class="message"><a href="Function/F_logout.php" style="text-transform: uppercase;background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Utiliser un autre compte &nbsp;<i class="fas fa-external-link-alt fa-xs"></i></a></p>

		    
		  </form>
		</div>
	</div>    
			
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>    			                                  
        

   <!--   Core JS Files   -->
  <script src="./assets/login/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/plugins/moment.min.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/login/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/login/js/material-kit.js?v=2.0.5" type="text/javascript"></script>

                
    
    </body>
</html>