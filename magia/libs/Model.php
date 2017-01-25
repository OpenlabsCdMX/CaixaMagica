<?php

/**
 * Description of Model
 *
 * @author pabhoz
 *
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

    public static function whereR($attr,$field, $value, $tableR){
            self::getConnection();
            $sql = "SELECT ".$attr." FROM ".$tableR." WHERE ".$field." = :".$field;
            //print_r($sql);
            $results = self::$db->select($sql, array(":".$field=>$value) );
            return $results;
    }

    public static function whereN($attr,$field, $tableR){
            self::getConnection();
            $sql = "SELECT ".$attr." FROM ".$tableR." WHERE ".$field. " IS NULL";
            $results = self::$db->select($sql );

            return $results;
    }

    public function create($myID = false,$notnull = true){
        self::getConnection();

        $values = $this->getMyVars($this);
        $has_many = self::checkRelationship("has_many",$values);
        self::checkRelationship("has_one",$values);
        self::checkRelationship("known_as",$values);
        
        $result = self::$db->insert(static::$table,$values);
        
        if($result === true){
            $response = array('error'=>0,'getID'=> self::$db->lastInsertId(),'msg'=>  get_class($this).' Created');
            if($myID){
                $myID = ucfirst($myID);
                if(!$notnull){
                    $this->{"set".$myID}( $response["getID"] );
                }
            }else{
                $this->setId( $response["getID"] );
            }
        }else{
            $response = array('error'=>1,'msg'=> 'Error '.$result);
        }
        if($has_many){ 
            $rStatus = self::saveRelationships($has_many); 
            if($rStatus["error"]){
                
            }
        }
        
        return $response;
    }

    public function update($field = "id",$value = null){
        self::getConnection();
            
        $values = $this->getMyVars($this);
        $has_many = self::checkRelationship("has_many",$values);
        self::checkRelationship("has_one",$values);
        self::checkRelationship("known_as",$values);
        
        $value = ($value == null) ? $values["id"] : $value;
        
        $result = self::$db->update(static::$table,$values,$field." = ".$value);

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

    public function has_many($rName, $obj, $data = array()) {
        $has_many = $this->getHas_many();
        if ($has_many[$rName] != null) {
            $rule = $has_many[$rName];
            $rule['my_key'] = ucfirst($rule['my_key']);
            $rule['other_key'] = ucfirst($rule['other_key']);
            if (get_class($obj) == $rule["class"]) {
                if ($this->{"get" . $rule['my_key']}() != null && $obj->{"get" . $rule['other_key']}() != null) {

                    //Logger::debug("rule",$rule);

                    $toSave = array(
                        $rule['join_as'] => $this->{"get" . $rule['my_key']}(),
                        $rule['join_with'] => $obj->{"get" . $rule['other_key']}()
                    );

                    if (isset($data)) {
                        $this->processHMRData($data, $toSave);
                    }

                    $rule['relationships'][] = $toSave;
                    $has_many[$rName] = $rule;
                    $this->setHas_many($has_many);
                } else {
                    print("Se requieren llaves primarias para la relación");
                }
            } else {
                print("No se cumple con el tipo de objeto");
            }
        } else {
            print("No existe este tipo de relación");
        }
    }
    
    private function processHMRData($data, &$toSave) {

        foreach ($data as $key => $atributo) {
            $toSave[$key] = $atributo;
        }
    }

    public function has_one($rName,$obj){
        $relacion = $this->getHas_one();
        if( isset($relacion[$rName]) ){

            $rule = $relacion[$rName];
            if(get_class($obj) == $rule["class"]){
               $this->{"set".ucfirst($rule["join_as"])}($obj->{"get".ucfirst($rule["join_with"])}());
            }else{
                print("No se cumple con el tipo de objeto");
            }

        }else{
            print("No existe este tipo de relación");
        }  
    }
    
    public function known_as($rName,$obj,$update = true){
        $relacion = $this->getKnown_as();
        if( isset($relacion[$rName]) ){

            $rule = $relacion[$rName];
            if(get_class($obj) == $rule["class"]){
               
                print_r( "set".ucfirst($rule["join_with"]) );
               $obj->{"set".ucfirst($rule["join_with"])}($this->{"get".ucfirst($rule["join_as"])}());
               $obj->update();
               
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
        
    public function delete($field = "id",$value = null){
            self::getConnection();
            
            $this->deleteRelationships();
            
            $value = ($value == null) ? $values["id"] : $value;
            $result = self::$db->delete(static::$table,$field." = ".$value);
            
            if($result){
                    $result = array('error'=>0,'message'=>'Objeto Eliminado');
            }else{
                    $result = array('error'=>1,'message'=> self::$db->getError());
            }
            return $result;
    }
    /**
     * Obtener registro por ID 
     * [ Correccion BUG-PRODUCCION ]
     * [ description bug: Only variables should be passed by reference ]
     * @author Jaime Diaz <jaimeivan0017@gmail.com>
     * 
     * @param type $id
     * @return type
     */
    public static function getById($id){
            //asignacion y llamado del método estático where
            $whereReturn = self::where("id",$id);
            $data = array_shift($whereReturn);        
            $result = self::instanciate($data);
            return $result;
    }
    /**
     * Obtener registro por un campo específico, 
     * [ Correccion BUG-PRODUCCION ]
     * [ description bug: Only variables should be passed by reference ]
     * @author Jaime Diaz <jaimeivan0017@gmail.com>
     * 
     * @param type $field
     * @param type $data
     * @return type
     */
    public static function getBy($field,$data,$all = false, $instanced = true){
            //asignacion y llamado del método estático where
            $whereReturn = self::where($field,$data);
            
            $data = (!$all) ? array_shift($whereReturn) : $whereReturn; 
            if(!$all){
                if($instanced){
                        $data = self::instanciate($data);
                }                
            }else{
               if($instanced){
                    foreach ($data as $key => $element) {
                        $data[$key] = self::instanciate($element);
                    }
                }
            }

            return $data;
    }
    
    public function getAttrTable($table){
            self::getConnection();
            $attr = self::$db->getAttr($table);
            return $attr;
    }
    
    public static function getManyToManyData($selected){
            self::getConnection();
            $reflector = new ReflectionClass(get_called_class());
            $ints = $reflector->newInstanceWithoutConstructor();
            $table = null;
            if (method_exists($ints, 'getHas_many')) {
              $relationships = $ints->getHas_many();
              foreach ($relationships as $key => $value) {
                  $query = "SELECT A.* FROM ".$value['join_table']." P INNER JOIN ".$value['class']." U ON P.".$value['join_as']." = U.id
                          INNER JOIN ".$key." A ON P.".$value['join_with']." = A.id WHERE U.id = '".$selected."'";
                  $table[$key.'_ManyToMany'] = self::$db->select($query);
              }
            }
            return $table;
    }
    
    public function deleteRelationships(){
        $hm = $this->getHas_many();
        if(!empty($hm)){
            self::getConnection();
            $toDelete = [];
            foreach ($hm as $rule=>$val) {
                $result = self::$db->delete(
                        $val["join_table"],
                        $val["join_as"]." = ".$this->{"get".ucfirst($val["my_key"])}()
                        );

            }
        }
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
}