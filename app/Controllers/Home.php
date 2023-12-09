<?php

namespace App\Controllers;

class Home extends BaseController{

    public $modelHome = NULL;

    public function __construct(){
        $this->modelHome = model("HomeModel");
    }

    public function index(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function cuenta_no_valida(){
        return view('cuenta_no_valida');
    }

    public function homepage(){
        return view('homepage');
    }

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
                $correo = $this->enviar_confirmacion($email, $nombre, $apellido, $token);
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

    public function enviar_confirmacion($email, $nombre, $apellido, $token){
        $emailConfig = [
            'protocol' => 'smtp',
            'SMTPHost' => 'sandbox.smtp.mailtrap.io',
            'SMTPPort' => 2525,
            'SMTPUser' => '03525d321d5cf5',
            'SMTPPass' => '7f75c634acf5b5',
            'mailType' => 'html',
            'charset' => 'UTF-8',
            'SMTPCrypto' => '',
            'wordWrap' => true,
            'newline' => "\r\n"
        ];
        
        $emailSend = \Config\Services::email($emailConfig);
        
        $emailSend->setFrom('lurikoan@gmail.com', 'VideoTrends');
        $emailSend->setTo($email);
        
        $emailSend->setSubject('VideoTrends - Correo Confirmación de Registro de Cuenta');
        
        $dataView = [
            "linkValidCuenta" => "".BASEURL."home/confirmar_mail?tokenAuth=".$token."&email=".$email,
            "Nombre" => $nombre,
            "Apellido" => $apellido
        ];
        
        $emailSend->setMessage(view("validar_mail",$dataView));
        
        return $emailSend->send();
    }
    
    public function confirmar_mail(){
        $token = $this->request->getVar('tokenAuth');
        $email = $this->request->getVar('email');
        
        $result_verificar = $this->modelHome->verificar_token($token,$email);
        if($result_verificar){
            $result_actualizar = $this->modelHome->actualizar_valido($email);
            if($result_actualizar){
                $this->response->redirect(BASEURL);
                //INFORMAR EXITO
            }else{
                //INFORMAR ERROR
            }
        }
    }

    public function iniciar_sesion(){
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');
    
        $result = $this->modelHome->validar_inicio($email, $contrasena);
        return json_encode($result);
    }

}
