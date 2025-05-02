<?php
function verificarDatos($usuario, $contraseña,$conn) 
{
  
    try{
        $stmt=$conn->prepare("SELECT DNI, APELLIDO FROM empleado WHERE DNI = :usu AND APELLIDO = :contra");
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