<?php

function sorteoSeleccionado($num, $conn){
    try{
        $stmt=$conn->prepare("SELECT NSORTEO, FECHA, RECAUDACION, RECAUDACION_PREMIOS, DNI, ACTIVO, COMBINACION_GANADORA  FROM sorteo WHERE NSORTEO=:numSorteo");
        $stmt->bindParam(':numSorteo', $num);
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