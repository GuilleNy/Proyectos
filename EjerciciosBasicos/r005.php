<?php

$cont=1;

echo "<table style='border: 2px solid black; border-collapse: collapse; width: 450px;'>";

for ($i=0; $i < 9; $i++) 
{ 
    $suma=0;
    echo "<tr>";
    
    for ($j=0; $j <= 3; $j++) 
    { 
        if ($cont <= 100){ //Si el contador es menor o igual a 100 pone el numero en la tabla y lo suma.
            //La variable suma se hara por cada fila, en cuanto se acabe la fila se reiniciara, esto
            //se debe a que la variable $suma=0 esta dentro del primer bucle, por lo que se reinicia,
            //si estuviera fuera del bucle, la suma se acumularia en todas las filas.            
            $suma+=$cont; 
            echo  "<td style='border: 2px solid black;text-align: center'>" . $cont . "</td>";
        }else{
            echo "<td style='border: 2px solid black;text-align: center'>  </td>";
        }
        
        if($j != 3) //Si es el ultimo de la fila no pone el guion
        {
            echo  "<td style='border: 2px solid black;text-align: center'> - </td>";

        }else{ //Si es el ultimo de la fila pone el guion y la suma.
            echo  "<td style='border: 2px solid black;text-align: center'> - </td>";
            echo  "<td style='border: 2px solid black;text-align: center'>Suma:" . $suma . "</td>";
        }
            
        $cont +=3;
    }
    echo "</tr>";  
}
echo "</table>";

?>