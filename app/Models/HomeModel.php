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

    public function registrar_usuario($usuario, $email, $contrasena1, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento, $token){
        
        //Hash para la contraseña
        $contrasena = password_hash($contrasena1, PASSWORD_BCRYPT);
        //Obtener la fecha de generacion de cuenta
        $currentDate = date('Y-m-d');
        
        $sql = "INSERT INTO `usuario`(`Usuario`, `Email`, `Contrasena`, `Nombre`, `Apellido`, `Direccion`, `Genero`, `Telefono`, `Nacimiento`, `Valido`, `Token`, `FechaRegistro`) VALUES ('$usuario', '$email', '$contrasena', '$nombre', '$apellido', '$direccion', '$genero', '$telefono', '$nacimiento', 0, '$token', '$currentDate');";
        $query = $this->db->query($sql);
        
        if($query){
            //log_message("info","EntroN");
            return TRUE;
        }else{
            //log_message("info","No Entro");
            return FALSE;
        }
    }

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
        $sql_hash = "SELECT Contrasena FROM `usuario` WHERE Email='$email';";
        log_message("info","".$sql_hash);
        $query = $this->db->query($sql_hash);
        $hash_obj = $query->getRow();
        if($hash_obj != null){
            if(password_verify($contrasena,$hash_obj->Contrasena)){
                //log_message("info","Verifica: ".$contrasena." ".$hash_obj->Contrasena);
                $sql = "SELECT Usuario FROM `usuario` WHERE Email='$email';";
                $query2 = $this->db->query($sql);
                $usuario_obj = $query2->getRow();
                return $usuario_obj->Usuario;
            }
        }

        return FALSE;
    }

    public function get_usuario($usuario){
        $sql = "SELECT * FROM `usuario` WHERE Usuario='$usuario';";
        $query = $this->db->query($sql);
        $result = $query->getResult();

        if(count($result)>=1){
            return $result;
        }else{
            return null;
        }
    }

    public function update_usuario($usuario, $email, $contrasena1, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento, $token){
        $current_user = $_COOKIE["cookie_usuario"];
        
        if($email!=null && $contrasena1!=null){
            $contrasena = password_hash($contrasena1, PASSWORD_BCRYPT);
            $currentDate = date('Y-m-d');
            $sql = "UPDATE `usuario` SET Usuario='$usuario', Email='$email', Contrasena='$contrasena', Nombre='$nombre', Apellido='$apellido', Direccion='$direccion', Genero=$genero, Telefono=$telefono, Nacimiento='$nacimiento', Token='$token' WHERE Usuario='$current_user';";
        }else if($email==null && $contrasena1!=null){
            $contrasena = password_hash($contrasena1, PASSWORD_BCRYPT);
            $sql = "UPDATE `usuario` SET Usuario='$usuario', Contrasena='$contrasena', Nombre='$nombre', Apellido='$apellido', Direccion='$direccion', Genero=$genero, Telefono=$telefono, Nacimiento='$nacimiento' WHERE Usuario='$current_user';";
        }else if($email!=null && $contrasena1==null){
            $currentDate = date('Y-m-d');
            $sql = "UPDATE `usuario` SET Usuario='$usuario', Email='$email', Nombre='$nombre', Apellido='$apellido', Direccion='$direccion', Genero=$genero, Telefono=$telefono, Nacimiento='$nacimiento', Token='$token' WHERE Usuario='$current_user';";
        }else if($email==null && $contrasena1==null){
            $sql = "UPDATE `usuario` SET Usuario='$usuario', Nombre='$nombre', Apellido='$apellido', Direccion='$direccion', Genero=$genero, Telefono=$telefono, Nacimiento='$nacimiento' WHERE Usuario='$current_user';";
        }else{
            log_message("info","Error en update: email, pass");
            return false;
        }

        $query = $this->db->query($sql);
        if($query){
            return TRUE;
        }else{
            log_message("info","Error en update");
            return FALSE;
        }

    }

    public function agregar_pelicula($pelicula, $usuario){
        $sql = "INSERT INTO `biblioteca`(`Pelicula`, `Usuario`) VALUES ('$pelicula', '$usuario');";
        $query = $this->db->query($sql);

        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function consultar_pelicula($usuario){
        $sql = "SELECT * FROM `biblioteca` WHERE Usuario='$usuario';";
        $query = $this->db->query($sql);
        $result = $query->getResult();

        if(count($result)>=1){
            return $result;
        }else{
            return NULL;
        }
    }

    public function borrar_pelicula($pelicula, $usuario){
        $sql = "DELETE FROM `biblioteca` WHERE Pelicula='$pelicula' AND Usuario='$usuario';";
        $query = $this->db->query($sql);

        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}