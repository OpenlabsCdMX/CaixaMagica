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

}
