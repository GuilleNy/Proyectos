<?php

echo "<table style='border: 2px solid black; border-collapse: collapse; width: 300px;'>";

$cadena="En un lugar de la Mancha";
$vocales=["a","e","i","o","u"];

echo "<tr>";  
echo  "<td style='border: 2px solid black;text-align: center'>Frase:  " . $cadena .  "</td>"; 
echo "</tr>";  

for ($i=0; $i < count($vocales); $i++) 
{ 
    $suma=substr_count(strtolower($cadena), $vocales[$i]);

    echo "<tr>";  
    echo  "<td style='border: 2px solid black;text-align: center'>" . $vocales[$i] . " - " . $suma.  " veces</td>"; 
    echo "</tr>"; 
}

echo "</table>";




?>

