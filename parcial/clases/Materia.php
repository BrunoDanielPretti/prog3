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
        if( $_POST['codigo'] != null && !self::Check_Codigo ($_POST['codigo']) ){
            
            $miMateria = new Materia(
                $_POST['codigo'],
                $_POST['nombre'],
                $_POST['aula'],
                $_POST['cupo']
            );
            $file = fopen( self::$arch_path, 'a');
            fwrite( $file, $miMateria->ToString()."\n" );            
            fclose($file);
        }else{
            echo "No se pudo ingresar la Materia";
        }
    }

    

    //--------------------------------------------------------------------------------------------------
    public static function TraerTodos(){
        $listaDeMaterias = array();
        $file = fopen( self::$arch_path, "r");

        while( !feof($file) ){
            $auxLinea = fgets($file);
            $datos = explode(" - ", $auxLinea);
            $datos[0] = trim($datos[0]);
            if($datos[0] != ""){
                $listaDeMaterias[] = new Materia($datos[0], $datos[1], $datos[2], $datos[3]);
            }            
        }
        fclose($file);
        return $listaDeMaterias;     
    }
    
    public static function Check_Codigo($pCodigo){
        $materias = self::TraerTodos();        
        foreach ($materias as $val) {
            if( strtolower($val->codigo) == strtolower($pCodigo) ){
                return $val;
            }          
        }
        return false;       
    }
    public function ToString(){
        return "$this->codigo - $this->nombre - $this->aula - $this->cupo";
    }
   

    //-------------------------------------------------

    public function Prueba(){
        echo "Hola clase Materia!!";
    }


}
    


?>