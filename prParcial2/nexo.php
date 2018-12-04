<?php
//---------------------------------  Configuracion  -------------------------------------------//
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../vendor/autoload.php';  
    require_once './clases/AccesoDatos.php'; 
    require_once './clases/AutentificadorJWT.php';
    require_once './clases/Middelware.php';

    require_once './clases/usuario_api.php'; 

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;
    $app = new \Slim\App(["settings" => $config]);

//--------------------------------------------------------------------------------------
    $app->get('/prueba', function (Request $request, Response $response, $args) {        
        //return Middelware::$saludo;
    });

    $app->post('/usuario',  \Usuario_api::class . ':AgregarUsuario');
    $app->post('/login',    \Usuario_api::class . ':Login');

    $app->get('/usuario', \Usuario_api::class . ':ListaDeUsuarios')
        ->add(\Middelware::class . ':VerificarAdmin');

//--------------------------------------------------------------------------------------
    $app->run();
?>
