<?php

include_once "conexionBaseDeDatos.php";
include_once "func_sesiones.php";
/*****************VERIFICAR LA SESION********************** */
if(!verificarSesion())
{
	header("Location: ./login.php");
    exit;// esto  detiene la ejecución del script.
}
/************************ALERTA***************************** */
if (isset($_SESSION['mensajeSorteo'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['mensajeSorteo'] . "</div>";
    unset($_SESSION['mensajeSorteo']); 
}else if(isset( $_SESSION['mensajeSorteoFail'])){
    echo "<div class='alert alert-danger'>" . $_SESSION['mensajeSorteoFail'] . "</div>";
    unset($_SESSION['mensajeSorteoFail']); 
}


$sortActivos=SorteosActivos();
//var_dump($sortActivos);
function SorteosActivos(){
    $conn=conexionBBDD();


    try{
        //$conn->beginTransaction(); 
        //no es necesario, las transacciones se usan generalmente para operaciones que modifican datos INSERT, UPDATE, DELETE.

        $stmt=$conn->prepare("SELECT NSORTEO  FROM sorteo WHERE ACTIVO='A'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();


    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack();  // Solo hacer rollBack si hay transacción activa
            }
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    return $numSorteos;
}

/******************************************************************************************************** */
/******************************************************************************************************** */



calcularPremiosGanadores();

function calcularPremiosGanadores(){
    //$numSorteo=$_POST['sorteo'];
    //$cantidadPremios=calcularRecaudacionPremio($numSorteo);//2500

    //$combGand=explode("-", $_SESSION["numGand"]);
    //$numReintegro=array_slice($combGand, count($combGand)-1);//Combinacion ganadora

    //$combGand=array_slice($combGand, 1, count($apuesta)-1) //30-39-5-24-36-43
    $numeroAp=obetenerNumeroApost();//devuelve los 7 numeros de la apuesta

    $cantidadPremios=2500;
    $combGand="30-39-5-24-36-43";
    $numReintegro="8";
    $numeroGand=explode("-", $combGand);
    
    $ganadores=array();

    foreach ($numeroAp as $clave => $subArray)  {
       //echo "Clave principal: $clave\n";
        foreach ($subArray  as $indice => $valor) {
           // echo "  Índice ". $indice . " => $valor " . gettype($valor) . "\n";
            $combApuesta = array_slice($subArray,0, - 1);//30-39-5-24-36-43
            $reintegro=array_slice($subArray,- 1);// me deuelve el ultimo elemento del array
            var_dump($reintegro) ;
            $aciertos = count(array_intersect($combApuesta, $numeroGand));
            if($aciertos == 6){
                //$categoria="6";
                if($reintegro == $numReintegro){
                    $ganadores[$clave]=$aciertos+1;
                    
                }else{
                    $ganadores[$clave]=$aciertos;
                }
            }else if($aciertos == 5){
                
                $ganadores[$clave]=$aciertos;
    
                if($reintegro == $numReintegro){
                    $ganadores[$clave]=$aciertos;
              
                }
            }
           
        }
        echo "\n";
    }
    //var_dump($ganadores) ;
/*
    switch ($categoria) {
        case "6":
            echo "Ganaste sin reintegro";
            //funcion para insertar el premio a la puesta en la tabla apuestas, su categoria y a su saldo en la tabla apostante.
            break;
    
        case "5C":
            echo "¡Por fin viernes! 🎉";
            break;
    
        case "5":
            echo "Domingo de descanso 😌";
            break;
    
        case "4":
            echo "Domingo de descanso 😌";
            break;

        case "3":
            echo "Domingo de descanso 😌";
            break;

        case "6R":
            echo "Numero de apuesta: " . $ganador . " Ganaste con Reintegro";
            break;
    
        case "5CR":
            echo "¡Por fin viernes! 🎉";
            break;
    
        case "5R":
            echo "Domingo de descanso 😌";
            break;
    

        case "4R":
            echo "Domingo de descanso 😌";
            break;

        case "3R":
            echo "Domingo de descanso 😌";
            break;

        case "R":
            echo "Domingo de descanso 😌";
            break;
    
        default:
            echo "No ";
    }

*/

}
//$numero=$_SESSION["numGand"];
//printf($numero);

function obetenerNumeroApost(){
    $numeros=obetenerApuestas("S001");
    //$soloValores=array_values($numeros);
    //print_r($numeros);
    
    
    $arrayApuest=array();
    
    foreach($numeros as $index => $apuesta){
        //lo que hago aqui es que ubico la clave NAPUESTA al nuevo arrayApuest y le asigno el valor con array_slice a partir del
        //1 al total del array para solo obtener los numero del voleto, excluyendo NAPUESTA.
        //Luego con array_values elimino las claves
        $arrayApuest[$apuesta['NAPUESTA']]=array_values(array_slice($apuesta, 1, count($apuesta)-1));//aqui puedo cambiar en count($apuesta) por un numero menos para obetenr solo los digitos sin el reintegro 
    }
    return $arrayApuest;
}

$numero=obetenerNumeroApost();
//print_r($numero);

function obetenerApuestas($numSorte){
    $conn=conexionBBDD();
    try{
        //$conn->beginTransaction(); 
        //no es necesario, las transacciones se usan generalmente para operaciones que modifican datos INSERT, UPDATE, DELETE.

        $stmt=$conn->prepare("SELECT NAPUESTA ,N1, N2, N3, N4, N5, N6, R FROM apuestas WHERE NSORTEO=:numSort");
        $stmt->bindParam(':numSort', $numSorte);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();


    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack();  // Solo hacer rollBack si hay transacción activa
            }
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    return $numSorteos;


}



?>