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
}
