<?php

header('Content-Type:' . "application/json" );

 require '../include.php';

 $cd_lider = $_GET["id"];
 $casas = $_GET["casas"];


 
 $json = json_decode($request_body);

 
 getPgtsDesafio();
?>
