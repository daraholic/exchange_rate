<?php
$content=file_get_contents('https://tw.rter.info/capi.php');
$currency=json_decode($content);
foreach($currency as $key => $val){
    echo $key."=".$val->Exrate."<br>";
}

?>

