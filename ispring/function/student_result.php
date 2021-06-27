<?php
require_once ( __DIR__ . '/../sitedef.php');

$URL='api-learn.ispringlearn.com/learners/modules/results';
$ch = curl_init();
$header = array(
    "X-Auth-Account-Url: $ispring_auth_url",
    "X-Auth-Email: $ispring_auth_email",
    "X-Auth-Password: $ispring_auth_pass"
  );

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$response =curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($response);

$xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
$array1 = $xml_array['results']['result'];


?>