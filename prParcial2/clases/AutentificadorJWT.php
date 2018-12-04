<?php
    //require_once "vendor/autoload.php";
    use Firebase\JWT\JWT;

    class AutentificadorJWT{
        private static $claveSecreta = "acaVaUnaClaveSecreta";
        private static $tipoEncriptacion = 'HS256';
        private static $exptime = 10;

        public static function CrearToken($datos){
            $ahora = time();
            $playLoad = array(              //el Token
                'IAT' => $ahora,
                'EXP' => $ahora + self::$exptime,
                'DATA' => $datos,
                'APP' => "apirest JWT"
            );

            return JWT::encode($playLoad, self::$claveSecreta);
        }

        public static function VirificarToken($pToken){
            try{
                $decod = JWT::decode($pToken, self::$claveSecreta, array(self::$tipoEncriptacion) );
            }
            catch(\exeption $e){
                throw new Exception("Error Processing Request", 404);
            }
            
            if ($decod->EXP < time()) {
                throw new Exception('Expiro');
            }
            
            
        }

        public static function DecodificarToken($pToken){
            try{
                $decod = JWT::decode($pToken, self::$claveSecreta, array(self::$tipoEncriptacion) );
                return $decod;
            }
            catch(\exeption $e){
                throw new Exception("Error Processing Request", 404);
            }                                                
        }

        public static function olaqase(){
            return "ola q ase";
        }
    }


?>