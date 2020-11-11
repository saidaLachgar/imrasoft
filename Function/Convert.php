<?php 
 
//1st increase the max of execution time in php.ini search for max_execution_time then set value 300 to 0 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('MAX_EXECUTION_TIME', '-1');

function PDFtoTIF($path)
{
    //put all directory to an array
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    $files = array(); 
    foreach ($rii as $file) {
        if ($file->isDir()){ 
            continue;
        }
        $files[] = $file->getPathname();
    }
    //loop for get path from array > $files[]
    for ($i=0; $i<count($files); $i++) 
    { 
        //condition for get path of only pdf files
        if(strtolower(pathinfo($files[$i],PATHINFO_EXTENSION))=="pdf")
        { 
            $FullPath= $files[$i];            //Full path of file
            $FilePath=dirname($FullPath);     //directory of file
            $FN= basename($files[$i], ".pdf");//file name
            $FNwithExt= basename($files[$i]); //file name with extension (.pdf) 

            //location of tiff + Name of it + extension (.tif)
            $tif = $FilePath."\\".$FN.".tif"; 
            //pdf wich we want to convert it
            $pdf = $FullPath; 
            //cmd of coverting using ghostscript
            $pdf2tif = "C:\gs\bin\gswin64c.exe -dNOPAUSE -r300 -sDEVICE=tiffscaled24 -sCompression=lzw -dBATCH -sOutputFile=\"$tif\" \"$pdf\" 2>&1"; 
            //execute it using  shell_exec = cmd prompt 
            shell_exec($pdf2tif);
        }
    }
}

function TIFtoTXT($path)
{
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    $files = array(); 
    foreach ($rii as $file) {
        if ($file->isDir()){ 
            continue;
        }
        $files[] = $file->getPathname();
    }

    for ($i=0; $i<count($files); $i++) 
    { 
        if(strtolower(pathinfo($files[$i],PATHINFO_EXTENSION))=="tif")
        { 
            $FullPath= $files[$i];
            $FilePath=dirname($FullPath);
            $FileName= basename($files[$i], ".tif");
            $FNwithExt= basename($files[$i]); 

            //location of text + Name of it
            $text = $FilePath."\\".$FileName;
            //tif wich we want to convert it
            $tif = $FullPath;          
            //cmd of coverting using ghostscript      
            $tif2txt = "\"C:\OCR\\tesseract\" \"$tif\" \"$text\" -l fra  2>&1";
            //execute it using  shell_exec
            shell_exec($tif2txt);
        }
    }
}
// echo "<br>";
try 
{
    PDFtoTIF("C:\inetpub\wwwroot\GED\CodeGed\\");//path where pdf files existe
} 
catch (Exception $e) 
{
    echo $e;
}
finally
{ 
    TIFtoTXT("C:\inetpub\wwwroot\GED\CodeGed\\");//path where tiff files existe
}            


header("Location:../Parametres.php");




















/* ------------------------------------------------------------------ 
$tif = "file.tif";
$pdf = "file.pdf";
$pdf2tif = "C:\gs\bin\gswin64c.exe -dNOPAUSE -r300 -sDEVICE=tiffscaled24 -sCompression=lzw -dBATCH -sOutputFile=$tif $pdf  2>&1"; 
shell_exec($pdf2tif);



$tif2txt = '"C:\OCR\tesseract" file.tif out -l fra  2>&1'; 
shell_exec($tif2txt);

*/
// ---------------------------------------------------------------------
// -----> "C:\OCR\tesseract" out6.tif out6 -l fra


// convert -density 300 "file.pdf"  "out0.tiff" 
// C:\gs\bin\gswin64c.exe -dNOPAUSE -r300 -sDEVICE=tiffscaled24 -sCompression=lzw -dBATCH -sOutputFile=out1.tif file.pdf 
// C:\gs\bin\gswin64c.exe -sDEVICE=tiff24nc -sCompression=lzw -r300x300  -dNOPAUSE -sOutputFile="out4.tif" file.pdf
// $v=var_dump()
// $output=shell_exec($cmd);
// echo "<pre>$output</pre>";

// $v=var_dump(shell_exec('magick -density 300 "'.$dir2.'\\'.$fileInfo->getFilename().'"  "'.$dir2.'\\'.str_replace(".pdf","",$fileInfo->getFilename()).'.tiff"'));  
?>
