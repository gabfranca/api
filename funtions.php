<?php

//JSON

function jsonResult($status, $data, $message)
{
   $data = array('sucess' => $status ,
   'data'=> $data,
   'message' => $message );
   echo json_encode($data, JSON_PRETTY_PRINT);
}

function executeQuery($sql, $link)
{

    mysqli_query($link, $sql);
    $affectedRows =  mysqli_affected_rows($link);
    return  $affectedRows;
}

function getNomeUsuario($id)
{
    $query = "select nmUsuario from usuario where cdUsuario = {$id}";
    $result = DataReader($query);
    return $result[0]['nmUsuario'];
}


function buscaUsuario($login, $senha)
{
    $sql = "select * from usuario where nmlogin = '{$login}' and password = {$senha}";
    $result = DBExecute($sql); //Executar a SQL
    return $result;
    //RETORNA OS DADOS DO USUÁRIO
}


// FUNÇOES DE SESSAO
function sessaoAtiva($cd_usuario)
{
    $sql =  "select * from sessao where cd_usuario = {$cd_usuario} and ativo = 1;";
    $result = DBExecute($sql);

    if(!mysqli_num_rows($result))
    return false;
    else return true;
}

function criaSessao($cd_usuario)
{
    $sql =  "insert into sessao values (null,  {$cd_usuario}, 1)";
    $result = DBExecute($sql);
    return $result;
}

function encerrarSessao($cd_usuario)
{
    $link =DBConnect();
    $sql =  "update sessao set ativo = 0 where cd_usuario = {$cd_usuario}";
    $result  = executeQuery($sql, $link);
    if ($result>0) {
        jsonResult("true", null, "Sessão encerrada com sucesso!");
    } else {
        jsonResult("false", null, 'Sessão Inválida!'.mysqli_error($link));
    }
    DBClose($link);
}

function getSessao($user)
{
    $query = "select cd_sessao from sessao where cd_usuario = {$user}";
    $result = DataReader($query);
    return $result[0]['cd_sessao'];
}

// FUNÇÕES PARA GRUPO

function criarGrupo($nm_grupo, $cd_usuario)
{
    $link = DBConnect();
    $sql =  "insert into GRUPO values (null, '{$nm_grupo}',  {$cd_usuario})";
    mysqli_query($link, $sql);
    $rowcount =  mysqli_affected_rows($link);
    if ($rowcount>0) {
        jsonResult("true", null,"Affected rows: {$rowcount}");
    } else {
        jsonResult("false", null, mysqli_error($link));
    }
    DBClose($link);
}

function removerGrupo($data)
{
    $link = DBConnect();
    $rows = 0;
    $sql = "delete from grupo where cdGrupo = ";
    foreach ($data as $key) {
        $id=  $key['id'];
        mysqli_query($link, $sql.$id);
        if (mysqli_affected_rows($link) > 0) {
           $rows = $rows +1;
        }
    }
    jsonResult("true", null,"Affected rows: {$rows}");
    DBClose($link);
}

