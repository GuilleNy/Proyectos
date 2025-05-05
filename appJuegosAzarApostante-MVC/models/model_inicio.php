<?php

function saldoApostador(){

    $dni=nameUsuario();
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT SALDO FROM apostante WHERE DNI=:dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $saldo=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $saldo;
}

?>