<?php
$params = 'action=results&pagesize=10';
if(isset($_GET['zip'])) {
    $zip = '&zip=' . $_GET['zip'];
    $params .= $zip;
}
if(isset($_GET['lat'])) {
    $lat = '&lat=' . $_GET['lat'];
    $params .= $lat;
}
if(isset($_GET['lng'])) {
    $lng = '&long=' . $_GET['lng'];
    $params .= $lng;
}
if(isset($_GET['brand'])) {
    $brand = '&brand=' . rawurlencode($_GET['brand']);
    $params .= $brand;
}

if(isset($_GET['category2'])) {
    $category2 = '&category2=' . rawurlencode($_GET['category2']);
    $params .= $category2;
}

if(isset($_GET['storeType'])) {
    $storeType = '&storeType=' . rawurlencode($_GET['storeType']);
    $params .= $storeType;
}

if(isset($_GET['distance'])) {
    $distance = '&distance=' . rawurlencode($_GET['distance']);
    $params .= $distance;
}

if(isset($_GET['page'])) {
    $page = '&page=' . rawurlencode($_GET['page']);
    $params .= $page;
}

$custID = 'BRH';
$secret = '6C8096B1DB06BRH2A5A73B2B7FD';
//$parms = 'action=results&zip=' . $zip . '&brand=' . $brandE . '&pagesize=10';
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
echo $json;
