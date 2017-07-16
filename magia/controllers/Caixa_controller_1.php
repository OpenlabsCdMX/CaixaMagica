<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caixa_controller
 *
 * @author pabhoz
 */
class Caixa_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function listar()
    {
      $this->view->caixas = Caixa_bl::get(false,true);
      $this->view->sectionTitle = "Caixas";
      $this->view->sectionStitle = "Listar";
      $this->view->render($this,"listar","Caixa Mágica | Caixas");
    }

    public function crear()
    {
      $this->view->caixas = Caixa_bl::get(false,true);
      $this->view->sectionTitle = "Caixas";
      $this->view->sectionStitle = "Crear";
      $this->view->render($this,"crear","Caixa Mágica | Caixas");
    }

    public function create(){
        //print_r($_POST);
        $r = Caixa_bl::create($_POST);
        print(json_encode($r));
    }

    public function editar($id)
    {
      $this->view->caixa = Caixa::getById($id);
      $this->view->asuntos = Caixa_bl::getAsuntos($id);
      $this->view->sectionTitle = "Caixas";
      $this->view->sectionStitle = "Editar";
      $this->view->render($this,"editar","Caixa Mágica | Caixas");
    }

    public function edit(){
      $data = filter_input_array(INPUT_POST)["caixa"];
      $caixa = new Caixa($data["id"], $data["nombre"], $data["fecha_ini"], 
              $data["fecha_fin"]);
      
      $asuntos = [];
      $key = 0;
      foreach ($data["asuntos"] as $asunto) {
          
          if(is_null($asunto["id"]) || $asunto["id"] == ''){
            $asuntos[$key] = new Asunto($asunto["id"], $asunto["texto"], $caixa->getId());
            //TODO handle response $r = $asuntos[$key]->create();
            $r = $asuntos[$key]->create();
          }else{
            $asuntos[$key] = Asunto::getById($asunto["id"]);
            $asuntos[$key]->setTexto($asunto["texto"]);
            //TODO handle response $r = $asuntos[$key]->update();
            $r = $asuntos[$key]->update();
          }
          $asuntos["opciones"] = [];
          
          foreach ($asunto["opciones"] as $opcion) {
            $asuntos["opciones"][] = self::initOption($opcion);
          }
          
            $key++;
      }
      
      print_r($asuntos);
      
    }
    
    private function initOption($optArr){
        switch ($optArr["tipo"]) {
            case "OpcionAbierta":
                return new OpcionAbierta($optArr["id"], $optArr["texto"]);
            case "OpcionMultiple":
                return new OpcionMultiple($optArr["id"], $optArr["texto"]);
            case "OpcionPila":
                //return new OpcionPila($optArr["id"], $optArr["texto"]);
                break;
        }
    }

}
