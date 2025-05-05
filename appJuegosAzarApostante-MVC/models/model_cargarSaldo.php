<?php
/*
function recuperarInformacionCliente()
{
    $dni = nameUsuario();
    try
    {
        $stmt = $GLOBALS["conn"]->prepare("SELECT DNI, NOMBRE, APELLIDO, EMAIL FROM apostante WHERE DNI =:dni ");
        $stmt->bindParam(':dni', $dni);
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetch();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    return $resultado;
}
    */

function insertarPago($importeTotal)
    {
        require_once("controller_session.php");
        $dni = nameUsuario();
        try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE apostante SET SALDO = SALDO + :cargar WHERE DNI = :dni");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':cargar', $importeTotal);
        
            $stmt -> execute();
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

?>