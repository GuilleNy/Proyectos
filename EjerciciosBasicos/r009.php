<?php



function cifrado($cadena)
{
    $cadena=strtoupper($cadena);
    $union="";
    $original=["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K",
                      "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", 
                      "V", "W", "X", "Y", "Z"];

    $codificado=["G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q",
                      "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "A", 
                      "B", "C", "D", "E", "F"];

    for ($i=0; $i < count($original); $i++){

        if($cadena[$i] == $original[$i]){
            $union=$union . $codificado[$i];
        }
        
    }
    return $union;
}

echo cifrado("HOLA");


?>