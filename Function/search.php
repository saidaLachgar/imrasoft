<?php
 

  $selected_value = $_POST['selected_value'];
  $text = $_POST['text'];
  $url = $_GET['url'];


  if($selected_value==1){
  	header("Location:../Users.php?text=".$text);
  }
   elseif($selected_value==2){
  	header("Location:../Company.php?text=".$text);
  }
   elseif($selected_value==3){
  	header("Location:../code.php?text=".$text);
  }
  else{
  	header("Location:". $url);
  }