<?php
    
  $url = 'http://localhost:8081/ApiRest/article/';
  $data = array('title' => 'mr', 'description' => 'Alternance', 'published' => '1');

  // utilisez 'http' même si vous envoyez la requête sur https:// ...
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) { /* Handle error */ }

  var_dump($result);
?>