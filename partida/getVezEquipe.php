<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

$token_partida = $_GET["token_partida"];

 $result = getVezEquipe($token_partida);

 if ($result) {
   $resposta = array
   (
     'sucess' => "true",
      "nm_equipe" => $result[0]["nm_equipe"],
      "token_equipe" => $result[0]["token_equipe"],
      "ordem_partida" => $result[0]["ordem_partida"],
      'message' => "Busca efetuada com sucesso!"
   );
   echo json_encode($resposta, JSON_PRETTY_PRINT);;
    // JsonResult("true", $result, "Busca efetuada com sucesso!");
 } else {
    JsonResult("false", "null", "Token inválido!");
 }

 ?>
