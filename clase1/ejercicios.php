<?php
echo "<meta charset='utf-8'>";
/*
Aplicación Nº 9 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand ). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado
*/

    $numeros = array();

    for ($i=0; $i < 5; $i++) { 
        array_push($numeros, rand(1, 10));
    }
    $promedio = 0;
    foreach ($numeros as $val) {
        $promedio += $val;
    }
    $promedio = $promedio / 5;
    echo "------------- Aplicación Nº 9 (Carga aleatoria): -------------<br>";
    echo '$promedio= '.$promedio."<br>";
    if($promedio < 6)
        echo "Promedio es MENOR a 6";
    elseif($promedio > 6)
        echo "Promedio es MAYOR a 6";
    else
        echo "Promedio es IGUAL a 6";

/*
Aplicación Nº 13 (Arrays asociativos II)
Cargar los tres arrays con los siguientes valores y luego ‘juntarlos’ en uno. Luego mostrarlo por
pantalla.
“Perro”, “Gato”, “Ratón”, “Araña”, “Mosca”
“1986”, “1996”, “2015”, “78”, “86”
“php”, “mysql”, “html5”, “typescript”, “ajax”
*/
echo "<br> ------------------ Aplicación Nº 13 (Arrays asociativos II) -------------------------<br>";
$animales = ["Perro", "Gato", "Ratón", "Araña", "Mosca"];
$fechas = [ 1986, 1996, 2015, 78, 86];
$lenguajes = ["php", "mysql", "html5", "typescript", "ajax"];
$arrayTodos = array_merge( $animales, $fechas, $lenguajes);
var_dump($arrayTodos);

?>