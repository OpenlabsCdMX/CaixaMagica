<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index_controller
 *
 * @author pabhoz
 */
class Resultados_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        //instanciamos la opción de referencia para traer la caja
        $opcion = call_user_func($_GET["tipo"] .'::getById',$_GET["id"]);
        //obtenemos la caixa mediante la opción que pertenece a un asunto que pe
        //rtenece a una caja
        $caixa = Opciones_bl::getCaixa($opcion);
        //obtenemos los asuntos de la caja identificada
        $asuntos = Caixa_bl::getAsuntos($caixa->getId());
        //obtener las espuestas a cada asunto de la caja!
        $Abiertas = 0;
        $Multiples = 0;
        $Pila = 0;
        $opciones = ["Abiertas"=>[],"Multiples"=>[],"Pila"=>[]];
        
        foreach ($asuntos as $asunto) {
            //print_r($asunto->opciones);
            for ($index = 0; $index < count($asunto->opciones); $index++) {
                $tipo = get_class($asunto->opciones[$index]);
                switch ($tipo) {
                    case "OpcionAbierta":
                        //print_r(Opciones_bl::countAnswers($opcion));
                    break;
                    case "OpcionMultiple":
                        $Multiples++;
                        $opciones["Multiples"][] = ["texto"=>$asunto->opciones[$index]->getTexto(),
                        "votos"=>Opciones_bl::countAnswers($asunto->opciones[$index])];
                    break;
                    case "OpcionPila":

                    break;
                }
            }
        }
        $opciones["Abiertas"]["total"] = $Abiertas;
        $opciones["Multiples"]["total"] = $Multiples;
        $opciones["Pila"]["total"] = $Pila;
        
        print_r($opciones);
        /*
        $this->view->mobileTitle = "Resultados"; //Mobile Version Title
        $this->view->menuHL = "resultados";//menu highlighted option
        $this->view->render($this,"index","Caixa Mágica | Resultados");
         */
    }

}
