<?php
$baseUrl = 'https://mirrormatellc.myshopify.com/admin/';
    //ini_set('memory_limit', '2048M'); // or you could use 1G
   // ini_set('max_execution_time', 0);
//ini_set('memory_limit', '-1');
set_time_limit(0); 

$username = 'a7acdbe5d4d00f7537f7292aa226df09';
$password = '69e8f92992dbb9056c994d882066aa6d';
$url1 = $baseUrl.'orders/count.json?status=any';
$total = __curl($url1,$username,$password);
$blankTagsArr = array();
$tvalue = $total->count/250;
$a=0;
for($i=1 ; $i<=ceil($tvalue); $i++){
    $url = $baseUrl.'orders.json?status=any&limit=250&page='.$i;
    $r1 = __curl($url,$username,$password);
    $r2 = $r1->orders;
   
    for($j=0;$j<=count($r2)-1;$j++){
      if($r2[$j]->tags == '')
        $a = $a+1;
       array_push($blankTagsArr,$r2[$j]); 
    }
   
}
//echo $a;die;
echo "<PRE>";print_r($blankTagsArr);die;    
//echo "<PRE>";print_r(count($blankTagsArr));die;

function __curl($url,$username,$password){
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST') );
    //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);
    $responseArr = json_decode($response);

    return $responseArr;
}

?>