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
class Example extends Model {

  protected static $table = "Example";

  private $attr1;
  private $attr2;

  private $has_one = array(
      'RuleName'=>array(
          'class'=>'[Obj class expected]',
          'join_as'=>'[foreign key attr]',
          'join_with'=>'[my primary key attr]'
          )
      );

   private $known_as = array(
        
            'Owner' => array(
                'class' => 'Tienda',
                'join_as' => 'id',
                'join_with' => 'owner'
            )
        
        );

  private $has_many = array(
      'RuleName'=>array(
          'class'=>'[Obj class expected]',
          'my_key'=>'[my primary key attr]',
          'other_key'=>'[the other entity primary key attr]',
          'join_as'=>'[my attr at n to n table]',
          'join_with'=>'[the other attr at n to n table]',
          'join_table'=>'[N to N table name]'
          )
      );

  function __construct($attr1,$attr2) {
        $this->attr1 = $attr1;
        $this->attr2 = $attr2;
  }

  public function getMyVars(){
      return get_object_vars($this);
  }

  function getAttr1() {
      return $this->attr1;
  }

  function getAttr2() {
      return $this->Attr2;
  }

  function setAttr2($value) {
      $this->attr1 = $value;
  }

  function setAttr2($value) {
      $this->attr2 = $value;
  }

  function getHas_one() {
      return $this->has_one;
  }

  function getHas_many() {
      return $this->has_many;
  }

  function setHas_one($has_one) {
      $this->has_one = $has_one;
  }

  function setHas_many($has_many) {
      $this->has_many = $has_many;
  }


}
