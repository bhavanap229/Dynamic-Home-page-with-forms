<?php
echo  "<h2 align='center'>B.Tech Computer Science and Engineering<br>202103103510346<br>Bhavana Patil</h2>";
if(!empty($_GET['file'])){
    $fileName  = basename($_GET['file']);
    $filePath  = "C:\Users\Bhavna\Downloads".$fileName;
    
    if(!empty($fileName) && file_exists($filePath)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($filePath);
        exit;
    }
    else{
        echo "file not exit";
    }
}


