<?php date_default_timezone_set("Asia/Taipei");
function exchange($from,$to){
    if($from==$to){
        $rate=1; //幣別相同匯率=1
        // echo "<br>";
        // echo date("Y-m-d H:i:s");
        $result=array('exchange_rate'=>$rate,'updated_at'=>date("Y-m-d H:i:s"));//取現在時刻
        // echo json_encode($result);
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
        
        // echo round($rate,2); 
        // echo "<br>";
        // $date->modify("+8 hours");
        // echo $date->format("Y-m-d H:i:s");

        $result=array('exchange_rate'=>round($rate,2),'updated_at'=>$date->format("Y-m-d H:i:s"),);
    }
    return json_encode($result);

}
echo exchange('JPY','TWD');

?>

