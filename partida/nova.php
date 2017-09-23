<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $qt_equipes = $_GET['qt'];
 $grupo = $_GET['grupo'];
 $sessao = getSessao($codigo);
 $token = getTokenPartida($codigo,$sessao);

 if ($sessao>0) {
  criaNovaPartida($token, $codigo,$qt_equipes, $grupo);
  $token = array('TokenPartida' => $token );
  jsonResult('true', $token, "Token Gerado com sucesso!");
 }
 else
 {
     jsonResult('true', null, "Usuário não está conectado, não é possível iniciar uma nova partida!");
 }
?>
