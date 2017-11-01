<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $qt_equipes = $_GET['qt'];
 $grupo = $_GET['grupo'];
 $sessao = getSessao($codigo);
 $token = getTokenPartida($codigo,$sessao);
 $responseMessage = "";
 if ($sessao>0) {
  
  $result = partidaAndamento($codigo); 
  if($result)
  {
    $token = $result[0]["token"];
    $responseMessage="Você já possui uma partida em andamento! Continue com esta ou encerre para criar uma nova partida.";
  }
  else
  {
   criaNovaPartida($token, $codigo,$qt_equipes, $grupo);
   $responseMessage="Token Gerado com sucesso!";
  }

  $json = '{ "sucess":"true", "token_partida":"'.$token.'", "message": "'.$responseMessage.'"}';
  echo $json;
 }
 else
 {
   $responseMessage="Usuário não esta conectado! Não foi possível criar uma nova partida.";
  $json = '{ "sucess":"false", "token_partida":"[]", "message": '.$responseMessage.'}';
 }
?>
