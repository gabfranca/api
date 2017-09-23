<?php

header('Content-Type:' . "application/json;" );

 require '../include.php';

 $request_body = file_get_contents('php://input');
 //$json = json_decode($request_body);
 //$codigo = $json[0]->id;

$codigo = $_GET['id'];
 getPgtDesafioById($codigo);

?>
