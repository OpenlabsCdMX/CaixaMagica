<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asuntos_bl
 *
 * @author Pabhoz
 */
class Asuntos_bl {

  public function get($id = null){
      if($id){
          return Asunto::getById($id);
      }else{
          $asuntos = Asunto::getAll();
          foreach ($asuntos as $asunto) {
             $r[] = Asunto::instanciate($asunto);
          }
          return $r;
      }
  }
  
  public function getByCaixa($idCaixa){
      return Asunto::getBy("Caixa_id",$idCaixa);
  }
  
  public function getOptions($idAsunto){
      return Opciones_bl::getByAsunto($idAsunto);
  }
}