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
class Index_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->caixas = Caixa_bl::get();
        $this->view->mobileTitle = "Caixa Mágica"; //Mobile Version Title
        $this->view->menuHL = "inicio";//menu highlighted option
        $this->view->render($this,"index","Caixa Mágica");
    }
    
    public function asunto($idCaixa)
    {
        $this->view->asuntos = Caixa_bl::getAsuntos($idCaixa);
        $this->view->mobileTitle = "Caixa Mágica"; //Mobile Version Title
        $this->view->menuHL = "inicio";//menu highlighted option
        $this->view->render($this,"asunto","Caixa Mágica");
    }
    
    public function gracias()
    {
        $this->view->idOpcion = $_GET["id"];
        $this->view->tipoOpcion = $_GET["tipo"];
        $this->view->mobileTitle = "Caixa Mágica"; //Mobile Version Title
        $this->view->menuHL = "inicio";//menu highlighted option
        $this->view->render($this,"gracias","Caixa Mágica");
    }
    
    public function participar()
    {
        $usr = new Usuario(null);
        $usr->create();
        
        $opciones = $_POST["opciones"]; 
        $opts = [];
        foreach ($opciones as $key => $opcion) {
            //$data[$key][$opcion["key"]] = $opcion["value"];
           /* if(!empty($opcion["comments"])){
                $data[$key]["comments"] = $opcion["comments"];
            }*/
            $opts[$key] = Usuarios_bl::responder(substr($opcion["key"], 0, -3),$opcion["value"]);
            
            $regla = "";
            switch (substr($opcion["key"], 0, -3)) {
                case "OpcionMultiple":
                    $regla = "RespuestasMultiples";
                 break;
             case "OpcionAbierta":
                    $regla = "RespuestasAbiertas";
                    $comment = new Comentario(null,$opcion["comments"],0);
                    print_r($comment->create());
                    $opts[$key]->has_many("Comentarios",$comment);
                    $opts[$key]->update();
                 break;
             case "OpcionPila":
                    $regla = "RespuestasPila";
                 break;
            }
            //print("regla: ".$regla);
            $usr->has_many($regla, $opts[$key]);
        }
        //print_r($opts);
        $r = $usr->update();
        print_r($r);
    }
    function loQueMeGusta(){
        echo "<h2>¿Qué Te gusta en la escuela?</h2>";
        $comentarios = [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61,63,65,67,69,71,73,75,77,79,81,83,85,87,89];
        foreach ($comentarios as $key => $comentario) {
           $c = Comentario::getById($comentario);
           print(($key+1).". ".$c->getTexto()."</br>");
           
        }
    }
    function loQueMejoraria(){
        echo "<h2>¿Qué mejorarías de tu escuela?</h2>";
    $comentarios = [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50,52,54,56,58,60,62,64,66,68,70,72,74,76,78,80,82,84,86,88,90];
        foreach ($comentarios as $key => $comentario) {
           $c = Comentario::getById($comentario);
           print(($key+1).". ".$c->getTexto()."</br>");
           
        }
    }
    function elAmor(){
        echo "<h2>¿Estás enamorado de alguien en la escuela?</h2>";
        echo "<p>Si: 29</p>";
        echo "<p>No: 7</p>";
        echo "<p>Tal vez: 6</p>";
    }

}
