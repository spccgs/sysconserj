<?php

/*
*******************************************************
*** URL            : Expression url is undefined on line 4, column 24 in Templates/Scripting/EmptyPHP.php.
*** Programador    : claudio
*** Cliente        : Expression empresa is undefined on line 6, column 24 in Templates/Scripting/EmptyPHP.php.
*** Nombre archivo : Globals.php
*** Fecha creación : 11-07-2016
*** Hora creación  : 11:59:43 AM
*** Codificación   : UTF-8
*** Licencia       : "Todos los derechos reservados"
*******************************************************
*/

function getEstado($estado) {
  $estado = (int) $estado;

  $estados = array('Inactivo', 'Activo', 'En Proceso', 'Pendiente', 'Sin Datos', 'Irregular', 'Regular', 'Todos', 'Suspendido', 'Eliminado');

  if (is_int($estado)) {
    return $estados[$estado];
  }
  else {
    return false;
  }
}
