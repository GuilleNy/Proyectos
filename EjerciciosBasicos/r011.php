<?php

$num1="2A";
$num2="F";
$resultado=convertirDecimal($num1) + convertirDecimal($num2);

echo "Numero 1 en Hexa: " . $num1 . "<br>";
echo "Numero 2 en Hexa: " . $num2 . "<br>";

echo convertirDecimal($num1) . " + " . convertirDecimal($num2) . "=" . $resultado . " en base 10<br>";
echo $num1 . "+" . $num2 . "=" . sumaDec($resultado) . " en base 16<br>";




function sumaDec($num){

    $cadena="";
    

    while ($num > 0) 
    { 
        
        $resto=$num%16;
        $cadena= $resto . $cadena;
        $num=(int) ($num/16); //Debemos usar una conversión explícita a entero ((int)) para asegurarte de que $num se reduce correctamente en cada iteración.
        //$num=$num/2; esta manteniendo la parte decimal, lo que puede causar errores en la conversion
    }

    return $cadena;
}


function convertirDecimal($cadena) //2A
{
    
    $hexadecimal=["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];
    $cadenaLong=strlen($cadena);
    $indice=0;
    $suma=0;

    while ($indice < $cadenaLong){ 
        if($cadena[$indice] >= "A" && $cadena[$indice] <= "F"){ //Esta condicion verifica si la letra esta dentro del rango de A a F, y si es asi entra.
            for ($i=0; $i < count($hexadecimal); $i++) { 
                if($cadena[$indice] == $hexadecimal[$i]){
                    $suma+=$i*pow(16,($cadenaLong-$indice-1));
                }
            }
        }else if($cadena[$indice] >= "0" && $cadena[$indice] <= "9"){
            $suma+=intval($cadena[$indice])*pow(16,$cadenaLong-$indice-1);
        }
        $indice++;
    }

    return $suma;
}





?>