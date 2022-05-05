<?php
$url = "http://localhost:8081/ApiRest/article/1"; // modifier le produit 1
$data = array('title' => 'm1', 'description' => 'estiam', 'published' => '0');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

$response = curl_exec($ch);

var_dump($response);

if (!$response) 
{
    return false;
}
?>