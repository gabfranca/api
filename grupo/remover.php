<?php

header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php';
 require '../funtions.php';

 $request_body = file_get_contents('php://input');
//$json = json_decode($request_body, true);
$id = $_GET['id'];
 //$codigo = $json[0]->id;

$result = removerGrupo($id);

?>
