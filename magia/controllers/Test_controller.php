<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test_controller
 *
 * @author pabhoz
 */
class Test_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        print_r(Equipos_bl::listar());
    }

}
