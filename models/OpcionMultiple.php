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
class OpcionMultiple extends Model {
    
  protected static $table = "OpcionMultiple";
  private $id;
  private $texto;


  private $has_many = array(
      'Asunto'=>array(
          'class'=>'Asunto',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'OpcionMultiple_id',
          'join_with'=>'Asunto_id',
          'join_table'=>'Asunto_has_opciones'
          )
      );

  function __construct($id, $texto) {
      $this->id = $id;
      $this->texto = $texto;
  }

  public function getMyVars(){
      return get_object_vars($this);
  }
  
  function getId() {
      return $this->id;
  }

  function getTexto() {
      return $this->texto;
  }

  function getHas_many() {
      return $this->has_many;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setTexto($texto) {
      $this->texto = $texto;
  }

  function setHas_many($has_many) {
      $this->has_many = $has_many;
  }

}