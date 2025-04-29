<?php 
session_start();
include_once "conexionBaseDeDatos.php";
include_once "BBDD_realizarSorteo.php";

/*****************PROGRAMA PRINCIPAL************************* */
if(isset($_POST['realizarApuesta'])){
    
    

    
}else if(isset($_POST['atras']))
{
    //unset($_SESSION["sort"]);
    header("Location: ./inicio.php");
    exit;
}   
/************************************************************* */

function verificarSaldo(){
//verifico que tenga saldo y si tiene le resto 1€ de su cuenta
    $haySaldo=false;
    

    if($haySaldo){
        
            
        header("Location: ./realizarApuesta.php");
        exit;

    }else{
        $_SESSION['mensajeSorteoFail']="No tienes saldo en tu cuenta";
        header("Location: ./realizarApuesta.php");
        exit;
    }

}

function insertarApuesta(){
//inserto los datos de la apuesta y genero el numero del reintegro
}

?>