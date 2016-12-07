<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Pabhoz
 */
class Caixa extends Model {

  protected static $table = "Caixa";

  private $id;
  private $nombre;
  private $fecha_ini;
  private $fecha_fin;

  private $known_as = array(
        
            'CaixaDe' => array(
                'class' => 'Asunto',
                'join_as' => 'id',
                'join_with' => 'Caixa_id'
            )
        
  );

  function __construct($id, $nombre, $fecha_ini, $fecha_fin) {
      $this->id = $id;
      $this->nombre = $nombre;
      $this->fecha_ini = $fecha_ini;
      $this->fecha_fin = $fecha_fin;
  }

  public function getMyVars(){
      return get_object_vars($this);
  }
  
  static function getTable() {
      return self::$table;
  }

  function getId() {
      return $this->id;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getFecha_ini() {
      return $this->fecha_ini;
  }

  function getFecha_fin() {
      return $this->fecha_fin;
  }

  function getKnown_as() {
      return $this->known_as;
  }

  static function setTable($table) {
      self::$table = $table;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setFecha_ini($fecha_ini) {
      $this->fecha_ini = $fecha_ini;
  }

  function setFecha_fin($fecha_fin) {
      $this->fecha_fin = $fecha_fin;
  }


}
