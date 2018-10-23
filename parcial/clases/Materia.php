<?php
class Materia{
    private $codigo;
    private $nombre;
    private $aula;
    private $cupo;
    private static $arch_path = 'data/materias.txt';

    public function __construct($pCodigo=null, $pNombre=null, $pAula=null, $pCupo=null){
        $this->codigo    = $pCodigo;
        $this->nombre   = $pNombre;
        $this->aula = $pAula;            
        $this->cupo     = $pCupo;
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

    //-------------------------------------------------

    public function Prueba(){
        echo "Hola clase Materia!!";
    }


}
    


?>