<?php

header('Content-Type:' . "application/json" );
require '../include.php';

 $token_equipe = $_GET['token_equipe'];
 $dado = $_GET['dado'];

$result = getByTabuleiro($token_equipe, $dado);
$arrayResult = array(
  'sucess' =>"true" ,
  'cd_pergunta' => $result[0]['cd_pergunta'] ,
  'questao1' => $result[0]['questao1'] ,
  'questao2' => $result[0]['questao2'] ,
  'questao3' => $result[0]['questao3'] ,
  'somaresultado' => $result[0]['somaresultado'] ,
  'cd_categoria' => $result[0]['cd_categoria'],
  'add_por' => $result[0]['add_por'],
  'message' => "Busca efetuada com sucesso!"
);
echo json_encode($arrayResult, JSON_PRETTY_PRINT);

?>
