<?php

function obtenerNombreUsuario(){

    $email=emailUsuario();
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT `name` FROM passengerdetails WHERE emailaddress=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $nombre=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $nombre['name'];
}

?>