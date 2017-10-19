
<?php
header('Content-Type:' . "application/json" );

 require '../config.php';
 require '../connection.php';
 require '../database.php';
 require '../funtions.php';

 $request_body = file_get_contents('php://input');
 $json = json_decode($request_body);
 //$codigo = $json[0]->id;
$nome = $json[0]->nome;
$login = $json[0]->login;
$senha = $json[0]->senha;
$tpUsuario = $json[0]->tpusuario;

$result = validaUsuario($login);
if (!$result) {
  $retorno =  cadastraUsuario($nome, $login, $senha, $tpUsuario);
  if($retorno > 0)
  {
    $data = array(
    'cd_usuario' => $retorno ,
    'sessao'=> getSessao($retorno),
    'nomeUsuario' => getNomeUsuario($retorno));
   jsonResult('true', $data, 'Usuário cadastrado com sucesso!');
  }
  else {
     jsonResult('false', 'null', 'Ocorreu algum erro!');
  }
}
 else {
  jsonResult('false', 'null', 'Nome de usuario já existe! Utilize outro.');
}
?>
