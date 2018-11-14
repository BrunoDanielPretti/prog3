<?php

class Usuario{
    public $email;
    public $clave;
    public $perfil;

    public function __constructor($pEmail=null, $pClave=null, $pPerfil=null){
        if($pEmail != null){
            $this->email = $pEmail;
            $this->clave = $pClave;
            $this->perfil = $pPerfil;
        }
    }
}



?>