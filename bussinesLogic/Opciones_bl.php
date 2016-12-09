<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Opciones_bl
 *
 * @author Pabhoz
 */
class Opciones_bl{

  public function getOpcionAbierta($id = null){
      if($id){
          return OpcionAbierta::getById($id);
      }else{
          $opciones = OpcionAbierta::getAll();
          foreach ($opciones as $opcion) {
             $r[] = OpcionAbierta::instanciate($opcion);
          }
          return $r;
      }
  }
  
  public function getByAsunto($idAsunto){
      $opciones = Model::whereR("OpcionAbierta_id,OpcionMultiple_id,OpcionPila_id",
              "Asunto_id", $idAsunto, "Asunto_has_opciones");
      
      foreach ($opciones as $key => $opcion) {
          $el = array_filter($opcion);
          foreach ($el as $index => $value) {
              $opt = substr($index, 0, -3);
              $opciones[$key] = call_user_func($opt .'::getById',$value);
          }
      }
      
      return $opciones;
  }
  
  public function getCaixa($opcion){
      $tipo = get_class($opcion);
      $asunto = Asunto::whereR("Asunto_id", $tipo."_id", $opcion->getId(),"Asunto_has_opciones")[0]["Asunto_id"];
      $asunto = Asunto::getById($asunto);
      $caixa = Caixa::getById($asunto->getCaixa_id());
      return $caixa;
  }
  
  public function countAnswers($opcion){
      $tipo = get_class($opcion);
      $count = Model::whereR("COUNT(".$tipo."_id)", $tipo."_id", $opcion->getId(),"Respuestas")[0]["COUNT(".$tipo."_id)"];
      return $count;
  }

}