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
        jsonResult("true", 'null', "Sessão encerrada com sucesso!");
    } else {
        jsonResult("false", 'null', 'Sessão Inválida!'.mysqli_error($link));
    }
    DBClose($link);
}

function getSessao($user)
{
    $query = "select cd_sessao from sessao where cd_usuario = {$user} and ativo = 1";
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

function removerGrupoByIdList($data)
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

function getByTabuleiro($token_equipe, $dado)
{
    $sql = "select pos_tabuleiro from equipe where token_equipe =  '{$token_equipe}'";
    $result = DataReader($sql);
    $pos_tabuleiro = $result[0]["pos_tabuleiro"];
    $pergunta = $pos_tabuleiro+$dado-1;

    $sql = "select * from perguntamateria where cd_pergunta = {$pergunta}";
    $result = DataReader($sql);
    return $result;
}

function getByTabuleiroDesafio($token_equipe, $dado)
{
    $sql = "select pos_tabuleiro from equipe where token_equipe =  '{$token_equipe}'";
    $result = DataReader($sql);
    $pos_tabuleiro = $result[0]["pos_tabuleiro"];
    $pergunta = $pos_tabuleiro+$dado-1;

    $sql = "select * from pergunta where cdPergunta = {$pergunta}";
    $result = DataReader($sql);
    return $result;
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
  $token = strtoupper(substr(md5($user.$sessao), 0, 6));
  return $token;
}


function setVezJogador($vez, $token_equipe)
{
    $link = DBConnect();
    executeQuery("call setSafeUpdate(0);", $link);
    $sqlUpdate =  "update equipe set minha_vez = {$vez} WHERE token_equipe = '{$token_equipe}';";
    executeQuery($sqlUpdate, $link);
    DBClose($link);

}

function getTokenEquipe($user, $sessao) {
  $token = strtoupper(substr(md5($user.$sessao), 0, 6));
  return $token;
}

function encerrarPartida($token)
{
    $link = DBConnect();
    $sql = "call encerrarPartida('{$token}');";
    $result = executeQuery($sql, $link);
    DBClose($link);
}


function criaNovaPartida($token, $adm, $qt, $grupo)
{
    $link = DBConnect();
    $query = "insert into partida values (null, '{$token}', {$adm}, {$qt},{$grupo}, 1)";
    $result = executeQuery($query, $link);
    DBClose($link);
    return $result;
}

function partidaAndamento($cd_usuario)
{
    $sql = "select token from partida where cd_adm = {$cd_usuario} and andamento = 1";
    $result = DataReader($sql);
    return $result;
}

function criaNovaEquipe($equipe, $pontos, $tokenPartida, $tokenEquipe, $lider)
{
    $link = DBConnect();
    $sql= "select max(ordem_partida) as ordem_partida from equipe where token_partida = '{$tokenPartida}'";
    $result = DataReader($sql);
  //  echo var_dump($result);
  $minha_vez = 0;
    if($result)
    {
        $ordem_partida =   $result[0]['ordem_partida'];
        $ordem_partida = $ordem_partida+1;
    }
    else
    {
        $ordem_partida = 1;
        $minha_vez = 1;
    }

    $query = "insert into equipe values (null, '{$equipe}', {$pontos}, 1 ,'{$tokenPartida}', '{$tokenEquipe}', {$lider}, {$ordem_partida},{$minha_vez})";

    $result = executeQuery($query, $link);
    DBClose($link);
    return $result;
}

function getVezEquipe($token_partida)
{
    $query = "select nm_equipe, token_equipe, ordem_partida from equipe where token_partida = '{$token_partida}' and minha_vez = 1";
    $result = DataReader($query);
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

function getRankingEquipes($token)
{
    $sql =   "select cd_equipe, nm_equipe  ,pontos , pos_tabuleiro, nmUsuario as Lider from equipe e
     join usuario u on (e.cd_lider = u.cdusuario) where e.token_partida = '{$token}' order by  cd_equipe";
    return DataReader($sql);
}

function removerGrupo($id)
{
    $query =  "call removeGrupo({$id});";

    $result =  DBExecute($query);
    if ($result >0) {
      jsonResult("true", 'null',"Excluido com sucesso!");
    } else {
      jsonResult("false", 'null',"Ocorreu algum erro!");
    }
}

function finalizarJogada($token_partida, $token_equipe)
{

  setVezJogador(0, $token_equipe);
  $query=  "select * from partida where token = '{$token_partida}';";
  $result = DataReader($query);
  if ($result) {
     $qt_equipes = $result[0]["qt_lideres"];
     $sql = "select ordem_partida from equipe where token_equipe = '{$token_equipe}'";
     $result = DataReader($sql);
     if ($result) {
         $ordem_partida = $result[0]['ordem_partida'];
          if ($ordem_partida == $qt_equipes) {
              $ordem_partida = 0;
          }
         $sql = "select * from equipe where ordem_partida = ({$ordem_partida}+1) and token_partida = '{$token_partida}' ";
         $busca = DataReader($sql);
         setVezJogador(1, $busca[0]['token_equipe']);
         $busca = DataReader($sql);
        return $busca;
     }
  } else {
      JsonResult("false", "[]","Token de Partida inválido!");
  }
}

function validaLider($cd_usuario, $token_partida)
{
      $query = "select * from partida p
                inner join equipe e on (p.token = e.token_partida)
                where p.andamento = 1 and p.token = '{$token_partida}' and e.cd_lider = {$cd_usuario}";
      $result = DataReader($query);
      return $result;
}
?>
