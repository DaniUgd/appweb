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

    public function registrar_usuario($usuario, $email, $contrasena, $nombre, $apellido, $direccion, $genero, $telefono, $nacimiento){
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        // console.log(strlen($contrasena));
        $sql = "INSERT INTO `usuario`(`Usuario`, `Email`, `Contrasena`, `Nombre`, `Apellido`, `Direccion`, `Genero`, `Telefono`, `Nacimiento`) VALUES ('$usuario', '$email', '$contrasena', '$nombre', '$apellido', '$direccion', '$genero', '$telefono', '$nacimiento');";
        $query = $this->db->query($sql);
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