<?php

namespace App\Controllers;

class Home extends BaseController{

    public $modelHome = NULL;

    public function __construct(){
        $this->modelHome = model("HomeModel");
    }

    public function index(){
        // $data = $this->modelHome->usuario_list();
        // echo var_dump($data);
        return view('register');
    }

    // public function test(){
        // $resultado = trim($this->request->getPost('usuario'));
    //     $data = $this->modelHome->get_usuario($resultado);

    //     return json_encode($data);
    // }

    public function insert_usuario(){
        $usuario = $this->request->getPost('usuario');
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $direccion = $this->request->getPost('direccion');
        $genero = $this->request->getPost('genero');
        $telefono = $this->request->getPost('telefono');
        $nacimiento = $this->request->getPost('nacimiento');
        
        $result = $this->modelHome->registrar_usuario($usuario, $email, $contrasena, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento);
    }

    public function validar_email(){
        console.log("controlador");
        $email = $this->request->getPost('email');
        $data = $this->modelHome->get_email($email);

        return $data;
    }
}
