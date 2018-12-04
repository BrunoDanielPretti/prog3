<?php
require_once './clases/usuario.php';
require_once './clases/AutentificadorJWT.php';

class Usuario_api{

    public function AgregarUsuario($request, $response, $args) {            
        $params = $request->getParsedBody();
        //var_dump($params);
        $miUsuario = new Usuario(
            $params['email'],
            $params['clave'],
            $params['perfil']
        );

        if($miUsuario->BuscarPorEmail() != null){
            return "Ya existe el usuario: $miUsuario->email";
        }else{                
            $miUsuario->AgregarUsuario();
            return "Usuario Agregado";
        }

        //$miUsuario = ;

        //echo $params['email']            ;
        //$miUsuario->AgregarUsuario();
        //echo $miUsuario->ToString();
        //var_dump($miUsuario);
        //return $response;
    }

    public static function Login($request, $response, $args){
        $params = $request->getParsedBody();            
        $miUsuario = new Usuario(
            $params['email'],
            $params['clave']                
        );
        $estado = $miUsuario->Autentificar();

        if( $estado === true ){
            //return "TRUE!!";
            $datos = array('email' => $params['email']);
            return AutentificadorJWT::CrearToken($datos);

        }else{
            return $estado;
        }                        
    }

    public static function ListaDeUsuarios($request, $response, $args){
        $usuarios = Usuario::TraerTodosLosUsuarios();
        return $response->withJson($usuarios);
    }
}


?>