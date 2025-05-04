<?php

function sorteosActivos(){
    
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT NSORTEO  FROM sorteo WHERE ACTIVO='A'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();


    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        

    return $numSorteos;
}

function todosLosSorteos(){

    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT NSORTEO FROM sorteo");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();

    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        

    return $numSorteos;
}


?>