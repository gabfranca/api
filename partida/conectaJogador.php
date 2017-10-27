<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $tokenEquipe = $_GET['token'];
 $nmJogador = getNomeUsuario($codigo);

 $sessao = getSessao($codigo);
 $token = getTokenEquipe($codigo,$sessao);

 if ($sessao>0)
 {
   $sql = "select * from equipe where token_equipe = '{$tokenEquipe}' ";
   $result =  DataReader($sql);
   if ($result)
   {
     conectaJogador($codigo, $nmJogador, $tokenEquipe);
     jsonResult('true', 'null', "Jogador conectado à equipe com sucesso!");
   } else
   {
      jsonResult('false', 'null', "Token de Equipe inválido!");
   }
}
 else
 {
     jsonResult('false', 'null', "Usuário não está conectado ao jogo, não é possível iniciar uma nova partida!");
 }
?>
