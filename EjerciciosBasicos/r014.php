<?php


$blanco="B";
$negro="N";


echo "<table style='border: 2px solid black; border-collapse: collapse; width: 300px;'>";

for ($i=1; $i <= 8; $i++) { 
    
    if($i % 2==0){
        echo "<tr>";
        for ($j=1; $j <= 8; $j++) { 

            if($j % 2==0){
                echo "<td style='border: 2px solid black;text-align: center;background-color: white;color:black'>" . $blanco. "</td>";
    
            }else{
                echo "<td style='border: 2px solid black;text-align: center;background-color: black;color:white'>" . $negro . "</td>";
            }
        }
        echo "</tr>";
    }else{
        echo "<tr>";
        for ($j=1; $j <= 8; $j++) { 

            if($j % 2==0){
                echo "<td style='border: 2px solid black;text-align: center;background-color: black;color:white'>" . $negro . "</td>";
    
            }else{
                echo "<td style='border: 2px solid black;text-align: center;background-color: white;color:black'>" . $blanco. "</td>";
            }
        }
        echo "</tr>";

    }
    
}



echo "</table>";




?>