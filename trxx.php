<?php
$reff = "reff nte";

while(true){
    for($i = 0; $i <2; $i++){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://e.trx-trading.com/m/reg.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch , CURLOPT_POST , 1);
curl_setopt($ch , CURLOPT_POSTFIELDS , 'action=1&tjrname='.$reff.'&username=81770'.rand(000000, 999999).'&pass=kontolgoreng&pass1=kontolgoreng');
curl_setopt($ch, CURLOPT_PROXY, "http://127.0.0.1:9150/");
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: e.trx-trading.com';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Origin: https://e.trx-trading.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Referer: https://e.trx-trading.com/m/reg.php?t='.$reff.';
$headers[] = 'Accept-Language: id-ID,id;q=0.9';
$headers[] = 'Cookie: stylesheet2=';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);
    if (preg_match('#100trx has been sent to you.#', $result) > 0){
        echo "Sukses regis";
        }else{
            preg_match('#<script>(.*?)</script>#', $result, $response);
            print_r($response);
        }
        echo "\n";
        sleep(15);
    }
}

function get_between($string, $start, $end) 
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
?>
