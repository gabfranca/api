
<?php
//Definir formato de arquivo
 header('Content-Type:' . "text/plain ;charset=utf-8" );

 require 'config.php';
 require 'connection.php';
 require 'database.php'; 
 require 'funtions.php'; 

 $request_body = file_get_contents('php://input');
 $json = json_decode($request_body);

     $login = $json[0]->login;
     $senha = $json[0]->senha;
   
 
     $con =  DBConnect(); 
     //@pg_close($con); //Encerrrar Conexão
     
     if(!$con) {
      echo '[{"erro": "Não foi possível conectar ao banco"';
      echo '}]';
      }else {
      //SQL de BUSCA LISTAGEM
      $result = buscaUsuario($login, $senha);
      
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
         $data[] = $result->fetch_array(MYSQLI_ASSOC);
          // $dados[] = mysql_fetch_assoc($result); 
     }
    
     $auth = sessaoAtiva($data[0]['cdUsuario']);
     if ($auth ==true) {
         echo '[{"retorno": "Usuário já está ativo! impossível efetuar login."}]';
     } else {
         criaSessao($data[0]['cdUsuario']);
         //$retorno[] = $data[]
         echo json_encode($data, JSON_UNESCAPED_UNICODE); 
     }
     
    }
}
 ?>