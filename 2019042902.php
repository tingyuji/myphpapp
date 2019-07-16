<?php
$url = 'https://api.myjson.com/bins';
//$data = '{"id":"lpvz0"}';

$data = array(
    'id' => 'lpvz0'
);

$json = json_encode($data);
echo "<br>";
var_dump($json);
echo "<br>";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length:' . strlen($json)
));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_NOBODY, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
$res = curl_exec($curl);
curl_close($curl);
var_dump($res);