<?php
$data = "";
$filename = "./uploads/chk.bin";
$lines = array();
$fp = fopen($filename, "r");

if(filesize($filename) > 0){
    $content = fread($fp, filesize($filename));
    $lines = explode("\n", $content);
    echo "<pre>";
    print_r($content);
    echo "</pre>";
    fclose($fp);
}
echo "<pre>";

print_r ($lines);
echo "</pre>";
// Removing last empty line of BIN file.
foreach ($lines as  $key=> $value) {
    if(ord($lines[$key]) == 0){
        unset($lines[$key]);
    }
}

$EE_CHK_SUM = ",";
foreach ($lines as $key => $value) {
    $rowData = explode(" ", $value);
    foreach ($rowData as $element => $FourDgtHex) {
        $HEX = str_split($FourDgtHex,2);
        
        //$EE_CHK_SUM .= ",".hexdec($HEX[0]).",".hexdec($HEX[1]);
        
        //echo (gettype($FourDgtHex)) ;
    }
    
}


$writeData = $_GET['mal'];
file_put_contents("./uploads/01675702741-D.txt",$writeData);
echo "<pre>";
print_r($writeData );
echo "</pre>";




?>