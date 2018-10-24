<?php
require_once("clases/Alumno.php");
require_once("clases/Materia.php");
require_once("clases/Inscripcion.php");

//echo "Nexo.php!!!<br>";
$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : null;

if( isset($_GET['queHago']) ){
    $queHago = ($_GET['queHago'] );
}
//var_dump($queHago);

switch ($queHago) {
    case 'Saludar':
        echo "ola q ase";
        break;
    
    case 'cargarAlumno':
        Alumno::Put_BD();        
        break;
    case 'consultarAlumno':
        Alumno::Get_BD_PorApellido();        
        break;
    case 'cargarMateria':
        Materia::Put_BD();        
        break;
    case 'inscribirAlumno':
        Inscripcion::Inscribir_Alumno();
        break;
    case 'inscripciones':
        Inscripcion::MostrarTabla();
        break;

    case 'Prueba':
        Materia::Prueba();        
        break;

    case 'LimpiarAlumnos':
        $file = fopen('data/alumnos.txt', 'w');
        fclose($file);
        break;
    default:     
        echo "Error, Pagina no encontrada";  
        break;
}


?>