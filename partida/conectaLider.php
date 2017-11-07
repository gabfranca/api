<?php

 header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $tokenPartida = $_GET['tokenPartida'];
 $nmEquipe = $_GET['nmEquipe'];
 $sessao = getSessao($codigo);
 $token = getTokenEquipe($codigo,$sessao);
 $responseMessage = "";

 $nmJogador = getNomeUsuario($codigo);
 if ($sessao>0)
 {
$retorno = validaLider($codigo, $tokenPartida );
    if ($retorno) {
      $token = $retorno[0]['token_equipe'];
      $responseMessage="Este usuário já esta conectado como líder em uma partida em andamento!";
      $json = '{ "sucess":"true", "token_equipe":"'.$token.'", "message": "'.$responseMessage.'"}';
      echo $json;
      return;
    }

   $sql = "select * from partida where token = '{$tokenPartida}' and andamento = 1";
   $result =  DataReader($sql);
   if ($result)
   {
     criaNovaEquipe($nmEquipe, 500, $tokenPartida, $token, $codigo);
     conectaJogador($codigo, $nmJogador, $token);
     $responseMessage ="Token da equipe Gerado com sucesso!";
     $json = '{ "sucess":"true", "token_equipe":"'.$token.'", "message": "'.$responseMessage.'"}';
     echo $json;
   }
   else
   {
     $responseMessage = "Token inválido ou partida já foi encerrada!";
    $json = '{ "sucess":"false", "token_equipe":"", "message": "'.$responseMessage.'"}';
    echo $json;
   }
 }
 else
 {
  $responseMessage = "Usuário não está conectado, não é possível iniciar uma nova partida!";
  $json = '{ "sucess":"false", "token_equipe":"", "message": "'.$responseMessage.'"}';
 }
?>
