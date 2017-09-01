<?php

function buscaUsuario($login, $senha)
{
    $sql = "select * from usuario where nmlogin = {$login} and password = {$senha}";
    $result = DBExecute($sql); //Executar a SQL
    return $result;
    //RETORNA OS DADOS DO USUÁRIO
}


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
    $sql =  "update sessao set ativo = 0 where cd_usuario = {$cd_usuario}"; 
    $result = DBExecute($sql);  
    return $result;
}
?>