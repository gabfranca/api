<?php

header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php'; 
 require '../funtions.php'; 

 $request_body = file_get_contents('php://input');
 $json = json_decode($request_body, true); 
$sql = 'delete from grupo where cdGrupo = ';

 //$codigo = $json[0]->id;
 //echo $codigo;
 //$nome = $json[0]->nm_grupo;
 //echo json_encode($json, JSON_PRETTY_PRINT);
$result = removerGrupo($json);



?>