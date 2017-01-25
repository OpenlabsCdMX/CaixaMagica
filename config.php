<?php

    $_PROTOCOL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
    define('ROOT',$_PROTOCOL.preg_replace('/[^a-zA-Z0-9]/i','',$_SERVER['HTTP_HOST']).str_replace('\\','/',substr(dirname(__FILE__),strlen($_SERVER['DOCUMENT_ROOT']))).'/');//Returns Project basedir
    define('REQUEST', $_PROTOCOL.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);//Returns Request complete URL

    //Common configuration
    define('_DB_TYPE', 'mysql');
    define('_DB_HOST' , 'localhost');
    define('_DB_USER' , 'root' );
    define('_DB_PASS' , '' );
    define('_DB_NAME' , 'caixa_magica');

    define('HASH_ALGO' , 'sha512');
    define('HASH_KEY' , 'caixa');
    define('HASH_SECRET' , 'magica');
    define('SECRET_WORD' , 'peppapig');

    define('LIBS','libs/');
    define('MODELS','../models/');
    define('BL','../bussinesLogic/');

    //App vs Services configuration
    switch ($src) {
      case 'app':

      //define('URL', "http://10.10.1.12/caixamagica.eu/master/caixa/");
      define('URL', ROOT."caixa/");//If config file is shared then you'll need to add folder before ROOT
      define('MODULE','./views/modules/');

      break;

      case 'api':
        define('URL', ROOT."api/");
      break;

      case 'magia':
      define('URL', ROOT."magia/");//If config file is shared then you'll need to add folder before ROOT
      define('MODULE','./views/modules/');
      break;
    }
