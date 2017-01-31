<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error_controller
 *
 * @author pabhoz
 */
class Error_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render($this,"index","Certeza ERP");
    }
     public function method()
    {
        $this->view->render($this,"method","Certeza ERP");
    }

}
