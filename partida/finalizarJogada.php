<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

$token_partida = $_GET["token_partida"];
$token_equipe = $_GET['token_equipe'];
$retorno = finalizarJogada($token_partida, $token_equipe);
jsonResult("true", "null", "Sucesso!");
?>
