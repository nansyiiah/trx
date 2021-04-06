<?php
date_default_timezone_set("Asia/Jakarta");
$username = "nohpmu";
$password = "passwordmu";
$wallet = "Wallet Trx mu";
$jumlah = "Jumlah maksimal wd mu";
echo "Getting Started to Withdraw your balance\n";
while(true){
    if (time() == strtotime(date('Y-m-d').'00:01')) {
        $headers = array();
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';

        $gas = curl('https://e.trx-trading.com/m/login.php?action=1', 'username='.$username.'&pass='.$password.'', $headers);
        echo "Login sukses\n";
        sleep(1);

        $cookie = curl('https://e.trx-trading.com/m/index.php', null, null);
        $session = ($gas[2]['PHPSESSID']);

        $headers3 = array();
        $headers3[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0';
        $headers3[] = 'Cookie: stylesheet2=; PHPSESSID='.$session.'';

        $profile = curl('https://e.trx-trading.com/m/my.php', null, $headers3);
        $welcome = get_between($profile[1], '<p class="mb-1" style="font-size:20px">', '</p>');
        $balance = get_between($profile[1], '<p style="font-size:20px">', '</p>');
        $total_deposit = get_between($profile[1], '<h6 class="mb-1">TRX Deposit quantity：<span class="text-success">', '</span>');
        echo $welcome."\n".$balance."\n".'Total Deposit : '.$total_deposit."\n";

        $withdraw = curl('https://e.trx-trading.com/ajax/txok.php?tbnum='.$jumlah.'&qbaddress='.$wallet.'&safepwd='.$password.'', null, $headers3);
        echo $withdraw[1]."\n";
    }
}
function curl($url,$post,$headers)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = curl_exec($ch);
	$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
	$cookies = array();
    foreach($matches[1] as $item) {
	  parse_str($item, $cookie);
	  $cookies = array_merge($cookies, $cookie);
	}
	return array (
	$header,
	$body,
	$cookies
	);
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
