<?php

function verificarSaldo(){
    //verifico que tenga saldo y si tiene le resto 1€ de su cuenta
        $correcto=false;
   
        $dniNum=nameUsuario();
        
        try{
            $stmt=$GLOBALS["conn"]->prepare("SELECT SALDO FROM apostante WHERE DNI=:dni");
            $stmt->bindParam(':dni', $dniNum);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);// aqui le cambie el FETCH_ASSOC por FETCH_NUM para acceder por indice numerico
            $haySaldo=$stmt->fetch();
    
            if($haySaldo && $haySaldo['SALDO'] > 0){
                $correcto=true;
                $saldoTotal=$haySaldo['SALDO'] - 1;
                actualizarSaldoApost($dniNum, $saldoTotal);
            }
    
        }catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
            return $correcto;
}

function actualizarSaldoApost($dniNum, $saldoTotal){
    //inserto los datos de la apuesta y genero el numero del reintegro

        try{
            $GLOBALS["conn"]->beginTransaction();
            $stmt =$GLOBALS["conn"]->prepare("UPDATE apostante SET SALDO = :saldo WHERE DNI = :dni"); 
            $stmt->bindParam(':saldo', $saldoTotal);
            $stmt->bindParam(':dni', $dniNum);//actualiza la recaudacion para premios
            $stmt->execute();
            $GLOBALS["conn"]->commit();
        }catch(PDOException $e)
            {
                if ($GLOBALS["conn"]->inTransaction()) {
                    $GLOBALS["conn"]->rollBack(); 
                }
                echo "Error: " . $e->getMessage();
            }
}


function ingresarNumerosApost(){
    $numApuesta=ultimoNAPUESTA();
    $dniNum=nameUsuario();
    $numSorteo=$_POST['sorteo'];
    $fecha=date('Y-m-d');
    $numApos=recogerNuneros();
    $r=rand(0,9);

    try{
        $GLOBALS["conn"]->beginTransaction();
        $stmt = $GLOBALS["conn"]->prepare("INSERT INTO apuestas (NAPUESTA, DNI, NSORTEO, FECHA, N1, N2, N3, N4, N5, N6, R) 
                                    VALUES (:numApuesta, :numdni, :numSorteo, :fecha, :n1, :n2, :n3, :n4, :n5, :n6, :r)"); 
        $stmt->bindParam(':numApuesta', $numApuesta);
        $stmt->bindParam(':numdni', $dniNum);
        $stmt->bindParam(':numSorteo', $numSorteo);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':n1', $numApos[0]);
        $stmt->bindParam(':n2', $numApos[1]);
        $stmt->bindParam(':n3', $numApos[2]);
        $stmt->bindParam(':n4', $numApos[3]);
        $stmt->bindParam(':n5', $numApos[4]);
        $stmt->bindParam(':n6', $numApos[5]);
        $stmt->bindParam(':r', $r);
        $stmt->execute();
            
        
        $GLOBALS["conn"]->commit();
    }catch(PDOException $e)
        {
            if ($GLOBALS["conn"]->inTransaction()) {
                $GLOBALS["conn"]->rollBack(); 
            }
            echo "Error: " . $e->getMessage();
        }
}


function ultimoNAPUESTA(){

    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT NAPUESTA FROM apuestas ORDER BY NAPUESTA DESC LIMIT 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ultimoDigito=$stmt->fetch();

    
        if($ultimoDigito){
            $cod= intval($ultimoDigito['NAPUESTA']);//aqui intval convierte la cadena a entero en este caso de 001 a 1
		    $nuevoNum=$cod+1;
            
        }else{
            $nuevoNum=1; 
        }
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $nuevoNum;
}


function actualizarRecaudacionTotal(){
    
    $numSorteo=$_POST['sorteo'];
    try {
        $GLOBALS["conn"]->beginTransaction();

        // Obtener la recaudacion actual
        $stmt = $GLOBALS["conn"]->prepare("SELECT RECAUDACION FROM sorteo WHERE NSORTEO = :numSorteo");
        $stmt->bindParam(':numSorteo', $numSorteo);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $nuevaRecaudacion =($resultado['RECAUDACION']) + 1;
            //$recaudacionPremios =  $nuevaRecaudacion * 0.50;
            //echo $recaudacionPremios;
            // Actualizar ambos campos
            $stmt = $GLOBALS["conn"]->prepare("UPDATE sorteo SET RECAUDACION = :recaudacion WHERE NSORTEO = :numSorteo");
            $stmt->bindParam(':recaudacion', $nuevaRecaudacion);
            $stmt->bindParam(':numSorteo', $numSorteo);
            $stmt->execute();
        }

        $GLOBALS["conn"]->commit();
    } catch(PDOException $e) {
        if ($GLOBALS["conn"]->inTransaction()) {
            $GLOBALS["conn"]->rollBack(); 
        }
        echo "Error: " . $e->getMessage();
    }
}
?>