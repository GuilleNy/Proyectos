<?php 
session_start();
include_once "conexionBaseDeDatos.php";
include_once "BBDD_obtenerApost.php";
/*****************************PROGRAMA PRINCIPAL************************* */
if(isset($_POST['generar'])){
    $_SESSION["numGand"]=generarCombinacion();
    header("Location: ./realizarSorteo.php");
    exit;
}else if(isset($_POST['realizarSorteo'])){
    if(!empty($_POST['combGanadora'])){
        insertarCombinacionGand();
        //Aqui prodria ir la funcion para calcular la recaudacion de los premios
        unset($_SESSION["numGand"]);
        header("Location: ./realizarSorteo.php");
        exit;
    }else{
        $_SESSION['mensajeSorteoFail']="Debes generar una Combinacion Ganadora";
        header("Location: ./realizarSorteo.php");
        exit;
    } 
}
else if(isset($_POST['atras']))
{
    unset($_SESSION["numGand"]);
    header("Location: ./inicio.php");
    exit;
}   
/*************************************************************************** */

//Funcion para insertar la recaudacion de premios en la tabla 
//Recordar que en la recaudacion total de las apuestas la mitad se ira a los premios para los ganadores,
//en esa mitad un 50% se va a la catg 6, 20% a la catg 5C, 15% a la catg 5, 10% a la catg 4 y un 5% a la catg 3.


function generarCombinacion(){
    $numAleatorios=array();
    
    while(count($numAleatorios) < 6){
        $num=rand(1,49);
        if(!in_array($num, $numAleatorios)){
            $numAleatorios[]=$num;
        }
    }

    $numAleatorios[]=rand(0,9);

    $cadenaGan=implode("-", $numAleatorios);
    return $cadenaGan;
}
/********************************************************************************************/
function calcularRecaudacionPremio($num){
    $cantidadTotalRec=obtenerRecaudacion($num);
    return ($cantidadTotalRec*0.50);//El 50% recaudación se dedica a premios.
}
/******************************************************************************************** */
function insertarCombinacionGand(){
    $combinacion=$_SESSION["numGand"];
    $sorteoSele=$_POST['sorteo'];
    $numeroDelSorteo=calcularRecaudacionPremio($sorteoSele);
    //$valido=false;
    $conn=conexionBBDD();
    try{
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE sorteo SET COMBINACION_GANADORA = :combGanadora , RECAUDACION_PREMIOS=:recaud, ACTIVO = 'N'  WHERE NSORTEO = :numSorteo"); 
        $stmt->bindParam(':numSorteo', $sorteoSele);
        $stmt->bindParam(':recaud', $numeroDelSorteo);//actualiza la recaudacion para premios
        $stmt->bindParam(':combGanadora', $combinacion);//agrega la combinacion ganadora
        

        if($stmt->execute()){
            //$valido=true;
            $_SESSION['mensajeSorteo']="Sorteo realizado correctamente.";
        }
        $conn->commit();
    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack(); 
            }
            echo "Error: " . $e->getMessage();
        }
    //return $valido;
}

/********************************************************************************************* */
function obtenerRecaudacion($numeroSort){
    $conn=conexionBBDD();
    try{
       
        $stmt=$conn->prepare("SELECT RECAUDACION FROM sorteo WHERE NSORTEO=:numSorteo");
        $stmt->bindParam(':numSorteo', $numeroSort);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetch();


    }catch(PDOException $e)
        {
            if ($conn->inTransaction()) {
                $conn->rollBack();  // Solo hacer rollBack si hay transacción activa
            }
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    return  (float)$numSorteos['RECAUDACION'];

}
/********************************************************************************************************* */


//Funcion para actualizar el saldo de las cuentas de los apostantes en base a los premios obtenidos.


//$numSorteo=$_POST['sorteo'];
    //$cantidadPremios=calcularRecaudacionPremio($numSorteo);//2500

    //$combGand=explode("-", $_SESSION["numGand"]);
    //$numReintegro=array_slice($combGand, count($combGand)-1);//Combinacion ganadora

    //$combGand=array_slice($combGand, 1, count($apuesta)-1) //30-39-5-24-36-43
    $numero=obetenerNumeroApost();//devuelve los 7 numeros de la apuesta

$cantidadPremios=2500;
$combGand="30-39-5-24-36-43";
$numReintegro="8";
$numeroGand=explode("-", $combGand);
$categoria = "";

foreach ($numero as $clave => $subArray)  {
    echo "Clave principal: $clave\n";
    foreach ($subArray  as $indice => $valor) {
        echo "  Índice $indice =>  $valor\n";
        $reintegro=$subArray[count($subArray) - 1];  //8
        $combApuesta = array_slice($subArray, 1, count($subArray) - 1); //30-39-5-24-36-43
        $aciertos = count(array_intersect($combApuesta, $numeroGand));


        if($aciertos == 6){
            $categoria="6";
            $ganador=$clave;
            
        }
    }
    echo "\n";
}


?>