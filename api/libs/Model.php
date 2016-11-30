<?php

/**
 * Description of Model
 *
 * @author pabhoz
 * @coauthors Sebas7103 - CamiloPochi
 */
class Model {

    private static $db;
    protected static $table;

    private static function getConnection(){
     if(!isset(self::$db)){
        self::$db = new Database(_DB_TYPE,_DB_HOST,_DB_NAME,_DB_USER,_DB_PASS);
     }
    }

    public function getRelationship($t){
        self::getConnection();
        return self::$db->getRelationship($t);
    }


    public static function setTable($table){
        self::$table = $table;
    }

    public static function getAll(){
        self::getConnection();
        $sql = "SELECT * FROM ".static::$table.";";
        return $results = self::$db->select($sql);
    }

    public static function where($field, $value){
        self::getConnection();
        $sql = "SELECT * FROM ".static::$table." WHERE ".$field." = :".$field;
        $results = self::$db->select($sql, array(":".$field=>$value) );
        return $results;
    }

        public static function search($where, $data = array(), $limit = null) {
        self::getConnection();
        if (is_null($limit)) {
            $limit = "";
        } else {
            $limit = "LIMIT " . $limit;
        }
        $sql = "SELECT * FROM " . static::$table . " WHERE " . $where . " " . $limit;
        return $results = self::$db->select($sql, $data);
    }

    public static function whereR($attr,$field, $value, $tableR){
            self::getConnection();
            $sql = "SELECT ".$attr." FROM ".$tableR." WHERE ".$field." = :".$field;
            $results = self::$db->select($sql, array(":".$field=>$value) );

            return $results;
    }

    public static function whereN($attr,$field, $tableR){
            self::getConnection();
            $sql = "SELECT ".$attr." FROM ".$tableR." WHERE ".$field. " IS NULL";
            $results = self::$db->select($sql );

            return $results;
    }

    public function create(){
        self::getConnection();

        $values = $this->getMyVars($this);
        $has_many = self::checkRelationship("has_many",$values);
        self::checkRelationship("has_one",$values);

        $result = self::$db->insert(static::$table,$values);

        if($result === true){
            $response = array('error'=>0,'getID'=> self::$db->lastInsertId(),'msg'=>  get_class($this).' Created');
            $this->setId( $response["getID"] ) ;
        }else{
            $response = array('error'=>1,'msg'=> 'Error '.$result);
        }
        if($has_many){
            $rStatus = self::saveRelationships($has_many);
            if($rStatus["error"]){
                //Logger::alert("Error saving relationships",$rStatus["trace"],"create");
            }
        }

        return $response;
    }

    public function update(){
        self::getConnection();

        $values = $this->getMyVars($this);
        $has_many = self::checkRelationship("has_many",$values);
        self::checkRelationship("has_one",$values);

        $result = self::$db->update(static::$table,$values,"id = ".$values["id"]);

        if($result){
            $response = array('error'=>0,'msg'=>  get_class($this).' Updated');
        }else{
            $response = array('error'=>1,'msg'=> 'Error '.$result);
        }
        if($has_many){
            $rStatus = self::saveRelationships($has_many);
            if($rStatus["error"]){
                //Logger::alert("Error saving relationships",$rStatus["trace"],"save");
            }
        }
        //Logger::debug("result",$result,"save");
        return $response;
    }

    public function saveRelationships($relationships){
            $log = array("error"=>0,"trace"=>array());
            foreach ($relationships as $name => $rules) {
                if(isset($rules['relationships'])){
                    foreach ($rules['relationships'] as $key => $relacion) {
                        $table = $rules["join_table"];
                        $result = self::$db->insert($table,$relacion);
                        //TODO Check result
                    }
                }
            }
            return $log;
    }

