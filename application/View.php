<?php

/*
*******************************************************
*** URL            : Expression url is undefined on line 4, column 24 in Templates/Scripting/EmptyPHP.php.
*** Programador    : claudio
*** Cliente        : Expression empresa is undefined on line 6, column 24 in Templates/Scripting/EmptyPHP.php.
*** Nombre archivo : View.php
*** Fecha creación : 11-07-2016
*** Hora creación  : 11:58:29 AM
*** Codificación   : UTF-8
*** Licencia       : "Todos los derechos reservados"
*******************************************************
*/

require_once ROOT . 'libs' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty {

  private $_request;
  private $_js;
  private $_jsPlugin;
  private $_rutas;
  private $_template;
  private $_item;

  public function __construct(Request $peticion) {
    parent::__construct();
    $this->_request  = $peticion;
    $this->_js       = array();
    $this->_jsPlugin = array();
    $this->_rutas    = array();
    $this->_template = DEFAULT_LAYOUT;
    $this->_item     = '';

    $modulo      = $this->_request->getModulo();
    $controlador = $this->_request->getControlador();

    if ($modulo) {
      $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
      $this->_rutas['js']   = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
    }
    else {
      $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
      $this->_rutas['js']   = BASE_URL . 'views/' . $controlador . '/js/';
    }
  }

  public function renderizar($vista, $item = false, $noLayout = false) {
    if ($item) {
      $this->_item = $item;
    }
    $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS;
    $this->config_dir   = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS . 'configs' . DS;
    $this->cache_dir    = ROOT . 'tmp' . DS . 'cache' . DS;
    $this->compile_dir  = ROOT . 'tmp' . DS . 'template' . DS;

    if (Session::get('autenticado') == 'usuario') {
      $menu = array(
          array(
              'id'     => 'inicio',
              'titulo' => 'Inicio',
              'enlace' => BASE_URL . 'usuarios',
              'imagen' => 'glyphicon-home'
          ),
          array(
              'id'     => 'empresa',
              'titulo' => 'Perfil',
              'enlace' => BASE_URL . 'usuarios/empresa',
              'imagen' => 'glyphicon-user'
          ),
          array(
              'id'     => 'hosting',
              'titulo' => 'Hosting',
              'enlace' => BASE_URL . 'usuarios/hosting',
              'imagen' => 'glyphicon-book'
          ),
          array(
              'id'     => 'facturas',
              'titulo' => 'Facturas',
              'enlace' => BASE_URL . 'usuarios/facturas',
              'imagen' => 'glyphicon-file'
          ),
          array(
              'id'     => 'dominios',
              'titulo' => 'Dominios',
              'enlace' => BASE_URL . 'usuarios/dominios',
              'imagen' => 'glyphicon-globe'
          ),
          array(
              'id'     => 'programacion',
              'titulo' => 'Programaci&oacute;n',
              'enlace' => BASE_URL . 'usuarios/programacion',
              'imagen' => 'glyphicon-pencil'
          ),
          array(
              'id'     => 'mantenciones',
              'titulo' => 'Mantenciones',
              'enlace' => BASE_URL . 'usuarios/mantenciones',
              'imagen' => 'glyphicon-wrench'
          ),
          array(
              'id'     => 'notificar',
              'titulo' => 'Notificar Pago',
              'enlace' => BASE_URL . 'usuarios/notificar',
              'imagen' => 'glyphicon-envelope'
          ),
          array(
              'id'     => 'recome',
              'titulo' => 'Mis Recomendados',
              'enlace' => BASE_URL . 'usuarios/recome',
              'imagen' => 'glyphicon-usd'
          ),
          array(
              'id'     => 'salir',
              'titulo' => 'Salir',
              'enlace' => BASE_URL . 'usuarios/login/cerrar',
              'imagen' => 'glyphicon-log-out'
          )
      );
    }
    else {
      $menu = array(
          array(
              'id'     => 'inicio',
              'titulo' => 'Inicio',
              'enlace' => BASE_URL,
              'imagen' => 'glyphicon-home'
          ),
          array(
              'id'     => 'quienes_somos',
              'titulo' => 'Quienes Somos',
              'enlace' => BASE_URL . 'quienes_somos',
              'imagen' => 'glyphicon-user'
          ),
          array(
              'id'     => 'hosting',
              'titulo' => 'Hosting',
              'enlace' => BASE_URL . 'hosting',
              'imagen' => 'glyphicon-book'
          ),
//          array(
//              'id' => 'dominios',
//              'titulo' => 'Dominios',
//              'enlace' => 'http://dominios.servpcweb.com',
//              'imagen' => 'glyphicon-globe'
//          ),
          array(
              'id'     => 'programacion',
              'titulo' => 'Programaci&oacute;n',
              'enlace' => BASE_URL . 'programacion',
              'imagen' => 'glyphicon-pencil'
          ),
          array(
              'id'     => 'notificar',
              'titulo' => 'Notificar Pago',
              'enlace' => BASE_URL . 'notificar',
              'imagen' => 'glyphicon-envelope'
          ),
          array(
              'id'     => 'formaspago/',
              'titulo' => 'Formas de Pago',
              'enlace' => BASE_URL . 'hosting/formaspago/',
              'imagen' => 'glyphicon-usd'
          ),
          array(
              'id'     => 'contacto',
              'titulo' => 'Contacto',
              'enlace' => BASE_URL . 'contacto',
              'imagen' => 'glyphicon-envelope'
          ),
          array(
              'id'     => 'clientes',
              'titulo' => 'Clientes',
              'enlace' => BASE_URL . 'usuarios/login',
              'imagen' => 'glyphicon-log-in'
          )
      );
    }

    $menuservicios = array(
        array(
            'id'     => 'hosting',
            'titulo' => 'Hosting',
            'enlace' => BASE_URL . 'admin/hosting',
            'imagen' => 'glyphicon-book'
        ),
        array(
            'id'     => 'dominios',
            'titulo' => 'Dominios',
            'enlace' => BASE_URL . 'admin/dominios',
            'imagen' => 'glyphicon-cog'
        ),
        array(
            'id'     => 'programacion',
            'titulo' => 'Programaci&oacute;n',
            'enlace' => BASE_URL . 'admin/programacion',
            'imagen' => 'glyphicon-pencil'
        ),
    );

    $menucerraradmin = array(
        array(
            'id'     => 'salir',
            'titulo' => 'Salir',
            'enlace' => BASE_URL . 'admin/login/cerrar',
            'imagen' => 'glyphicon-log-out'
        ),
    );

    $menucerrarusu = array(
        array(
            'id'     => 'salir',
            'titulo' => 'Salir',
            'enlace' => BASE_URL . 'usuarios/login/cerrar',
            'imagen' => 'glyphicon-log-out'
        ),
    );

    $menuclientes      = array(
        array(
            'id'     => 'empresa',
            'titulo' => 'Empresas',
            'enlace' => BASE_URL . 'admin/empresa',
            'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'contacto',
            'titulo' => 'Contacto',
            'enlace' => BASE_URL . 'admin/contacto',
            'imagen' => 'glyphicon-phone-alt'
        ),
        array(
            'id'     => 'facturacion',
            'titulo' => 'Facturaci&oacute;n',
            'enlace' => BASE_URL . 'admin/facturacion',
            'imagen' => 'glyphicon-file'
        )
    );
    $menuestadocliente = array(
        array(
            'id'     => 'activos',
            'titulo' => 'Activos',
            'enlace' => BASE_URL . 'admin/clientes/activos',
            'imagen' => 'glyphicon-ok'
        ),
        array(
            'id'     => 'enproceso',
            'titulo' => 'En Proceso',
            'enlace' => BASE_URL . 'admin/clientes/enproceso',
            'imagen' => 'glyphicon-ok-circle'
        ),
        array(
            'id'     => 'suspendidos',
            'titulo' => 'Suspendidos',
            'enlace' => BASE_URL . 'admin/clientes/suspendidos',
            'imagen' => 'glyphicon-pushpin'
        ),
        array(
            'id'     => 'inactivos',
            'titulo' => 'Inactivos',
            'enlace' => BASE_URL . 'admin/clientes/inactivos',
            'imagen' => 'glyphicon-unchecked'
        ),
        array(
            'id'     => 'pendientes',
            'titulo' => 'Pendientes',
            'enlace' => BASE_URL . 'admin/clientes/pendientes',
            'imagen' => 'glyphicon-warning-sign'
        ),
        array(
            'id'     => 'eliminados',
            'titulo' => 'Eliminados',
            'enlace' => BASE_URL . 'admin/clientes/eliminados',
            'imagen' => 'glyphicon-remove'
        )
    );
    $menuadmin         = array(
        array(
            'id'     => 'categorias',
            'titulo' => 'Categor&iacute;as',
            'enlace' => BASE_URL . 'admin/categorias',
//                        'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'pagos',
            'titulo' => 'Pagos',
            'enlace' => BASE_URL . 'admin/pagos',
            'imagen' => 'glyphicon-usd'
        ),
        array(
            'id'     => 'cambiarestado',
            'titulo' => 'Estado',
            'enlace' => BASE_URL . 'admin/cambiarestado',
            'imagen' => 'glyphicon-share'
        ),
        array(
            'id'     => 'mensajes',
            'titulo' => 'Mensajes',
            'enlace' => BASE_URL . 'admin/mensajes',
            'imagen' => 'glyphicon-envelope'
        )
    );
    $menufacturas      = array(
        array(
            'id'     => 'sindocto',
            'titulo' => 'Sin Procesar',
            'enlace' => BASE_URL . 'admin/doctos/sindocto',
//              'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'pendientes',
            'titulo' => 'Pendientes',
            'enlace' => BASE_URL . 'admin/doctos/pendientes',
//                        'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'enproceso',
            'titulo' => 'En Proceso',
            'enlace' => BASE_URL . 'admin/doctos/enproceso',
//                        'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'pagadas',
            'titulo' => 'Pagadas',
            'enlace' => BASE_URL . 'admin/doctos/pagados',
//                        'imagen' => 'glyphicon-home'
        )
    );
    $menudoctos        = array(
        array(
            'id'     => 'boletas',
            'titulo' => 'Boletas',
            'enlace' => BASE_URL . 'admin/doctos/boletas',
//                        'imagen' => 'glyphicon-home'
        ),
        array(
            'id'     => 'notacredito',
            'titulo' => 'Notas Cr&eacute;dito',
            'enlace' => BASE_URL . 'admin/doctos/notacredito',
//                        'imagen' => 'glyphicon-home'
        )
    );
    $_params           = array(
        'ruta_css'          => BASE_URL . 'views/layout/' . $this->_template . '/css/',
        'ruta_img'          => BASE_URL . 'views/layout/' . $this->_template . '/img/',
        'ruta_js'           => BASE_URL . 'views/layout/' . $this->_template . '/js/',
        'menu'              => $menu,
        'menuservicios'     => $menuservicios,
        'menucerraradmin'   => $menucerraradmin,
        'menucerrarusu'     => $menucerrarusu,
        'menuclientes'      => $menuclientes,
        'menuestadocliente' => $menuestadocliente,
        'menuadmin'         => $menuadmin,
        'menudoctos'        => $menudoctos,
        'menufacturas'      => $menufacturas,
        'item'              => $this->_item,
        'js'                => $this->_js,
        'jsPlugin'          => $this->_jsPlugin,
        'root'              => BASE_URL,
        'configs'           => array(
            'app_name'    => APP_NAME,
            'app_slogan'  => APP_SLOGAN,
            'app_company' => APP_COMPANY
        )
    );

    if (is_readable($this->_rutas['view'] . $vista . '.tpl')) {
      if ($noLayout) {
        $this->template_dir = $this->_rutas['view'];
        $this->display($this->_rutas['view'] . $vista . '.tpl');
        exit;
      }
      $this->assign('_contenido', $this->_rutas['view'] . $vista . '.tpl');
    }
    else {
      throw new Exception('Error de vista');
    }

    $this->assign('_layoutParams', $_params);
    $this->display('template.tpl');
  }

  public function setJs(array $js) {
    if (is_array($js) && count($js)) {
      for ($i = 0; $i < count($js); $i++) {
        $this->_js[] = $this->_rutas['js'] . $js[$i] . '.js';
      }
    }
    else {
      throw new Exception('Error de js');
    }
  }

  public function setJsPlugin(array $js) {
    if (is_array($js) && count($js)) {
      for ($i = 0; $i < count($js); $i++) {
        $this->_jsPlugin[] = $this->_rutas['js'] . $js[$i] . '.js';
      }
    }
    else {
      throw new Exception('Error de js plugin');
    }
  }

  public function setTemplate($template) {
    $this->_template = (string) $template;
  }

}
