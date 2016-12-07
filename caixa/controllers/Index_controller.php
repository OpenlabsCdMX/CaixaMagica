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

}
