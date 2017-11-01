<?php

 header('Content-Type:' . "application/json" );
 require '../include.php';
$token_partida = $_GET['token_partida']; 

encerrarPartida($token_partida);

JsonResult("true","null", "Partida encerrada com sucesso!");

 ?>