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
      $this->panel();
    }

    public function panel()
    {
      $this->view->render($this,"panel","Admin Panel | Caixa Mágica");
    }

}
