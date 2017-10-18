
<?php
header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php';
 require '../funtions.php';

 if(isset($_GET['id']) == false ) {
   jsonResult('false' , null , 'No parameters received.');

 } else {

       getPerguntasGrupo($_GET['id']);
 }
?>
