<?php


function fibonacci($n) {
    $a = 0;
    $b = 1;

    for ($i = 0; $i < $n; $i++) {
        echo $a ;
        if($i < $n-1){
            echo " , ";
        }
        
        $temp = $a;
        $a = $b;
        $b = $temp + $b;
    }
}

fibonacci(15);

    
?>