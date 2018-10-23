<?php
require_once("clases/Alumno.php");
require_once("clases/Materia.php");

class Inscripcion{
    private $email;
    private $nombre;
    private $apellido;
    private $codigo;
    private $materia;
    private static $arch_inscripciones = 'data/inscripciones.txt';

    public function __construct($pEmail=null, $pNombre=null, $pApellido=null, $pCodigo=null, $pCupo=null){
        $this->email    = $pEmail;
        $this->nombre   = $pNombre;
        $this->apellido = $pApellido;            
        $this->codigo    = $pCodigo;
        $this->cupo     = $pCupo;
    }


    public static function Inscribir_Alumno(){
        $miMateria = Materia::Check_Codigo($_POST['codigo']) ;

        if( $miMateria == false ){
            echo "No existe esa Materia";
            return false;
        }
        if( self::CantidadDeInscriptos($_POST['codigo']) >= (int)$miMateria->cupo){
            echo "No hay cupo, el cupo maximo es: ".$miMateria->cupo;
            return false;
        }

        $miAlumno = new Alumno(
            $_POST['email'],
            $_POST['nombre'],
            $_POST['apellido'],            
        );
        
        $miInscripcion = new Inscripcion(
            $miAlumno->email,
            $miAlumno->nombre,
            $miAlumno->apellido,
            $miMateria->codigo,
            $miMateria->nombre
        );
        
        $file = fopen( self::$arch_inscripciones, 'a');
        fwrite( $file, $miInscripcion->ToString()."\n" );            
        fclose($file);
    }

    //-------------------------------------------------------------------
    public static function TraerTodos(){
        $Lista = array();
        $file = fopen( self::$arch_inscripciones, "r");

        while( !feof($file) ){
            $auxLinea = fgets($file);
            $datos = explode(" - ", $auxLinea);
            $datos[0] = trim($datos[0]);
            if($datos[0] != ""){
                $Lista[] = new Inscripcion($datos[0], $datos[1], $datos[2], $datos[3], $datos[4]);
            }            
        }
        fclose($file);
        return $Lista;     
    }

    public static function CantidadDeInscriptos($pCodigo){
        $cont = 0;
        $inscrip = self::TraerTodos();        
        foreach ($inscrip as $val) {
            if($val->codigo == $pCodigo ){
                $cont++;
            }
        }
        return $cont;
    }
   
    public function ToString(){
        return "$this->email - $this->nombre - $this->apellido - $this->codigo - $this->cupo";
    }
}

?>