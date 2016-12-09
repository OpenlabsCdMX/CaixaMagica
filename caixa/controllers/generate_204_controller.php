<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generate_204
 * Controlador creado para redireccionar el portal cautivo en android
 * @author pabhoz
 */
class generate_204_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        header("location:".URL);
    }

}
