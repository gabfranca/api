<?php

header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php'; 
 require '../funtions.php'; 
 
getPgtsMateria();
?>