<?php
include_once "conexionBaseDeDatos.php";

function obetenerApuesta($numSorte){
    $conn=conexionBBDD();
    try{
        //$conn->beginTransaction(); 
        //no es necesario, las transacciones se usan generalmente para operaciones que modifican datos INSERT, UPDATE, DELETE.

        $stmt=$conn->prepare("SELECT N1, N2, N3, N4, N5, N6, R FROM apuestas WHERE NSORTEO=:numSort");
        $stmt->bindParam(':numSort', $numSorte);
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