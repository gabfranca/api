
<?php
//Definir formato de arquivo
 header('Content-Type:' . "application/json;" );

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
      //echo '[{"erro": "Não foi possível conectar ao banco"';
      //echo '}]';
      jsonResult('false' , null, 'Não foi possível conectar ao banco');
      }else {
      //SQL de BUSCA LISTAGEM
      $result = buscaUsuario($login, $senha);
      
      $n = mysqli_num_rows($result); //Número de Linhas retornadas
     
      //$followingdata[] = $result->fetch_array(MYSQLI_ASSOC);
      //echo $followingdata["cdPergunta"];
      
     if (!$result) {
      //Caso não haja retorno
      //echo '[{"erro": "Há algum erro com a busca. Não retorna resultados"';
      //echo '}]';
      jsonResult('false', null, 'Há algum erro com a busca. Não retorna resultados');
      }else if($n<1) {
      //Caso não tenha nenhum item
      //echo '[{"erro": "Não há nenhum dado cadastrado"';
      //echo '}]';
      jsonResult('false', null, 'Não há nenhum dado cadastrado');
      }else {
      //Mesclar resultados em um array
  

      for($i = 0; $i<$n; $i++) 
      {
         $data[] = $result->fetch_array(MYSQLI_ASSOC);
          // $dados[] = mysql_fetch_assoc($result); 
     }
    
     $auth = sessaoAtiva($data[0]['cdUsuario']);
     if ($auth ==true) {
         jsonResult('false', null , 'Usuário já está ativo! impossível efetuar login.');
       //  echo '[{"retorno": "Usuário já está ativo! impossível efetuar login."}]';
     } else {
         criaSessao($data[0]['cdUsuario']);
         jsonResult('true', $data, 'Login efetuado com sucesso!');
     }
     
    }
}
 ?>