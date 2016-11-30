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
class About_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->mobileTitle = "¿Qué es Caixa Mágica?"; //Mobile Version Title
        $this->view->menuHL = "about";//menu highlighted option
        $this->view->render($this,"index","Caixa Mágica | ¿Qué es Caixa Mágica?");
    }

}