    public function has_many($rName,$obj){
         $has_many = $this->getHas_many();
            if($has_many[$rName] != null){
                $rule = $has_many[$rName];
                $rule['my_key'] = ucfirst($rule['my_key']);
                $rule['other_key'] = ucfirst($rule['other_key']);
                if(get_class($obj) == $rule["class"]){
                    if( $this->{"get".$rule['my_key']}()
                    != null && $obj->{"get".$rule['other_key']}() != null ){
                        $rule['relationships'][]= array(
                          $rule['join_as']=>$this->{"get".$rule['my_key']}(),
                          $rule['join_with']=>$obj->{"get".$rule['other_key']}()
                        );
                        $has_many[$rName] = $rule;
                        $this->setHas_many($has_many);
                    }else{
                        print("Se requieren llaves primarias para la relación");
                    }
                }else{
                    print("No se cumple con el tipo de objeto");
                }
            }else{
                print("No existe este tipo de relación");
            }
        }

    public function has_one($rName,$obj){
        $has_one = $this->getHas_one();
        if( isset($has_one[$rName]) ){

            $rule = $has_one[$rName];
            if(get_class($obj) == $rule["class"]){
               $this->{"set".ucfirst($rule["join_as"])}($obj->{"get".ucfirst($rule["join_with"])}());
            }else{
                print("No se cumple con el tipo de objeto");
            }

        }else{
            print("No existe este tipo de relación");
        }
    }

    public function set($attr,$value){
        $this->{$attr} = $value;
    }

    public function checkRelationship($rType,&$data){
            if( isset($data[$rType]) ){
                $relationship = $data[$rType];
                unset($data[$rType]);
                return $relationship;
            }else{
                return false;
            }
        }

    public function delete(){
            self::getConnection();

            self::deleteRelationships();

            $result = self::$db->delete(static::$table,"id = ".$this->getId());

            if($result){
                    $result = array('error'=>0,'message'=>'Objeto Eliminado');
            }else{
                    $result = array('error'=>1,'message'=> self::$db->getError());
            }
            return $result;
    }

    public function deleteRelationships(){
      $has_many = $this->getHas_many();
      if(empty($has_many)){exit;}
      self::getConnection();
      foreach ($has_many as $rule) {
        $result = self::$db->delete($rule["join_table"],$rule["join_self_as"]." = ".$this->getId());
      }
    }

    public static function getById($id){
            $data = array_shift(self::where("id",$id));
            $result = self::instanciate($data);
            return $result;
    }

    public static function getBy($field,$data){
            $data = array_shift(self::where($field,$data));
            $result = self::instanciate($data);
            return $result;
    }

    public function getAttrTable($table){
            self::getConnection();
            $attr = self::$db->getAttr($table);
            return $attr;
    }

    public function toArray(){
        $arr = [];
        foreach ($this->getMyVars() as $key => $value) {
            if($key != "has_one" && $key != "has_many"){
                $arr[$key] = $this->{"get".$key}();
            }
        }
        return $arr;
    }

    public static function instanciate($args){

        if (count($args) > 1)
        {
            $refMethod = new ReflectionMethod(get_called_class(),  '__construct');
            $params = $refMethod->getParameters();
            $re_args = array();
            foreach($params as $key => $param)
            {
                if ($param->isPassedByReference())
                {
                    $re_args[$param->getName()] = &$args[$param->getName()];
                }
                else
                {
                    $re_args[$param->getName()] = $args[$param->getName()];
                }
            }

            $refClass = new ReflectionClass(get_called_class());
            return $refClass->newInstanceArgs((array) $re_args);
        }
    }

    public static function getKeys(){
        $refMethod = new ReflectionMethod(get_called_class(),  '__construct');
        $params = $refMethod->getParameters();
        $keys = [];
        foreach($params as $key => $param)
            {
              $keys[$key] = $param->getName();
            }
        return $keys;
    }

    public static function getManyToMany($join_table, $related_table, $me, $id, $extra=''){
      self::getConnection();
      $query = "SELECT U.* FROM ".$join_table." P INNER JOIN ".$me." U ON P.id_".$me." = U.id
              INNER JOIN ".$related_table." A ON P.id_".$related_table." = A.id WHERE A.id = '".$id."' ".$extra;
      $table[$me] = self::$db->select($query);
      return $table;
    }
}
