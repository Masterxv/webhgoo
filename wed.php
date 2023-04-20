<?php
function get_data()
{
    
$url = 'http://85.239.231.127:2318/v2/getTraderPositions?encryptedUid=6613434A55FE439321CE8740731C46D5&tradeType=PERPETUAL&timeout=30';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Accept: /';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
    
}

function sendTextMSG($number, $msg, $instance)



{
$number = str_replace("+","","$number");
$msg1 = str_replace(array("\r\n"),'\n', $msg);

$url = 'your api ;link';
$data ="{\n  \"messageData\": {\n    \"to\": \"$number\",\n    \"text\": \"$msg1\"\n  }\n}";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data );

$headers = array();
$headers[] = 'Accept: /';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

curl_close($ch);
return $result;

}
$instance = "your instance key";


$data = json_decode(get_data(), true); // decode the JSON data into a PHP array

$symbol = $data['data'][0]['positions']['perpetual'][0]['symbol'];
$entryPrice = $data['data'][0]['positions']['perpetual'][0]['entryPrice'];
$markPrice = $data['data'][0]['positions']['perpetual'][0]['markPrice'];

$short = $data['data'][0]['positions']['perpetual'][0]['short'];
$long = $data['data'][0]['positions']['perpetual'][0]['long'];
$leverage = $data['data'][0]['positions']['perpetual'][0]['leverage'];

$msg = "Coin - $symbol

Entry Price - $entryPrice
Mark Price - $markPrice

Short - ".($short ? "true" : "false")."
Long - ".($long ? "true" : "false")."
Leverage - $leverage";

  $msg = str_replace(array("\r","\n"),'\n', $msg);
echo sendTextMSG("919701779143", $msg, $instance);




?>
