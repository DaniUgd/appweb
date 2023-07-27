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
        $sql = "SELECT * FROM `usuario` WHERE Email='$email';";
        $query = $this->db->query($sql);
        $result = $query->getResult();

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

    //Verificar token de validacion de correo
    public function verificar_token($token,$email){
        $sql = "SELECT * FROM `usuario` WHERE Token='$token' AND Email='$email';";
        $query = $this->db->query($sql);
        $result = $query->getResult();

        if(count($result)>=1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //Actualizar como valido un correo confirmado
    public function actualizar_valido($email){
        $sql = "UPDATE `usuario` SET Valido=1 WHERE Email='$email';";
        $query = $this->db->query($sql);
        
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //Validar inicio de sesion
    public function validar_inicio($email, $contrasena){
        $sql_hash = "SELECT Contrasena FROM `usuario` WHERE Email='$email';"; //Posible error al tratar el dato
        $query = $this->db->query($sql_hash);
        if($query){
            $hash = $query->getRow();
            echo "<script>console.log($hash);</script>";
            // if(password_verify($contrasena,$hash)){

            // }
        }else{
            //ERROR: no existe correo ingresado
        }

        return TRUE;
    }

}