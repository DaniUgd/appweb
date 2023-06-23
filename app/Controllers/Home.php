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
        return view('login');
    }

    public function register(){
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
        $re_contrasena = $this->request->getPost('re_contrasena');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $direccion = $this->request->getPost('direccion');
        $genero = $this->request->getPost('genero');
        $telefono = $this->request->getPost('telefono');
        $nacimiento = $this->request->getPost('nacimiento');
        $token = $this->request->getPost('token');
        
        //Validacion usuario
        $validation = service('validation');
        $validation->setRules([
            'usuario' => 'required|alpha_numeric|is_unique[usuario.Usuario]',
            'email' => 'required|valid_email|is_unique[usuario.Email]',
            'contrasena' => 'required|matches[re_contrasena]',
            'nombre' => 'alpha_space',
            'apellido' => 'alpha_space',
            'direccion' => 'alpha_numeric_space',
            'genero' => 'numeric',
            'telefono' => 'decimal',
            'nacimiento' => 'valid_date'
        ]);

        if($validation->withRequest($this->request)->run()){
            $result = $this->modelHome->registrar_usuario($usuario, $email, $contrasena, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento, $token);
            
            if($result){
                //Enviar correo de confirmación
                $correo = $this->modelHome->correo_confirmacion($email, $nombre, $apellido, $token);
            }

            return json_encode($result && $correo);
        }else{
            dd($validation->getErrors());
        }
        
    }

    public function validar_email(){
        $email = $this->request->getPost('email');
        $data = $this->modelHome->get_email($email);

        return json_encode($data);
    }
}
