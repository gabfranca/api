<?php

header('Content-Type:' . "application/json;" );

 require 'config.php';
 require 'connection.php';
 require 'database.php'; 
 require 'funtions.php'; 

 $request_body = file_get_contents('php://input');
 $json = json_decode($request_body); 

 $codigo = $json[0]->cd_usuario;
 $result = encerrarSessao($codigo);

 //echo json_encode($result, JSON_PRETTY_PRINT);

?>