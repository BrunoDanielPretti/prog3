<?php
    require_once './clases/AutentificadorJWT.php';

    class Middelware{

    public static function VerificarAdmin($request, $response, $next) {
        
        if($request->hasHeader('token') ){
            $token = $request->getHeader('token')[0];
            
            $token = AutentificadorJWT::DecodificarToken($token);
            //var_dump($token);
            $email = $token->DATA->email;
            $tipo = Usuario:: PerfilPorEmail($email)[0]->perfil;

            if($tipo == "admin"){
                $response = $next($request, $response);
            }else{
                $response->getBody()->write('hola');
            }
        }else{
            $response->getBody()->write('No se recibio ningun Token');
        }

        /*
        
                
        if($token[0] = 1){
            $response = $next($request, $response);
        }else{
            $response->getBody()->write('Hola');
        }
        
        //$response->getBody()->write($token);
        //var_dump($token);
        */
        return $response;
    }


    }

?>

