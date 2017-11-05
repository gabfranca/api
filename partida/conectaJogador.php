<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $tokenEquipe = $_GET['token'];
 $nmJogador = getNomeUsuario($codigo);

 $sessao = getSessao($codigo);
 $token = getTokenEquipe($codigo,$sessao);
$responseMessage = "";
 if ($sessao>0)
 {
     $sql = "select * from equipe where token_equipe = '{$tokenEquipe}' ";
     $result =  DataReader($sql);
     if ($result)
    {
     $query = "select token_partida from equipe where token_equipe = '{$tokenEquipe}'";
     $busca = DataReader($query); 
     if ($result) 
     {
       $token_partida = $busca[0]["token_partida"];
       $sql = "select * from jogador where cd_usuario = {$codigo} and token_equipe = '{$tokenEquipe}'";
       $busca = Datareader($sql);
       if ($busca) 
       {
          $responseMessage = "Jogador já esta conectado a esta equipe!";
          $json = '{ "sucess":"true", "token_partida":"'.$token_partida.'", "message": "'.$responseMessage.'"}';
          echo $json;      
        }
       else
       {  
          conectaJogador($codigo, $nmJogador, $tokenEquipe);
          $responseMessage ="Integrante conectador com sucesso!";
          $json = '{ "sucess":"true", "token_partida":"'.$token_partida.'", "message": "'.$responseMessage.'"}';
          echo $json;
        }
     
   //  jsonResult('true', '[]', "Jogador conectado à equipe com sucesso!");
     } 
      else
      {
        $responseMessage = "Ocorreu um erro! Equipe não encontrada.";
        $json = '{ "sucess":"false", "token_partida":"", "message": "'.$responseMessage.'"}';
        echo $json;   
      }
  }
 
  }
 else
 {
     jsonResult('false', '[]', "Usuário não está conectado ao jogo, não é possível iniciar uma nova partida!");
 }
?>