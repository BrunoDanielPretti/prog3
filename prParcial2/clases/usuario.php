<?php

class Usuario{
    public $email;
    public $clave;
    public $perfil;

    public function __construct($pEmail=null, $pClave=null, $pPerfil=null){
        if($pEmail != null){
            $this->email = $pEmail;
            $this->clave = $pClave;
            $this->perfil = $pPerfil;
        }
    }

    public function AgregarUsuario(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "INSERT INTO usuarios (email, clave, perfil)
            values(:email, :clave, :perfil)");
        
        $consulta->bindValue(':email',  $this->email,   PDO::PARAM_STR);
        $consulta->bindValue(':clave',  $this->clave,   PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $this->perfil,  PDO::PARAM_STR);

        return $consulta->execute();              
    }

    public static function TraerTodosLosUsuarios(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "SELECT email, perfil
             FROM usuarios");
        $consulta->execute();   
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    public function BuscarPorEmail(){                                      
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
            "SELECT 
               email, clave, perfil
            FROM usuarios
            WHERE email = '$this->email'"                
        );   
        $consulta->execute();                  
        $miProducto = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");                
        return $miProducto;            
    }

    public function Autentificar(){                                      
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
            "SELECT 
               email, clave, perfil
            FROM usuarios
            WHERE email = '$this->email'"                
        );   
        $consulta->execute();                  
        $miProducto = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");                
        //return $miProducto;            
        if($miProducto == null){
            return "No existe el Usuario";
        }else{
            if($miProducto[0]->clave == $this->clave){
                return true;
            }else{
                return "contraseña incorrecta";
            }
        }
    }

    public static function PerfilPorEmail($pEmail){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta(
            "SELECT perfil FROM usuarios
            WHERE email = (:email)");
        
        $consulta->bindValue(':email',  $pEmail,   PDO::PARAM_STR);
        

        $consulta->execute();              
        return $miProducto = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    //-----------------------------------------------------------------
    public function ToString(){
        return "Email: $this->email - Clave: $this->clave - Perfil: $this->clave";
    }
}



?>