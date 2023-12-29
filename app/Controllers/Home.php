<?php

namespace App\Controllers;

use DateTime;

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
        log_message("info","Controlador Contra:".$contrasena);

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
    
        $datos = $this->modelHome->validar_inicio($email, $contrasena);
        if($datos['valid']){
            $this->response->setCookie("cookie_usuario",
                                        $value = $datos['usuario'],
                                        $expire = new DateTime('+12 hours'),
                                        $domain = '',
                                        $path = '/',
                                        $prefix = '',
                                        $secure = false,
                                        $httponly = false,);
            return json_encode($datos['usuario']);
        }else{
            if($datos['usuario']!=null){
                $this->response->setCookie("cookie_usuario",
                                            $value = $datos['usuario'],
                                            $expire = new DateTime('+12 hours'),
                                            $domain = '',
                                            $path = '/',
                                            $prefix = '',
                                            $secure = false,
                                            $httponly = false,);
                return json_encode('000');
            }else{
                return json_encode('111');
            }
        }

    }

    public function cerrar_sesion(){
        $this->response->setCookie("cookie_usuario",
                                        $value = '',
                                        $expire = new DateTime('-12 hours'),
                                        $domain = '',
                                        $path = '/',
                                        $prefix = '',
                                        $secure = false,
                                        $httponly = false,);
        
        return json_encode(true);
    }

    public function cargar_datos(){
        $usuario = $_COOKIE["cookie_usuario"];

        $result = $this->modelHome->get_usuario($usuario);

        return json_encode($result);
    }

    public function guardar_datos(){
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

        $result = $this->modelHome->update_usuario($usuario, $email, $contrasena, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento, $token);
        $correo = true;
        if($result && $email!=null){
            //Enviar correo de confirmación
            $correo = $this->enviar_confirmacion($email, $nombre, $apellido, $token);
        }
        if($result){
            $this->response->setCookie("cookie_usuario",
                                        $value = $usuario,
                                        $expire = new DateTime('+12 hours'),
                                        $domain = '',
                                        $path = '/',
                                        $prefix = '',
                                        $secure = false,
                                        $httponly = false,);
        }

        return json_encode($result && $correo);
    }

    //CONEXION TRAKT API
    
    //Consultas a la api
    //GET https://api.trakt.tv/movies/popular?genres=action&limit=10&page=2  --> para obtener otras 10 peliculas distintas
    function consult_recomendadas(){
        $movie = $this->request->getVar("movie");
        $url = 'https://api.trakt.tv/movies/trending?extended=full&&limit=12';

        $this->response->setContentType("application/json");
        return $this->response->setJSON($this->findMovie($url));
    }

    function consult_peliculaID(){
       
        $movie = $this->request->getVar("idMovie");
        $url = 'https://api.trakt.tv/movies/'.urlencode($movie)."?extended=full";
       
        $this->response->setContentType("application/json");
        return $this->response->setJSON($this->findMovie($url));

    }

    function consult_comentarioID(){
        $movie = $this->request->getVar("idMovie");
        $url = 'https://api.trakt.tv/movies/'.urlencode($movie).'/comments/highest';
       
        $this->response->setContentType("application/json");
        return $this->response->setJSON($this->findMovie($url));
    }

    function consult_peliculaNAME(){

        $movie = $this->request->getVar("movie");
        $url = 'https://api.trakt.tv/search/movie?query=' . urlencode($movie)."&extended=full";

        $this->response->setContentType("application/json");
        return $this->response->setJSON($this->findMovie($url));
    }

    //TODO: consult_peliculaCATEGORIA
    function consult_peliculaCATEGORIA(){
        $genre = $this->request->getVar("genre");
        $url = 'https://api.trakt.tv/movies/popular?genres='.$genre.'&limit=20&extended=full';
       // https://api.trakt.tv/movies/popular?genres={genre}&limit={limit}
        $this->response->setContentType("application/json");
        return $this->response->setJSON($this->findMovie($url));
    }

    function findMovie($url) {

        // $movie = $this->request->getVar("movie");
        // $url = 'https://api.trakt.tv/search/movie?query=' . urlencode($movie)."&extended=full";

        $headers = [
            'Content-Type: application/json',
            'trakt-api-version: 2',
            'trakt-api-key: 6f5823570b9049aab755f63b0981f7496f31efb73a7db68cbf756c8de5594762'
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $inf = "";
        $statusResult = false;

        if ($error) {
            $statusResult = false;
            $inf = "Error: " . $error;
        } else {

            $data = json_decode($response, true);

            if (!empty($data)) {

                $statusResult = true;

            } else {

                $statusResult = false;
                // $inf = Errores::getMjError(-18);     FALTA

            }
        }

        // $this->response->setContentType("application/json");
        // return $this->response->setJSON( [ "stateResult" => $statusResult, "data" =>  $data, 'inf' => $inf ] );
        return [ "stateResult" => $statusResult, "data" =>  $data, 'inf' => $inf ];
    }

    public function insert_pelicula(){
       
        $pelicula = $this->request->getJSON()->idMovie;
        //$usuario  = $this->request->getCookie("cookie_usuario");
        $usuario = $_COOKIE["cookie_usuario"];
        
        log_message("info","PelisPlus, Cuevana: ". $pelicula." user: ".$usuario);
        
        $result = $this->modelHome->agregar_pelicula($pelicula, $usuario);

        $this->response->setContentType("application/json");
        return $this->response->setJSON(["stateResult" => true]);
    }

    public function select_pelicula(){
        
        $usuario = $_COOKIE["cookie_usuario"];
        $result = $this->modelHome->consultar_pelicula($usuario);
        $movies = [];

        if(!isset($result)){
            $stateResult = true;

            $this->response->setContentType("application/json");
            return $this->response->setJSON( [ "stateResult" => $stateResult, "data" => null] );
        }
        
        foreach($result as $row){
            //log_message('info',$id->idmovie);
            $url = 'https://api.trakt.tv/movies/'.urlencode($row->Pelicula)."?extended=full";
            array_push( $movies, $this->findMovie($url)['data'] );
            
        }

        $stateResult = false;
        
        if(count($movies) > 0){
            $stateResult = true;
        }

        $this->response->setContentType("application/json");
        return $this->response->setJSON( [ "stateResult" => $stateResult, "data" =>  $movies] );

    }

    public function delete_pelicula(){
        $usuario = $_COOKIE["cookie_usuario"];
        $pelicula = $this->request->getVar("idMovie");
        $result = $this->modelHome->borrar_pelicula($pelicula, $usuario);

        $this->response->setContentType("application/json");
        return $this->response->setJSON( [ "stateResult" => $result] );
    }

    public function resend_email(){
        $token = $this->request->getPost('token');
        $datos = $this->modelHome->get_datos_reenvio_correo($token);
        $res_envio_correo = $this->enviar_confirmacion($datos['email'], $datos['nombre'], $datos['apellido'], $token);
        
        if($res_envio_correo){
            return json_encode(true);
        }else{
            log_message("info","Error en update de token (controlador resend)");
            return json_encode(false);
        }
    }

    public function change_email(){
        $correo = $this->request->getPost('correo');
        $token = $this->request->getPost('token');

        $result_update_correo = $this->modelHome->update_correo($correo);
        
        if($result_update_correo){
            log_message("info","Hace el update del correo");
            $datos = $this->modelHome->get_datos_reenvio_correo($token);
            $res_envio_correo = $this->enviar_confirmacion($datos['email'], $datos['nombre'], $datos['apellido'], $token);
            if($res_envio_correo){
                return json_encode(true);
            }else{
                return json_encode(false);
                log_message("info","Error en update de token (controlador change)");
            }
        }else{
            return false;
            log_message("info","Error en update de correo (controlador change)");
        }
    }

}
