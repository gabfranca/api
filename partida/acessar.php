<?php

 header('Content-Type:' . "application/json" );
 require '../include.php';

 $codigo = $_GET['id'];
 $tokenPartida = $_GET['token'];
 $sessao = getSessao($codigo);
//echo $tokenPartida;

 if ($sessao>0)
 {
   $sql = "select * from partida where token = '{$tokenPartida}' and andamento = 1";
   $result_partida =  DataReader($sql);
   $qt = $result_partida[0]['qt_lideres'];

//   echo $qt;
   if ($result_partida)
   {
     $result =  getEquipesPartida($tokenPartida);
     $count =  count($result);
      if ($count < $qt)
      {
      //  $array = array('lideres_restantes' => $qt-$count);
        jsonResult('false',$result, 'Aguardando '.($qt - $count).' lideres se conectarem a Partida.'  );
      }
        else if ($count == $qt)
      {
        jsonResult('true',$result, 'Todas as equipes se conectaram com sucesso!' );
      }
      else
      {
         jsonResult('false','null', 'Há mais equipes conectadas do que o permitido!' );
      }
   }
   else
   {
     jsonResult('false', null, "Token inválido ou partida já foi encerrada!");
   }
 }
 else
 {
     jsonResult('false', null, "Usuário não está conectado, não é possível iniciar uma nova partida!");
 }
?>
