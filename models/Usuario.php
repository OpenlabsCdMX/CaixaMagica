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
class Usuario extends Model {

  protected static $table = "Usuario";

  private $id;

  private $has_many = array(
      'RespuestasAbiertas'=>array(
          'class'=>'OpcionAbierta',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'Usuario_id',
          'join_with'=>'OpcionAbierta_id',
          'join_table'=>'Respuestas'
          ),
      'RespuestasMultiples'=>array(
          'class'=>'OpcionMultiple',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'Usuario_id',
          'join_with'=>'OpcionMultiple_id',
          'join_table'=>'Respuestas'
          ),
      'RespuestasPila'=>array(
          'class'=>'OpcionPila',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'Usuario_id',
          'join_with'=>'OpcionPila_id',
          'join_table'=>'Respuestas'
          )
      );
  
  function __construct($id) {
      $this->id = $id;
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

  function getHas_many() {
      return $this->has_many;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setHas_many($has_many) {
      $this->has_many = $has_many;
  }



}
