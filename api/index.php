<?php

$src = "api";
require '../config.php';

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


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

//Capturamos la URL
$url = ( filter_input(INPUT_GET,"url") != null) ? filter_input(INPUT_GET,"url") : "Index/";
$url = explode('/', filter_var( rtrim($url, '/') , FILTER_SANITIZE_URL));

//Key -> q5ioq6+nmg==
//Uncomment if you want apikey validation to provide responses
/*
if (filter_input(INPUT_GET, "key") != null ){
    $key = urlencode(filter_input(INPUT_GET, "key"));
    $key = str_replace("%3D", "=", $key);
    //print_r(Hash::encrypt("scrtwrd",HASH_SECRET)); //This is the way you create/know your key
    if (!Hash::validateKey($key)){

         Request::setHeader(401,"text/html");

         exit("Invalid Key");
    }
}else{
    Request::setHeader(401,"text/html");
    exit("No Key provided");
}
*/
$controller = ( isset($url[0]) ) ? $url[0]."_controller" : "Index_controller";
$method = ( isset($url[1]) && $url[1] != null) ? $url[1] : substr($controller, 0, -11);

$request = new Request();
//print_r($request);

$path = "./controllers/".$controller.".php";

if(file_exists($path)){

    require $path;
    $controller = new $controller();
    $controller->setPhpinput($request->phpinput);

    $params = $request->parameters;
    unset($params["url"]);
    unset($params["key"]);

    if(isset($request->method)){
        if(method_exists($controller, $request->method)){
            if(isset($params) && $params != null){
                $controller->{$request->method}($method,$params);
            }else{
                $controller->{$request->method}($method);
            }
        }else{
            Request::error("Método no disponible",405);
        }
    }
}else{
    Request::error("Petición no encontrada",404);
}
