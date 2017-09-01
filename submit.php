<?php

require 'classe.php';
$request_body = file_get_contents('php://input');
$json = json_decode($request_body);

json_encode($json, JSON_PRETTY_PRINT); 
//if()
//{
    function do_post_request($url, $data, $optional_headers = null)
    {
        $params = array('http' => array(
                        'method' => 'POST',
                        'content' => $data
                    ));
        if($optional_headers != null)
        {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp)
        {
            throw new Exception("Problem with $url, $php_errormsg");
        }
        $response='';
        while (!feof($fp))
        {
            $response = $response.fgets($fp);
        }
        if ($response === false)
        {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }

        fclose($fp);
        return $response;
    }

    function post($nome, $senha)
    {
        $fields = array(
            'name' => $nome,
            'pass' => $senha
        );

        
        $response = HTTPRequester::HTTPost("http://localhost:8090/tcc/login", $fields);
        ;
    }

    $host = 'http://localhost:8090/tcc/login';
    $url = 'http://portaldoaluno.unisanta.br/Acesso/Login';
    $username = '123412';
    $password = '280396';
    $data = array ('action' => 'Acesso/Login','RA' => $username, 'Senha' => $password, 'format' => 'txt');
    $data = http_build_query($data);
    echo $data;
    $reply = post($url, $data);
    echo "**********Response*********";
     echo var_dump($reply);
    $a = 'Login - Portal de alunos Unisanta';
    
    if (strpos($reply, $a) !== false) {
        echo 'true';
    }
    else 
    {
        echo 'false';
    }
    

    #header('location:'.$host);
    #exit;

   //} else {
    //json_encode($json, JSON_PRETTY_PRINT); 
       
 //  }

 ?>