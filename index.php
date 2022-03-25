<?php
function exchange($from,$to){
    if($from==$to){
        echo $rate=1; //幣別相同匯率=1
    }else{
        $content=file_get_contents('https://tw.rter.info/capi.php');
        $currency=json_decode($content);
        foreach($currency as $key => $val){
            if($key=='USD'.$to){
                $to_val=$val->Exrate;
            }elseif('USD'.$from==$key){
                $from_val=$val->Exrate;
            }
        }
        $rate=$to_val/$from_val;
        echo round($rate,2); //小數點第二位四捨五入
        
    }

}
echo exchange('JPY','TWD');
?>

