<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model{
    
    public function usuario_list(){
        $sql = "SELECT * FROM USUARIO;";    //se crea la consulta
        $query = $this->db->query($sql);    //se consulta a la db
        $result = $query->getResult();      //obtiene la consulta

        if(count($result)>=1){
            return $result;
        }else{
            return NULL;
        }
    }

}