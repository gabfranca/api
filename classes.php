<?php
class Partida {
    private $adm = null;


  function setAdm($id) {
      $adm = $id;
  }
  function getAdm() {
      return $adm;
  }
    function getToken($user, $sessao) {
      $token = strtoupper(substr(md5($user.$sessao), 0, 8));
      return $token;
    }
}

?>
