<?php

header('Content-Type:' . "application/json" );
require '../include.php';

 $token_equipe = $_GET['token_equipe'];
 $dado = $_GET['dado'];

$result = getByTabuleiroDesafio($token_equipe, $dado);
$arrayResult = array
(
  'sucess' => "true",
  'cdPergunta' => $result[0]['cdPergunta'] ,
  'dsPergunta' => $result[0]['dsPergunta'],
  'cdCategoria' => $result[0]['cdCategoria'],
  'dsResposta1' => $result[0]['dsResposta1'],
  'dsResposta2' => $result[0]['dsResposta2'],
  'dsResposta3' => $result[0]['dsResposta3'],
  'dsResposta4' => $result[0]['dsResposta4'],
  'correta' => $result[0]['correta'],
  'add_por' => $result[0]['add_por'],

);
echo json_encode($arrayResult, JSON_PRETTY_PRINT);
//jsonResult("true", $result, "Sucesso!");

?>
