<?php

/*
*******************************************************
*** URL            : Expression url is undefined on line 4, column 24 in Templates/Scripting/EmptyPHP.php.
*** Programador    : claudio
*** Cliente        : Expression empresa is undefined on line 6, column 24 in Templates/Scripting/EmptyPHP.php.
*** Nombre archivo : Hash.php
*** Fecha creación : 11-07-2016
*** Hora creación  : 11:59:14 AM
*** Codificación   : UTF-8
*** Licencia       : "Todos los derechos reservados"
*******************************************************
 */

class Hash {

  public static function getHash($algoritmo, $data, $key) {
    $hash = hash_init($algoritmo, HASH_HMAC, $key);
    hash_update($hash, $data);

    return hash_final($hash);
  }

}