function getGrupos()
{
    $query = "select * from grupo";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

function getGrupoById($id)
{
    $query = "select * from grupo where cdGrupo = {$id}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

function getGrupoByUser($id)
{
    $query = "select * from grupo where criado_por = {$id}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

function addPerguntaGrupo($cd_grupo, $cd_pergunta)
{
  $link = DBConnect();
  $sqlCheck = "select * from perguntagrupo where cd_grupo = {$cd_grupo} and cd_pergunta =  {$cd_pergunta}";
  $result = DataReader($sqlCheck);
  if ($result)
   {
    jsonResult('false', null, 'Esta pergunta já pertence a este grupo! Impossível adicionar novamente.');
  }
  else
  {
    $qtPerguntasGrupo = qtPerguntasGrupo($cd_grupo);
    if ($qtPerguntasGrupo<50) {
      $id_grupo = lastOrdemGrupo($cd_grupo);
      $query = "insert into perguntagrupo (id_grupo, cd_grupo, cd_pergunta) VALUES ({$id_grupo}, {$cd_grupo},{$cd_pergunta});";
      $rowcount = executeQuery($query, $link);
      if($rowcount>0)
      {
          jsonResult('true', null, 'Pergunta adicionada ao Grupo com sucesso!');
      }
      else
      {
          jsonResult('false', null, 'Ocorreu algum erro no insert!');
      }
    }
    else {
        jsonResult('false', null, 'Este Grupo completo de questões! Não é possível incluir mais.');
    }
  }
   DBClose($link);
}

function lastOrdemGrupo($id)
{
  $sql = "SELECT count(cd_grupo)+1 as perguntas from perguntagrupo where cd_Grupo = {$id}";
  $result = DataReader($sql);
  if($result)
  {
      $perguntas = $result[0]['perguntas'];
      return $perguntas;
  }
  else
  {
      return 0;
  }
}


function qtPerguntasGrupo($cdgrupo)
{
  $query = "SELECT count(cd_grupo) as perguntas from perguntagrupo where cd_grupo = {$cdgrupo}";
  $result = DataReader($query);
  if($result)
  {
      $perguntas = $result[0]['perguntas'];
      return $perguntas;
  }
  else
  {
      return 0;
  }
}


// PERGUNTAS POR GRUPO

function getPerguntasGrupo($id)
{
    $query = "SELECT *  FROM perguntagrupo pg
       INNER JOIN perguntamateria pm ON (pg.cd_pergunta=pm.cd_pergunta) where pg.cd_grupo = {$id} order by id_grupo desc;";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

// PERGUNTAS MATERIA
function getPgtsMateria()
{
    $result = DBRead('perguntamateria');
    if($result)
    {
        jsonResult('true', $result, '');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

function getPerguntasGrupoByPerguntas($id)
{
    $query = "select g.cdGrupo, g.nm_grupo, pg.cd_perguntagrupo  from grupo g join perguntagrupo pg
on (g.cdGrupo = pg.cd_grupo and pg.cd_pergunta = {$id})";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}




function removePerguntaGrupo($id)
{
    $query = " delete from perguntagrupo where cd_perguntagrupo = {$id};";
    $result = DBExecute($query);
    if($result)
    {
        jsonResult('true', $result, 'Removido com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'Ocorreu um erro ao remover!');
    }
}

function getPgtMateriaById($cd_pergunta)
{
    $query = "select * from perguntamateria where cd_pergunta = {$cd_pergunta}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}


function getPgtMateriaByUser($cd_usuario)
{
    $query = "select * from perguntamateria where add_por = {$cd_usuario}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

//PERGUNTAS DESAFIO

function getPgtsDesafio()
{
    $query = "select * from pergunta";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

function getPgtDesafioById($cd_pergunta)
{
    $query = "select * from pergunta where cdPergunta = {$cd_pergunta}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}


function getPgtDesafioByUser($cd_usuario)
{
    $query = "select * from pergunta where add_por = {$cd_usuario}";
    $result = DataReader($query);
    if($result)
    {
        jsonResult('true', $result, 'Busca efetuada com sucesso!');
    }
    else
    {
        jsonResult('false', null, 'A busca não retornou nenhum dado!');
    }
}

//USUARIO
function validaUsuario($param)
{
   $QUERY = "SELECT * FROM USUARIO WHERE nmlogin = '{$param}'";
   $result = DataReader($QUERY);
   return $result;
}

  //RETORNA O ID DO USUARIO QUE ACABOU DE SER INSERIDO
function cadastraUsuario($nome, $login, $senha, $tp)
{
    $link = DBConnect();
    $QUERY ="INSERT INTO USUARIO VALUES (null, '{$nome}', {$senha},'{$login}', $tp)";
    $row = executeQuery($QUERY,$link);
    $last_id =  mysqli_insert_id($link);
    DBClose($link);
    return  $last_id;

}

//PARTIDA

function getTokenPartida($user, $sessao) {
  $token = strtoupper(substr(md5($user.$sessao), 0, 8));
  return $token;
}


function getTokenEquipe($user, $sessao) {
  $token = strtoupper(substr(md5($user.$sessao), 0, 8));
  return $token;
}



function criaNovaPartida($token, $adm, $qt, $grupo)
{
    $link = DBConnect();
    $query = "insert into partida values (null, '{$token}', {$adm}, {$qt},{$grupo}, 1)";
    $result = executeQuery($query, $link);
    DBClose($link);
    return $result;
}


function criaNovaEquipe($equipe, $pontos, $tokenPartida, $tokenEquipe, $lider)
{
    $link = DBConnect();

    $query = "insert into equipe values (null, '{$equipe}', {$pontos}, 1 ,'{$tokenPartida}', '{$tokenEquipe}', {$lider})";
    $result = executeQuery($query, $link);
    DBClose($link);
    return $result;
}

function conectaJogador($usuario, $nome, $tokenEquipe)
{
    $link = DBConnect();
    $query = "insert into jogador values ({$usuario}, '{$nome}', '{$tokenEquipe}')";
    $result = executeQuery($query, $link);
    return $result;
}

function getEquipesPartida($token)
{
    $sql =   "select cd_equipe, nm_equipe  , nmUsuario as Lider from equipe e
     join usuario u on (e.cd_lider = u.cdusuario) where e.token_partida = '{$token}' order by cd_equipe";
    return DataReader($sql);
}

?>
