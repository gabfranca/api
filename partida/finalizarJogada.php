<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

$token_partida = $_GET["token_partida"];
$token_equipe = $_GET['token_equipe'];


setVezJogador(0, $token_equipe);

$query=  "select * from partida where token = '{$token_partida}';";
$result = DataReader($query);
if ($result) {
   $qt_equipes = $result[0]["qt_lideres"];


   $sql = "select ordem_partida from equipe where token_equipe = '{$token_equipe}'";
   $result = DataReader($sql);
   if ($result) {
   
       $ordem_partida = $result[0]['ordem_partida'];  
        if ($ordem_partida == $qt_equipes) {
            $ordem_partida = 0;
        }
        
       $sql = "select * from equipe where ordem_partida = ({$ordem_partida}+1) and token_partida = '{$token_partida}' ";
       $busca = DataReader($sql);
       setVezJogador(1, $busca[0]['token_equipe']);
       $busca = DataReader($sql);    
       JsonResult("true", $busca, "Sucesso!");  
   } 

} else {
    JsonResult("false", "[]","Token de Partida inválido!");
}

?>