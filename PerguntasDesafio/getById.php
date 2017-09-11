<?php

header('Content-Type:' . "application/json;" );

 require '../config.php';
 require '../connection.php';
 require '../database.php'; 
 require '../funtions.php'; 

 $request_body = file_get_contents('php://input');
 //$json = json_decode($request_body); 
 //$codigo = $json[0]->id;
 
$codigo = $_GET['id'];
 getPgtDesafioById($codigo);

?>