<?php

 header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $tokenPartida = $_GET['tokenPartida'];
 $nmEquipe = $_GET['nmEquipe'];
 $sessao = getSessao($codigo);
 $token = getTokenEquipe($codigo,$sessao);


 $nmJogador = getNomeUsuario($codigo);
 if ($sessao>0)
 {
   $sql = "select * from partida where token = '{$tokenPartida}' and andamento = 1";
   $result =  DataReader($sql);
   if ($result)
   {
     criaNovaEquipe($nmEquipe, 500, $tokenPartida, $token, $codigo);
     conectaJogador($codigo, $nmJogador, $token);
     $token = array('tokenEquipe' => $token );
     jsonResult('true', $token, "Token da equipe Gerado com sucesso!");
   }
   else
   {
     jsonResult('false', 'null', "Token inválido ou partida já foi encerrada!");
   }
 }
 else
 {
     jsonResult('false', 'null', "Usuário não está conectado, não é possível iniciar uma nova partida!");
 }
?>
