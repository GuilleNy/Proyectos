<?php

$num1=1000;
$num2=10;
$resultado=convertirDecimal($num1) + convertirDecimal($num2);

echo "Numero 1: " . $num1 . "<br>";
echo "Numero 2: " . $num2 . "<br>";

echo $num1 . "+" . $num2 . "=" . sumaDec($resultado) . "<br>";
echo convertirDecimal($num1) . " + " . convertirDecimal($num2) . "=" . $resultado . " en base 10<br>";



function sumaDec($num){

    $cadena="";
    

    while ($num > 0) 
    { 
        
        $resto=$num%2;
        $cadena= $resto . $cadena;
        $num=(int) ($num/2); //Debemos usar una conversión explícita a entero ((int)) para asegurarte de que $num se reduce correctamente en cada iteración.
        //$num=$num/2; esta manteniendo la parte decimal, lo que puede causar errores en la conversion
    }

    return $cadena;
}


function convertirDecimal($num)
{

    $numero=strlen(strval($num));
    $num=str_split($num);

    $suma=0;
    for ($i=$numero; $i >= 1; $i--) { 
        $suma=$num[$i-1]*pow(2,($numero-$i));
    }

    return $suma;
}





?>