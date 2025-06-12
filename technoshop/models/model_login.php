<?php
function verificarDatos($usuario, $contraseña) 
{
  
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT  email, clave FROM clientes WHERE email = :usu AND clave = :contra");
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