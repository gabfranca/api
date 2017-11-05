<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

$token_partida = $_GET["token_partida"];

 $result = getVezEquipe($token_partida);

 if ($result) {
     JsonResult("true", $result, "Busca efetuada com sucesso!");
 } else {
    JsonResult("false", "null", "Token inválido!");
 }
 
 ?>