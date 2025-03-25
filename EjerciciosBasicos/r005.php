<?php

$cont=1;

echo "<table style='border: 2px solid black; border-collapse: collapse; width: 400px;'>";

for ($i=0; $i < 9; $i++) 
{ 
    $suma=0;
    echo "<tr>";
    
    for ($j=0; $j <= 3; $j++) 
    { 
        if ($cont <= 100){
            $suma+=$cont;
            echo  "<td style='border: 2px solid black;text-align: center'>" . $cont . "</td>";
        }else{
            echo "<td style='border: 2px solid black;text-align: center'>  </td>";
        }
        
        if($j != 3)
        {
            echo  "<td style='border: 2px solid black;text-align: center'> - </td>";

        }else{
            echo  "<td style='border: 2px solid black;text-align: center'>Suma:" . $suma . "</td>";
        }
            
        $cont +=3;
    }
    echo "</tr>";  
}
echo "</table>";

?>