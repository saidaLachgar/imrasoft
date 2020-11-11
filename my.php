<?php 
$text="this is my text 1 4 6";
$words = explode(" ", $text);
for ($i=0; $i < count($words); $i++) { 
	echo $words[$i].'<br>';
}
 ?>