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
class Usuarios_bl{

  public function responder($opcion,$valor){
      $opcion = call_user_func($opcion .'::getById',$valor);
      return $opcion;
  }

}