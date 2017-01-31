<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_controller
 *
 * @author pabhoz
 */
class Login_controller extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render($this,"index","Login | Certeza ERP");
    }

    public function login()
    {
      $r = [];
        if(isset($_POST["usuario"]) && isset($_POST["password"])){
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            if($usuario == "pabhoz" && $password == "1234"){
              Session::set("uid",1);
              $r = ["error" => 0, "msg" => "Bienvenido"];
            }else{
              $r = ["error" => 1, "msg" => "Nombre de usuario o contraseña incorrecto"];
            }
        }else{
          $r = ["error" => 1, "msg" => "Debe proveer todos los datos"];
        }

        print(json_encode($r));
    }

    public function logout()
    {
      Session::destroy();
      header("location:".URL);
    }

}
