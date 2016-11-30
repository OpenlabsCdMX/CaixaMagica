<?php

/*
 * Base PHP para un proyecto MVC usando un diseño de bases de datos
 * Orientadas a objetos (con Mapeo Objeto Relacional | ORM).
 *
 * @autor Pabhoz
 * @email pabhoz[at]gmail[dot]com
 * @youtube https://www.youtube.com/channel/UCyONBwvZsiSuTNATkgiNA6g/videos
 * @G+ +pabhoz
 *
 */

$src = "app";
require '../config.php';

// var = () ? verdero : falso;
$url = ( isset($_GET["url"]) ) ? $_GET["url"] : "Index/index";
$url = explode("/", $url);

$controller = ( isset($url[0]) ) ? $url[0] . "_controller" : "Index_controller";
$method = ( isset($url[1]) && $url[1] != null ) ? $url[1] : "index";
$params = ( isset($url[2]) && $url[2] != null ) ? $url[2] : null;

spl_autoload_register(function($class){
    if(file_exists(LIBS.$class.".php")){
        require LIBS.$class.".php";
    }elseif(file_exists (MODELS.$class.".php")){
        require MODELS.$class.".php";
    }else{
        if(file_exists(BL.$class.".php")){
            require BL.$class.".php";
        }else{
            //exit("La clase ".$class." no ha sido definida");
        }
    }
});

/* echo "Controlador: ".$controller;
  echo "</br> Método: ".$method;
  echo "</br> Parametro: ".$params; */

$path = "./controllers/" . $controller . ".php";

if (file_exists($path)) {
    require $path;
    $controller = new $controller();

    if (method_exists($controller, $method)) {
        if ($params != null) {
            $controller->{$method}($params);
        } else {
            $controller->{$method}();
        }
    } else {
        exit("Invalid Method");
    }
} else {
    exit("Invalid Controller");
}
