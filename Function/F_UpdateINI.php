<?php

    $ini=$_POST['ini'];
    if (isset($ini))
    {
        if(var_dump(file_put_contents( '../assets/ini/Config.ini', $ini)))
        {
	        header('Location: ../Parametres.php');
	        exit();
        }
        else
        {
        	$_SESSION["ErreurUpdateini"]= '<div class="alert alert-warning alert-dismissible fade show">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span>
                            <b> Warning - </b> Fichier vide </span>
                        </div>';
	        header('Location: ../Parametres.php');
	        exit();
        }
    }
    else
    {
    	$_SESSION["ErreurUpdateini"]= '<div class="alert alert-danger alert-dismissible fade show">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span>
                            <b> Danger - </b> Erreur inconu </span>
                        </div>';
        header('Location: ../Parametres.php');
        exit();
    }

