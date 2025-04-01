<?php



function cifrado($cadena)
{
    $cadena=strtoupper($cadena);
    $union=" ";

   
    $original  =["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K",
                      "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", 
                      "V", "W", "X", "Y", "Z"];

    $codificado=["G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q",
                      "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "A", 
                      "B", "C", "D", "E", "F"];
    
    $indice=0;

    while ( $indice < strlen($cadena)){
        for ($i=0; $i < count($original); $i++) { //En este for se recorre el array original y se compara con la cadena introducida 
            //Si la letra de la cadena es igual a la letra del array original se guarda la letra del array codificado en la variable union
            if($cadena[$indice] == $original[$i]){
                $union=$union . $codificado[$i];
            }
        }
        $indice++; //Se incrementa el indice para recorrer la cadena
    }
    return $union;
}

echo cifrado("HOLA");


?>