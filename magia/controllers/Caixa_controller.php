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
      
      if(is_null($data["id"]) || $data["id"] == ''){
          $caixa = new Caixa($data["id"], $data["nombre"], $data["fecha_ini"], 
              $data["fecha_fin"]);
      }else{
          //TODO: check changes to update just changed values
          $caixa = Caixa::getById($data["id"]);
          $caixa->setNombre($data["nombre"]);
          $caixa->setFecha_ini($data["fecha_ini"]);
          $caixa->setFecha_fin($data["fecha_fin"]);
          $r = $caixa->update();
      }
      
      //hotfix prevent null pointer at array position
      if(!isset($data["asuntos"])){ $data["asuntos"] = []; }
      foreach ($data["asuntos"] as $asunto) {
          
          if(is_null($asunto["id"]) || $asunto["id"] == ''){
            $issue = new Asunto($asunto["id"], $asunto["texto"], $caixa->getId());
            //TODO handle response $r = $asuntos[$key]->create();
            $r = $issue->create();
          }else{
            $issue = Asunto::getById($asunto["id"]);
            $issue->setTexto($asunto["texto"]);
            //TODO handle response $r = $asuntos[$key]->update();
            $r = $issue->update();
          }
          
          //hotfix prevent null pointer at array position
          if(!isset($asunto["opciones"])){ $asunto["opciones"] = []; }
          foreach ($asunto["opciones"] as $opcion) {
            $optR = self::initOption($opcion,$issue);
          }
      }
      //TODO: Return some kind of response based on response handlings
      print(json_encode($r));
    }
    
    private function initOption($optArr,$asunto){
        
        if(is_null($optArr["id"]) || $optArr["id"] == ''){
            switch ($optArr["tipo"]) {
                case "OpcionAbierta":
                    $option = new OpcionAbierta($optArr["id"], $optArr["texto"]);
                    //TODO: Handle $r
                    $r = $option->create();
                    $option->has_many("Asunto",$asunto);
                    return $option->update();
                case "OpcionMultiple":
                    $option = new OpcionMultiple($optArr["id"], $optArr["texto"]);
                    //TODO: Handle $r
                    $r = $option->create();
                    $option->has_many("Asunto",$asunto);
                    return $option->update();
                case "OpcionPila":
                    //return new OpcionPila($optArr["id"], $optArr["texto"]);
                    break;
            }
        }else{
            switch ($optArr["tipo"]) {
                case "OpcionAbierta":
                    $option = OpcionAbierta::getById($optArr["id"]);
                    $option->setTexto($optArr["texto"]);
                    return $option->update();
                case "OpcionMultiple":
                    $option = OpcionMultiple::getById($optArr["id"]);
                    $option->setTexto($optArr["texto"]);
                    return $option->update();
                case "OpcionPila":
                    //return new OpcionPila($optArr["id"], $optArr["texto"]);
                    break;
            }        
        }
    }
    
    public function delete($id){
        $caixa = Caixa::getById($id);
        //getting all asuntos realated to this caixa
        $asuntos = Asunto::getBy("Caixa_id",$id);
        if(empty($asuntos)){ $asuntos = []; }
        //print_r($asuntos);
        foreach ($asuntos as $asunto) {
        //delete all options related to this asunto then delete the asunto
            Model::deleteHasMany("Asunto_has_opciones" ,"Asunto_id", $asunto->getId());
            //TODO: Handle $r
            $r = $asunto->delete();
        }
        //TODO: Handle $r
        $r = $caixa->delete();
        print(json_encode($r));
    }

}
