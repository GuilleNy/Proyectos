<?php


function sorteoSeleccionado($num){
    $dniNum= nameUsuario();//esto esta en controller_sesison.php

    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT NAPUESTA, DNI, NSORTEO, FECHA, N1, N2, N3, N4, N5, N6, R, IMPORTE_PREMIO, CATEGORIA_PREMIO  FROM apuestas WHERE NSORTEO=:numSorteo AND DNI=:dni");
        $stmt->bindParam(':numSorteo', $num);
        $stmt->bindParam(':dni', $dniNum);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $numSorteos;

}

?>