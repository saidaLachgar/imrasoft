<?php

$uncpath = "C:\inetpub\wwwroot\GED\Nouveau dossier";
$dh = opendir($uncpath);
echo "<pre>\n";
var_dump($dh, error_get_last());
echo  "\n</pre>";
$directory = 'C:\inetpub\wwwroot\GED\Nouveau dossier';
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
//Output findings
foreach($results_array as $value)
{
    echo $value . '<br />';
}