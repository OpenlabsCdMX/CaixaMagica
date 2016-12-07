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
class Comentario extends Model{

  protected static $table = "Comentario";
  
  private $id;
  private $texto;
  private $votos;
  
  
  function __construct($id, $texto, $votos) {
      $this->id = $id;
      $this->texto = $texto;
      $this->votos = $votos;
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

  function getVotos() {
      return $this->votos;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setTexto($texto) {
      $this->texto = $texto;
  }

  function setVotos($votos) {
      $this->votos = $votos;
  }
}
