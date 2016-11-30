<?php
/**
 *  En memoria de Penelope.
 *  Penelope es una clase estatica para evitar errores de codificación (a nivel
 *  local, es decir, en entornos de desarrollo),al codificar un arreglo de PHP 
 *  a JSON; de esta manera evitamos tener
 *  que configurar el entorno de desarrollo.
 * 
 * @author Pabhoz
 */
class Penelope {

    public static function arrayToJSON($array) {
       
        if(isset($array[0])){
            foreach ($array as $datakey => $data) {
                foreach ($data as $key => $values) {
                    $array[$datakey][$key] = utf8_encode($values);
                }
            }
        }else{
            foreach ($array as $key => $values) {
                    $array[$key] = utf8_encode($values);
                }
        }
        return (!LOCAL_SERVER)? utf8_decode(json_encode($array, JSON_UNESCAPED_UNICODE)) 
                : json_encode($array, JSON_UNESCAPED_UNICODE);
    }
    
    public static function printJSON($array) {
        
        print(Penelope::arrayToJSON($array));

    }

}
