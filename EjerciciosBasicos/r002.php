<?php
$cont=1;

echo "<table style='border: 2px solid black; border-collapse: collapse; width: 700px;'>";

for ($i=1; $i <= 10; $i++) 
{ 
    echo "<tr>";
    
    for ($j=1; $j <= 10; $j++) 
    { 
        echo  "<td style='border: 2px solid black;text-align: center'>" . $cont . "</td>";
          
        $cont+=10;
    }
    echo "</tr>";

    $cont=1+$i;
}

echo "</table>";

?>