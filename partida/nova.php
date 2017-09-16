<?php

header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php';
 require '../funtions.php';
 require '../classes.php';

 $codigo = $_GET['id'];
 $sessao = getSessao($codigo);
 $token = getToken($codigo,$sessao);


 if ($sessao>0) {
   $token = array('TokenPartida' => $token );
  jsonResult('true', $token, "Token Gerado com sucesso!");
 }
 else
 {
     jsonResult('true', $token, "Usuário não está conectado, não é possível iniciar uma nova partida!");
 }
?>
