<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Views
 *
 * @author PabloAnibal
 */
class View {
    
    public function render($controller,$view,$title = ''){
        
        $controller = get_class($controller);
        $controller = substr($controller, 0, -11);
        $path = './views/'.$controller.'/'.$view;
        
        if(file_exists($path.".php")){
            if ($title != "") {
                $this->title = $title;
            }
            require $path.".php";
        }elseif (file_exists($path.".html")) {
            if ($title != "") {
                $this->title = $title;
            }
            require $path.".html";
        }else{
            echo "Error: Invalid view ".$view." to render";
        }
    }
    
    public function reloadThis($uri){
      echo '$.ajax({
                  method:"GET",
                  url: "'.URL.$uri.'"
            }).done(function(response){
                  $("#asyncLoadArea").html(response);
      });';
    }
    
    public function loadModule($module,$params = []) {

        $linkStyles = (isset($params["linkStyles"])) ? $params["linkStyles"] : false;
        $stylesheets = "";
        
        if($linkStyles){
          
          $stylesheets = array_map(function($style){
            return $this->linkStyle($style);
          },$linkStyles);

          $stylesheets = join("\n",$stylesheets);
        }

        if (file_exists(MODULE . $module . '.php')) {
            require MODULE . $module . '.php';
        } else {
            die('Error, not valid Admin module: ' . $module . ' to load');
        }
    }

    public function linkStyle($stylesheet){
      $public = "public/styles/".$stylesheet.".css";
      return '<link rel="stylesheet" href="'.URL.$public.'"/>';
    }
    
}
