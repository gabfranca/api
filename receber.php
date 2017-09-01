<?php

$request_body = file_get_contents('php://input');
$json = json_decode($request_body);

echo json_encode($json, JSON_PRETTY_PRINT); 

?>