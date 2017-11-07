<?php

header('Content-Type:' . "application/json" );

 require '../include.php';

$acertou = $_GET['acertou'];
$token_equipe = $_GET['token_equipe'];
$casas = $_GET['casas'];
$link = DBConnect();

  $query = "call setSafeUpdate(0);";
  $result =  executeQuery($query, $link);
  //var_dump($result);
  $query = "select * from EQUIPE where token_equipe = '{$token_equipe}' order by cd_equipe desc limit 1";

  // "select * from equipe where token_equipe='{$token_equipe}'";
  $result = DataReader($query);
  $pontos = $result[0]["pontos"];
  $token_partida = $result[0]["token_partida"];
  $pos_tabuleiro = $result[0]["pos_tabuleiro"];

  //$pos_tabuleiro = $pos_tabuleiro+$casas;
  $soma = array($pos_tabuleiro, $casas);
 //echo "posicao".$pos_tabuleiro;
  $pos_tabuleiro =  array_sum($soma);
if ($acertou == "true") {
  $pontos = $pontos+200;
}
else {
  $pontos = $pontos-100;
}
  $query = "update equipe set pontos = {$pontos} where token_equipe = '{$token_equipe}'";
  executeQuery($query, $link);
  $query = "call setSafeUpdate(0);";
  $result =  executeQuery($query, $link);
  $query = "update equipe set pos_tabuleiro = {$pos_tabuleiro} where token_equipe = '{$token_equipe}'";
//  echo $query;
  executeQuery($query, $link);

  $query = "call setSafeUpdate(1);";
  executeQuery($query, $link);


$retorno = finalizarJogada($token_partida, $token_equipe);
$array = $retorno[0];

jsonResult("true", $array, "sucesso");
?>
