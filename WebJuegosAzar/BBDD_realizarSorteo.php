<?php

include_once "conexionBaseDeDatos.php";


$sortActivos=SorteosActivos();
var_dump($sortActivos);
function SorteosActivos(){
    $conn=conexionBBDD();


    try{
        $conn->beginTransaction();

        $stmt=$conn->prepare("SELECT NSORTEO FROM sorteo WHERE ACTIVO='A'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();


    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack();  // Solo hacer rollBack si hay transacción activa
            }
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    return $numSorteos;
}





?>