<?php

header('Content-Type:' . "application/json" );

 require '../include.php';

 $codigo = $_GET['id'];
 getGrupoById($codigo);

?>
