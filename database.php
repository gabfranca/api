<?php

    //executa querys
    function DBExecute($query)
    {
        $link = DBConnect(); 
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));

        DBClose($link);
        return $result;
    }

    //Grava Registros 
    function DBCreate($table, array $data)
    {
        $fields = implode(', ',array_keys($data));
        $values = "".implode(", ",$data)."";
        $query = "INSERT INTO {$table} VALUES({$values});";
   //   echo $query;
       return DBExecute ($query);
    } 



    //Ler Registros
    function DBRead($table, $params = null, $fields='*')
    {
        $params = ($params)? "{$params}":null;
        $query = "select {$fields} from {$table} {$params}";
       $result = DBExecute($query);
      
      //  echo $query;
        if(!mysqli_num_rows($result))
        return false;
        else
         while ($res = mysqli_fetch_assoc($result))
        {
            $data[] = $res;
        }
        return $data;
    }

 //PEGA O ID DO ULTIMO INSERT EM DETERMINADA TABELA
    function getLastID($tabela, $campo)
    {
       $query = "select {$campo} FROM $tabela ORDER BY $campo DESC LIMIT 1;"; 
        $link = DBConnect(); 
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));

      
           foreach ($result as $ret) {
           $id =  $ret["$campo"];
        }
         DBClose($link);
        return $id;
    }
  
  function getPerguntaByID($id)
    {
       $query = "select * FROM pergunta where cdPergunta = {$id};"; 
        $link = DBConnect(); 
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));

      
           foreach ($result as $ret) {
           $id =  $ret["$campo"];
        }
         DBClose($link);
        return $id;
    }



    function GravaSessao($cdUsuario)
    {
        $query = "insert into sessao values (null, $cdUsuario, true);"; 
        $link = DBConnect(); 
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));
        DBClose($link);
        return $result;
    }

    function ValidaLogin($login, $senha)
    {
        $query = "select * from usuario where nmlogin = '$login' and password = $senha limit 1;"; 
        $link = DBConnect(); 
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));
     
          if(!mysqli_num_rows($result))
        return false;
        else
         while ($res = mysqli_fetch_assoc($result))
        {
            $data[] = $res;
        }
        return $data;
        DBClose($link);
    } 

    function InserirPergunta($pergunta,$cdCategoria,$resposta1,$resposta2,$resposta3,$resposta4,$opcao_correta, $user)
    {
        $sql = "insert into pergunta values (null, '$pergunta',$cdCategoria, '$resposta1', '$resposta2', '$resposta3', '$resposta4',$opcao_correta,$user);";
        echo $sql;
        return DBExecute ($sql);
    }


    function ValidaSessao()
    {
       if (session_status() == PHP_SESSION_ACTIVE) {
       // session_destroy();
        }
        else{
              header('Location: http://localhost:8090/tcc/login');
         }
    }


?>