<?php

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


    $host = 'http://localhost:8090/tcc/login';
    $url = 'https://www.facebook.com/login.php?login_attempt=1&lwv=110';
    $username = 'gabriel_pk1@hotmail.com';
    $password = '2831996ZZ!';
    $data = array ('action' => 'Acesso/Login','email' => $username, 'pass' => $password, 'format' => 'multipart/form-data');
    $data = http_build_query($data);
    echo $data;
    $reply = do_post_request($url, $data);
    echo "**********Response*********";
     echo var_dump($reply);
     echo $reply;
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