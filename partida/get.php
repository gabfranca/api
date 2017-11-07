<?php

header('Content-Type:' . "application/json" );
 require '../include.php';
 echo "----PARTIDAS----" ;

$sql = "select * from partida where andamento = 1";
$result = DataReader($sql);
echo json_encode($result, JSON_PRETTY_PRINT);

echo "----EQUIPES----" ;
$sql ="select e.* from equipe e join partida p on (p.token = e.token_partida) where p.andamento = 1; ";
$result = DataReader($sql);
echo json_encode($result, JSON_PRETTY_PRINT);
 ?>
