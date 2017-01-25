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

}
