<?php

header('Content-Type:' . "application/json" );

 require '../include.php';

$page = $_GET['page'];

$inicio = ($page *5)-5 ;
$fim = ($page *5);

$sql = "SELECT *  FROM pergunta LIMIT {$inicio},{$fim};";
$result = DataReader($sql);

if ($result)
{
  jsonResult("true", $result, "Busca efetuada com sucesso!");
} else
{
  jsonResult("false",null, "Ocorreu um erro na busca!");
}


?>
