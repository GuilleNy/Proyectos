<?php

$base=2;
$potencia=10;


echo "Base " . $base . " - Potencia " . $potencia . "<br>";

echo $base . " elevado a " . $potencia . " = " . potencia($base,$potencia);

function potencia($base,$potencia)
{
    $resultado=1;

    for ($i=0; $i < $potencia; $i++) { 
        $resultado*=$base;
    }
    return $resultado;
}

?>