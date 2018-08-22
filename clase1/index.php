<?php
    $nombre = "Mario";

    /*
    echo "Hola ".$nombre." asd $nombre".' $nombre'."<br>";
    echo "strlem(): ".strlen($nombre)."<br>";
    echo "strtolower(): ".strtolower($nombre)."<br>";
    echo "strtoupper(): ".strtoupper($nombre)."<br>";
    echo "substr(0, 3): ".substr($nombre, 0, 3 )."<br>";
    echo "substr(2, 3): ".substr($nombre, 2, 3 )."<br>";
    */

    $vec = array(1, "dos", 'cuatro', $nombre);
    $vec[7] = 3;
    
    $vec2 = [2, 3 , 4];
    $vec3 = [
        "el string"=>"asd",
        "el numero"=>123,
        "la variable"=>$nombre
    ];

    //var_dump($vec3);

    foreach ($vec3 as $i => $value) {
        echo $i.": ".$value."<br>";
    }

    /*
    for ($i=0; $i < count($vec) ; $i++) { 
        echo $vec[$i]."<br>";
    }
    */
    
?>