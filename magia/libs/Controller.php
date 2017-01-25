<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Pabhoz
 */
class Controller {

    function __construct() {
        $this->view = new View();
        Session::init();
    }

    function validateKeys($keys,$where){
        foreach ( $keys as $key ){
            if(empty($where[$key]) or !isset($where[$key])){
                exit("No se encuentra el campo ".$key."!");
            }
        }
        return true;
    }

}

spl_autoload_register(function($class){
    if(file_exists("./controllers/".$class.".php")){
        require "./controllers/".$class.".php";
    }
});
