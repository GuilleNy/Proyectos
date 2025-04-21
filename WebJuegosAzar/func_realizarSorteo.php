<?php 
session_start();//agregue aqui la sesion
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

/*****************PROGRAMA PRINCIPAL************************* */
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
/************************************************************* */

//Funcion para calcular la recaudacion de premios
//Funcion para insertar la recaudacion de premios en la tabla 
//Recordar que en la recaudacion total de las apuestas la mitad se ira a los premios para los ganadores,
//en esa mitad un 50% se va a la catg 6, 20% a la catg 5C, 15% a la catg 5, 10% a la catg 4 y un 5% a la catg 3.

//Funcion para actualizar el saldo de las cuentas de los apostantes en base a los premios obtenidos.


//Funcion para insertar la combinacion ganadora en la tabla
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

function insertarCombinacionGand(){
    $combinacion=$_SESSION["numGand"];
    $sorteoSele=$_POST['sorteo'];
    //$valido=false;
    $conn=conexionBBDD();
    try{
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE sorteo SET COMBINACION_GANADORA = :combGanadora ,  ACTIVO = 'N'  WHERE NSORTEO = :numSorteo"); 
	
        //asigna valores a los marcadores de posicion
        $stmt->bindParam(':numSorteo', $sorteoSele);
        $stmt->bindParam(':combGanadora', $combinacion);
        

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




?>