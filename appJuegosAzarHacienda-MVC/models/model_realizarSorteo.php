<?php

function obtenerRecaudacion($numeroSort, $conn){

    try{
        $stmt=$conn->prepare("SELECT RECAUDACION FROM sorteo WHERE NSORTEO=:numSorteo");
        $stmt->bindParam(':numSorteo', $numeroSort);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetch();

    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return  (float)$numSorteos['RECAUDACION'];

}

function insertarPremio($catg, $clave, $premio, $conn){

    try{
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE apuestas SET IMPORTE_PREMIO = :impPremio , CATEGORIA_PREMIO=:catgP WHERE NAPUESTA = :numAp"); 
        $stmt->bindParam(':numAp', $clave);
        $stmt->bindParam(':impPremio', $premio);//actualiza la recaudacion para premios
        $stmt->bindParam(':catgP', $catg);//agrega la combinacion ganadora
        
        if($stmt->execute()){
            actualizarSaldoPremioApos($conn, $clave);
        }
        $conn->commit();
    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack(); 
            }
            echo "Error: " . $e->getMessage();
        }
}

function actualizarSaldoPremioApos($conn, $clave){
   
    try {
        $stmt = $conn->prepare("SELECT DNI, IMPORTE_PREMIO 
                                FROM apuestas 
                                WHERE NAPUESTA = :numAp");
        $stmt->bindParam(':numAp', $clave);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos) {
            $dni = $datos['DNI'];
            $premio = $datos['IMPORTE_PREMIO'];
            
            //Actualizo el saldo sumando el premio
            $stmtUpdate = $conn->prepare("UPDATE apostante 
                                          SET SALDO = SALDO + :premio 
                                          WHERE DNI = :dni");
            $stmtUpdate->bindParam(':premio', $premio);
            $stmtUpdate->bindParam(':dni', $dni);
            $stmtUpdate->execute();
        }

    } catch (PDOException $e) {
        throw $e; // Dejo que insertarPremio() se encargue
    }
}

function obetenerApuestas($numSorte, $conn){
    try{
        $stmt=$conn->prepare("SELECT NAPUESTA ,N1, N2, N3, N4, N5, N6, R FROM apuestas WHERE NSORTEO=:numSort");
        $stmt->bindParam(':numSort', $numSorte);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $numSorteos;
}

function insertarCombinacionGand($conn){
    $combinacion=$_SESSION["numGand"];
    $sorteoSele=$_POST['sorteo'];
    $numeroDelSorteo=recaudacionPremio($sorteoSele, $conn);
    //$valido=false;
    try{
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE sorteo SET COMBINACION_GANADORA = :combGanadora , RECAUDACION_PREMIOS=:recaud, ACTIVO = 'N'  WHERE NSORTEO = :numSorteo"); 
        $stmt->bindParam(':numSorteo', $sorteoSele);
        $stmt->bindParam(':recaud', $numeroDelSorteo);//actualiza la recaudacion para premios
        $stmt->bindParam(':combGanadora', $combinacion);//agrega la combinacion ganadora
        $stmt->execute();
         
        $conn->commit();
    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack(); 
            }
            echo "Error: " . $e->getMessage();
        }
    //return $valido;
}
?>