<?php date_default_timezone_set("Asia/Taipei");
function exchange($from,$to){
    if($from==$to){
        echo $rate=1; //幣別相同匯率=1
        echo "<br>";
        echo date("Y-m-d H:i:s");
    }else{
        $content=file_get_contents('https://tw.rter.info/capi.php');
        $currency=json_decode($content);
        foreach($currency as $key => $val){
            if($key=='USD'.$to){
                $to_val=$val->Exrate;
                $date=new DateTime("$val->UTC");
            }elseif('USD'.$from==$key){
                $from_val=$val->Exrate;
                $date=new DateTime("$val->UTC");
            }
        }
        $rate=$to_val/$from_val;
        echo round($rate,2); //小數點第二位四捨五入
        echo "<br>";
        $date->modify("+8 hours");
        echo $date->format("Y-m-d H:i:s");
        
    }

}
echo exchange('JPY','TWD');
?>

