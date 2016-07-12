<?php

/*
*******************************************************
*** URL            : Expression url is undefined on line 4, column 24 in Templates/Scripting/EmptyPHP.php.
*** Programador    : claudio
*** Cliente        : Expression empresa is undefined on line 6, column 24 in Templates/Scripting/EmptyPHP.php.
*** Nombre archivo : Database.php
*** Fecha creación : 11-07-2016
*** Hora creación  : 11:58:48 AM
*** Codificación   : UTF-8
*** Licencia       : "Todos los derechos reservados"
*******************************************************
*/

class Database extends PDO {

  public function __construct() {
    parent::__construct(
            'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR
    ));
  }

}
