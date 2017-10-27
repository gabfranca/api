
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
      jsonResult('false' , null, 'Não foi possível conectar ao banco');
      }else {
      $result = buscaUsuario($login, $senha);

      $n = mysqli_num_rows($result); //Número de Linhas retornadas

     if (!$result) {
      jsonResult('false', null, 'Há algum erro com a busca. Não retorna resultados');
      }else if($n<1) {
      jsonResult('false', null, 'Não há nenhum dado cadastrado');
      }else {
      for($i = 0; $i<$n; $i++)
      {
         $data[] = $result->fetch_array(MYSQLI_ASSOC);
          // $dados[] = mysql_fetch_assoc($result);
     }

 //getSessao($data[0]['cdUsuario']);
 $msg = "";
     $auth = sessaoAtiva($data[0]['cdUsuario']);
     if ($auth ==false) {
    //     jsonResult('false', 'null' , 'Usuário já está ativo! impossível efetuar login.');
      criaSessao($data[0]['cdUsuario']);
      $msg =" Uma nova sessão foi criada.";
     }
      // criaSessao($data[0]['cdUsuario']);
       $response = array(
        'sucess' => 'true',
         'cd_usuario' => $data[0]['cdUsuario'],
         'nome' => $data[0]['nmUsuario'],
         'sessao' => getSessao($data[0]['cdUsuario']),
         'tp_usuario' => $data[0]['cd_tipoUsuario'],
         'message' => 'Usuario conectado com sucesso!'.$msg);

         echo json_encode($response, JSON_PRETTY_PRINT);
        // jsonResult('true', $response, 'Login efetuado com sucesso!');
    }
}
 ?>
