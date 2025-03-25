<?php

$cont=5;
echo "<table style=' width: 200px;'>";
$correcto=true;
while ($correcto) { 
    echo "<tr>";
    
    for ($j=0; $j < 3; $j++) { 
        if ($cont < 100){
            echo  "<td style='text-align: center'>" . $cont . "</td>";

            if($j != 2 ){
                echo  "<td style='text-align: center'> - </td>";
            }
            $cont+=3;
        }else{
            $correcto=false;
        }
    }
    echo "</tr>";
}
echo "</table>";


?>