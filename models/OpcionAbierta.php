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
class OpcionAbierta extends Model{

  protected static $table = "OpcionAbierta";
  private $id;
  private $texto;
  
  private $has_many = array(
      'Asunto'=>array(
          'class'=>'Asunto',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_as'=>'OpcionAbierta_id',
          'join_other_as'=>'Asunto_id',
          'join_table'=>'Asunto_has_opciones'
          ),
      'Comentarios'=>array(
          'class'=>'Comentario',
          'my_key'=>'id',
          'other_key'=>'id',
          'join_self_as'=>'OpcionAbierta_id',
          'join_other_as'=>'Comentario_id',
          'join_table'=>'OpcionAbierta_has_Comentario'
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
  
  function getMyComments($returnArray = false){
      $comments = Comentario::whereR("Comentario_id", "OpcionAbierta_id", $this->getId(), "OpcionAbierta_has_comentario");
      foreach ($comments as $key => $comment) {
          $comments[$key] = Comentario::getById($comment["Comentario_id"]);
          $comments[$key] = ($returnArray) ? $comments[$key]->toArray() : $comments[$key];
      }
      return $comments;
  }

}