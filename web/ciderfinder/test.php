<?php
$params = 'action=results&pagesize=40';
//if(isset($_GET['zip'])) {
    $zip = '&zip=22932';
    $params .= $zip;
//}

//if(isset($_GET['brand'])) {
    $brand = '&brand=' . rawurlencode('apple');
    $params .= $brand;
//}

//if(isset($_GET['miles'])) {
    $miles = '&miles=20';
    $params .= $miles;
//}

echo "Params are: " . $params;

$brand = $_GET['brand'];
$brandE = rawurlencode($brand);
$custID = 'BRH';
$secret = '6C8096B1DB06BRH2A5A73B2B7FD';
$parms = 'action=results&zip=' . $zip . '&brand=' . $brandE . '&pagesize=10&miles=5';
date_default_timezone_set('GMT');
$stamp = date("D, j M Y H:i:00 T", time());
$url = "https://www.vtinfo.com/PF/product_finder-service.asp";
$sigString = $stamp . $secret . $params . $custID;
$sigHash = hash('sha256',$sigString);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url .'?'. $params);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'vipCustID: '. $custID,
'vipTimestamp: '. $stamp,
'vipSignature: '. $sigHash
));
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
'action' => 'results'
));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
//execute post
$result = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($result);
$json = json_encode($xml);

//echo $json;
echo '<pre>';
print_r($xml);
echo '</pre>';
