
<?php
//Definir formato de arquivo
 header('Content-Type:' . "text/plain" . "charset=utf-8" );

 require 'config.php';
 require 'connection.php';
 require 'database.php'; 

 $con =  DBConnect(); 
//@pg_close($con); //Encerrrar Conexão

if(!$con) {
 echo '[{"erro": "Não foi possível conectar ao banco"';
 echo '}]';
 }else {
 //SQL de BUSCA LISTAGEM
 $sql = "select * from categorias";
 $result = DBExecute($sql); //Executar a SQL
 $n = mysqli_num_rows($result); //Número de Linhas retornadas

 //$followingdata[] = $result->fetch_array(MYSQLI_ASSOC);
 //echo $followingdata["cdPergunta"];
 
if (!$result) {
 //Caso não haja retorno
 echo '[{"erro": "Há algum erro com a busca. Não retorna resultados"';
 echo '}]';
 }else if($n<1) {
 //Caso não tenha nenhum item
 echo '[{"erro": "Não há nenhum dado cadastrado"';
 echo '}]';
 }else {
 //Mesclar resultados em um array
 for($i = 0; $i<$n; $i++) 
 {
    $followingdata[] = $result->fetch_array(MYSQLI_ASSOC);
     // $dados[] = mysql_fetch_assoc($result); 
}
 echo json_encode($followingdata, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE); } } 
 
 ?>