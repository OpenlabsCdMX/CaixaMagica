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
class Contacto_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->mobileTitle = "Contacto"; //Mobile Version Title
        $this->view->menuHL = "contacto";//menu highlighted option
        $this->view->render($this,"index","Caixa Mágica | Contacto");
    }

}
