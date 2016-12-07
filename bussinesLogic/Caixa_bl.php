<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caixa_bl
 *
 * @author Pabhoz
 */
class Caixa_bl {

  public function get($id = null){
      if($id){
          return Caixa::getById($id);
      }else{
          $caixas = Caixa::getAll();
          foreach ($caixas as $caixa) {
             $r[] = Caixa::instanciate($caixa);
          }
          return $r;
      }
  }
  
  public function getAsuntos($id){
      $asuntos  = Asuntos_bl::getByCaixa($id);
      foreach ($asuntos as $key => $asunto) {
          $asunto->opciones = Opciones_bl::getByAsunto($asunto->getId());
      }
      return $asuntos;
  }
}
