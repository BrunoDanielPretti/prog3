<?php
class Alumno{

    private $email;
    private $nombre;
    private $apellido;        
    private $foto;
    private static $arch_path = 'data/alumnos.txt';
    private static $fotos_path = 'data/fotos/';

    public function __construct($pEmail=null, $pNombre=null, $pApellido=null, $pFoto=null){
        $this->email    = $pEmail;
        $this->nombre   = $pNombre;
        $this->apellido = $pApellido;            
        $this->foto     = $pFoto;
    }

    public static function Put_BD(){
        if( $_POST['email'] != null && !self::Check_email ($_POST['email']) ){

            if(!move_uploaded_file($_FILES["foto"]["tmp_name"], self::$fotos_path.$_POST['email'].".jpg") ){
                echo "Error en la foto";
                return false;
            }
            $miAlumno = new Alumno(
                $_POST['email'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['email'].".jpg"
            );
            $file = fopen( self::$arch_path, 'a');
            fwrite( $file, $miAlumno->ToString()."\n" );            
            fclose($file);
        }else{
            echo "No se pudo ingresar el Alumno";
        }
    }
    public static function Get_BD_PorApellido(){           
        $alumnos = self::TraerTodos();
        $cont = 0;
        foreach ($alumnos as $val) {
            if( strtolower($val->apellido) == strtolower($_GET['apellido']) ){
                echo $val->ToString();
                $cont++;
            }           
        }
        if($cont == 0){
            echo "No existe alumno con apellido ".$_GET['apellido'];
        }
    }  
//--------------------------------------------------------------------------------------------------
    public static function TraerTodos(){
        $listaDeAlumnos = array();
        $file = fopen( self::$arch_path, "r");

        while( !feof($file) ){
            $auxLinea = fgets($file);
            $datos = explode(" - ", $auxLinea);
            $datos[0] = trim($datos[0]);
            if($datos[0] != ""){
                $listaDeAlumnos[] = new Alumno($datos[0], $datos[1], $datos[2], $datos[3]);
            }            
        }
        fclose($file);
        return $listaDeAlumnos;     
    }
    public static function Check_email($pEmail){
        $alumnos = self::TraerTodos();        
        foreach ($alumnos as $val) {
            if( strtolower($val->email) == strtolower($pEmail) ){
                return true;
            }          
        }
        return false;       
    }

    public function ToString(){
        return "$this->email - $this->nombre - $this->apellido - $this->foto";
    }

    public function Prueba(){
        //echo date("Ymd_His");
        //var_dump($_FILES);
        $tipoArchivo = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION); // te devuelve el tipo de archivo ej: jpg png
        
        $archivoTmp = date("Ymd_His") . ".jpg";
        $destino = "data/fotos/" . $archivoTmp;
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)) {
            echo "se guardo la foto";			
		}else{
            echo "NO se guardo la foto";		
        }
    }

}

        

        
    
    
/*  Fuera de Uso
    public function Prueba(){
        $resultado = FALSE;
        if( $_POST['prueba'] != null){
            $file = fopen('data/alumnos.txt', 'a');
            $cant = fwrite( $file, $_POST['prueba']."\n" );
            if($cant > 0){ $resultado = TRUE; }
            fclose($file);
        }
        return $resultado;       
    }
    

*/

?>