<?php
function verificarDatos($usuario, $contraseña) 
{
  
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT DNI, APELLIDO FROM apostante WHERE DNI = :usu AND APELLIDO = :contra");
        $stmt->bindParam(':usu', $usuario);
        $stmt->bindParam(':contra', $contraseña);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $resultado;
}


?>