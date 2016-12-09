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
        $opciones = ["Abiertas"=>[],"Multiples"=>[],"Pila"=>[]];
        
        $repsuestas = [];
        
        foreach ($asuntos as $key => $asunto) {
            //Contador de participación por tipo de respuesta
            
            $respuestas[$key]["asunto"] = $asunto->getTexto();
            $respuestas[$key]["respuestas"] = [];
            
            for ($index = 0; $index < count($asunto->opciones); $index++) {
                $tipo = get_class($asunto->opciones[$index]);
                switch ($tipo) {
                    case "OpcionAbierta":
                        $respuestas[$key]["respuestas"]["Abiertas"][] = ["texto"=>$asunto->opciones[$index]->getTexto(),
                        "votos"=>Opciones_bl::countAnswers($asunto->opciones[$index]),
                        "comentarios"=>$comments = $asunto->opciones[$index]->getMyComments(true)];
                    break;
                    case "OpcionMultiple":
                        $respuestas[$key]["respuestas"]["Multiples"][] = ["texto"=>$asunto->opciones[$index]->getTexto(),
                        "votos"=>Opciones_bl::countAnswers($asunto->opciones[$index])];
                    break;
                    case "OpcionPila":
                        $respuestas[$key]["respuestas"]["Pila"] = ["texto"=>$asunto->opciones[$index]->getTexto(),
                        "votos"=>Opciones_bl::countAnswers($asunto->opciones[$index])];
                    break;
                }
            }
        }
        //contamos la cantidad de opciones por asunto para saber la proporción de votos por opción
        foreach ($respuestas as $index => $tipos) {
            foreach ($tipos["respuestas"] as $key => $respuesta) {
                $respuestas[$index]["respuestas"][$key]["opciones"] = count($respuesta);
                $totalVotos = 0;
                foreach ($respuesta as $r) {
                   $totalVotos += $r["votos"];
                }
                $respuestas[$index]["respuestas"][$key]["total_votos"] = $totalVotos;
            }
        }
        
        $this->view->respuestas = $respuestas;
        $this->view->mobileTitle = "Resultados"; //Mobile Version Title
        $this->view->menuHL = "resultados";//menu highlighted option
        $this->view->render($this,"index","Caixa Mágica | Resultados");
         
    }

}
