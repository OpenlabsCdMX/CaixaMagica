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
class Asunto extends Model {

  protected static $table = "Asunto";

  private $id;
  private $texto;
  private $Caixa_id;

  private $has_one = array(
      'Caixa'=>array(
          'class'=>'Caixa',
          'join_as'=>'Caixa_id',
          'join_with'=>'id'
          )
      );
  
  private $has_many = array(
      'OpcionesAbiertas'=>array(
          'class'=>'OpcionAbierta',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'Asunto_id',
          'join_with'=>'OpcionAbierta_id',
          'join_table'=>'Asunto_has_opciones'
          ),
      'OpcionesMultiples'=>array(
          'class'=>'OpcionMultiple',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'Asunto_id',
          'join_with'=>'OpcionMultiple_id',
          'join_table'=>'Asunto_has_opciones'
          )
      );
  

  function __construct($id, $texto, $Caixa_id) {
      $this->id = $id;
      $this->texto = $texto;
      $this->Caixa_id = $Caixa_id;
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

  function getTexto() {
      return $this->texto;
  }

  function getCaixa_id() {
      return $this->Caixa_id;
  }

  function getHas_one() {
      return $this->has_one;
  }

  static function setTable($table) {
      self::$table = $table;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setTexto($texto) {
      $this->texto = $texto;
  }

  function setCaixa_id($Caixa_id) {
      $this->Caixa_id = $Caixa_id;
  }

  function setHas_one($has_one) {
      $this->has_one = $has_one;
  }

}
