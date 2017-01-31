<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipos_controller
 *
 * @author pabhoz
 */
class Equipos_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function listar()
    {
      $this->view->equipos = Equipos_bl::listar();
      $this->view->sectionTitle = "Equipos";
      $this->view->sectionStitle = "Listar";
      $this->view->render($this,"listar","Certeza ERP | Equipos");
    }

    public function asignar()
    {
      $this->view->operadores = Empleados_bl::operadoresDisponibles();
      $this->view->equipos = Equipos_bl::equiposDisponibles();
      $this->view->sectionTitle = "Equipos";
      $this->view->sectionStitle = "asignación a operarios";
      $this->view->render($this,"asignar","Certeza ERP | Equipos");
    }

    public function prestamo()
    {
        print_r($_POST);
        $operario = Empleado::getBy("documento", $_POST["documentoOperario"]);
        foreach ($_POST["equipos"] as $key => $equipo) {
            print_r(Equipo::getBy("serial",$equipo));
           //$operario->has_many("Prestamos",Equipo::instanciate($equipo));
        }
        //$r = $operario->update();
        //print_r($r);

    }

    public function estado()
    {
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

      $month = $meses[date('n')-1]." ".date("Y");
      $this->view->sectionTitle = "Estado";
      $this->view->month = $month;
      $this->view->sectionStitle = $month;
      $this->view->render($this,"estado","Certeza ERP | Equipos");
    }
}
