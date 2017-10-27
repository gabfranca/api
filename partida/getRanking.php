<?php

header('Content-Type:' . "application/json" );
 require '../include.php';

$token = $_GET['token'];

$result = getRankingEquipes($token);
jsonResult('true', $result, 'Busca Efetuada com suceso!');
?>
