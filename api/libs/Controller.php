<?php

/**
 * Description of Controller
 *
 * @author pabhoz
 */
class Controller{

    private $phpinput;

    function __construct() {
        $this->phpinput = '';
    }

    function get($method,$params = null) {
        /*Forzar descarga de respuesta
        Request::setHeader(200,"application/x-www-form-urlencoded");
        Header para text HTML como respuesta
        Request::setHeader(200,"text/html");
        Header para text plano como respuesta
        Request::setHeader(200,"text/plain");*/
        /*$response = ["request_method" => "GET"];
        echo json_encode($response);
        $args = ["method"=>$method,"params"=>$params];
        print_r($args);*/
        //var_dump($method);
        //print_r($params);
        $this->execute($method, "get",$params);
    }

    function post($method,$params = null) {
        /*$response = ["request_method" => "POST"];
        echo json_encode($response);*/
        $this->execute($method, "post",$params);
    }

    function put($method,$params = null) {
        $this->_PUT = $this->initMethods();
        /*$response = ["request_method" => "PUT"];
        echo json_encode($response);*/
        $this->execute($method, "put",$params);
    }

    function delete($method,$params = null) {
        $this->_DELETE = $this->initMethods();
        /*$response = ["request_method" => "DELETE"];
        echo json_encode($response);*/
        $this->execute($method, "delete",$params);
    }

    private function execute($method_name,$request,$params=null){
        $method_name = $request.ucfirst($method_name);
        if(method_exists($this, $method_name)){

            /*$reflexion = new ReflectionMethod($this,$method_name);
            $expectedParams = sizeof($reflexion->getParameters());
            print_r($reflexion->getParameters());*/
            try{
                error_reporting(E_ERROR | E_PARSE);
                if($params){
                    call_user_func_array(array($this, $method_name)
                            , $params);
                }else{
                    $this->{$method_name}();
                }
            }catch (Exception $e){
                exit("Error ".$e->getMessage());
            }
        }else{
            if(method_exists($this, $request.get_class($this))){

           }else{
              Request::error("Método no disponible",405);
           }
        }
    }

    function getPhpinput() {
        return $this->phpinput;
    }

    function setPhpinput($phpinput) {
        $this->phpinput = $phpinput;
    }

    function initMethods() {

        $_HTTPREQUEST = $this->phpinput;
        parse_str($_HTTPREQUEST, $_HTTPREQUEST);
        return $_HTTPREQUEST;
    }

    function validateKeys($keys, $where) {

        foreach ($keys as $key) {
            if (!isset($where[$key])) {
                Request::setHeader(400);
                $r["error"] = 1;
                $r["msg"] = "Bad Request, field ".$key." not found";
                exit(json_encode($r));
            }
        }
        return true;
    }

    function getHelp(){
        $controller = substr(get_class($this), 0, -11);
        $filename = './WSD/'.$controller.".php";

        if(file_exists($filename)){
            Request::setHeader(200,"text/html");
            $url = URL.$controller."/";
            require $filename;
        }
    }

     private function exists($attr,$value){
            $response = false;
            if(count(Model::where($attr, $value))== 1){
                $response = true;
            }
            return $response;
        }

}

spl_autoload_register(function($class) {
    if (file_exists("./controllers/" . $class . ".php")) {
        require "./controllers/" . $class . ".php";
    }elseif(file_exists("models/" . $class . ".php")){
        require "models/" . $class . ".php";
    }
});
