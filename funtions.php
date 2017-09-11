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

function buscaUsuario($login, $senha)
{
    $sql = "select * from usuario where nmlogin = {$login} and password = {$senha}";
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
        jsonResult("true", null,"Affected rows: {$result}");
    } else {
        jsonResult("false", null, mysqli_error($link));
    }
    DBClose($link);
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

?>