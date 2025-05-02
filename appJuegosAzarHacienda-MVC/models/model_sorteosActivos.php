<?php

function sorteosActivos($conn){
    
    try{
        $stmt=$conn->prepare("SELECT NSORTEO  FROM sorteo WHERE ACTIVO='A'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();


    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        

    return $numSorteos;
}

function todosLosSorteos($conn){

    try{
        $stmt=$conn->prepare("SELECT NSORTEO FROM sorteo");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();

    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    return $numSorteos;
}


?>