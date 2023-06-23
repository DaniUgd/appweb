<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model{
    
    public function select_usuario(){
        $sql = "SELECT * FROM USUARIO;";    //se crea la consulta
        $query = $this->db->query($sql);    //se consulta a la db
        $result = $query->getResult();      //obtiene la consulta

        if(count($result)>=1){
            return $result;
        }else{
            return NULL;
        }
    }

    public function get_email($email){
        // console.log($email);
        $sql = "SELECT * FROM `usuario` WHERE Email='$email';";    //se crea la consulta
        $query = $this->db->query($sql);    //se consulta a la db
        $result = $query->getResult();      //obtiene la consulta

        if(count($result)>=1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function registrar_usuario($usuario, $email, $contrasena, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento, $token){
        
        //Hash para la contraseña
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        //Obtener la fecha de generacion de cuenta
        $currentDate = date('Y-m-d');
        
        $sql = "INSERT INTO `usuario`(`Usuario`, `Email`, `Contrasena`, `Nombre`, `Apellido`, `Direccion`, `Genero`, `Telefono`, `Nacimiento`, `Valido`, `Token`, `FechaRegistro`) VALUES ('$usuario', '$email', '$contrasena', '$nombre', '$apellido', '$direccion', '$genero', '$telefono', '$nacimiento', 0, '$token', '$currentDate');";
        $query = $this->db->query($sql);
        
        if($query){
            log_message("info","EntroN");
            return TRUE;
        }else{
            log_message("info","No Entro");
            return FALSE;
        }
    }

    public function correo_confirmacion($email, $nombre, $apellido, $token){
        
        $enlace = BASEURL.'/email/validar_cuenta/'.$token;
        $subject = "VideoTrends - Correo Confirmación de Registro de Cuenta";
        $message = "¡Hola $nombre $apellido!\nPara activar tu cuenta sigue el siguiente enlace $enlace ";

        $send = \Config\Services::email();

        $send->setTo($email);
        $send->setFrom('lurikoan@gmail.com','VideoTrends');
        $send->setSubject($subject);
        $send->setMessage($message);

        if($send->send()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // public function get_usuario($usuario){
    //     $sql = "SELECT * FROM USUARIO WHERE Usuario='$usuario';";    //se crea la consulta
    //     $query = $this->db->query($sql);    //se consulta a la db
    //     $result = $query->getResult();      //obtiene la consulta

    //     if(count($result)>=1){
    //         return $result;
    //     }else{
    //         return NULL;
    //     }
    // }

}