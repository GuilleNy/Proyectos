<?php

echo "<table style='border: 2px solid black; border-collapse: collapse; width: 300px;'>";

$num1=10;
$num2=15;
$suma=$num1+$num2;
$sumaEntre=0;

echo "<tr>";  
echo  "<td style='border: 2px solid black;text-align: center'>Número 1: " . $num1 . " Número 2: " . $num2 . "</td>"; 
echo "</tr>";  

echo "<tr>";
echo  "<td style='border: 2px solid black;text-align: center'>" . $num1. "+" . $num2 . "=" . $suma . "</td>";  
echo "</tr>";

echo "<tr>";
echo "<td style='border: 2px solid black;text-align: center'> ";

for ($i=$num1; $i <= $num2; $i++) 
{ 
    $sumaEntre+=$i;
    echo $i;
    if($i < $num2){
        echo  " + ";
    }else{
        echo  " = " . $sumaEntre;
    }
}
echo "</td>";
echo "</tr>";

echo "</table>";

?>

