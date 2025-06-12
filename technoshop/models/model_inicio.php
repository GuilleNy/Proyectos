<?php

function obtenerNombreApellido(){

    $email=emailUsuario();
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT nombre, apellidos, fecha_nacimiento FROM clientes WHERE email=:clienteEmail");
        $stmt->bindParam(':clienteEmail', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $nombre=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $nombre;
}

?>