<?php

function depurar($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=htmlspecialchars($cadena);
    return $cadena;
}

function validarRegistro(){
    $enviar=true;
    if(empty(trim($_POST['dni']))){
        $enviar=false;
    }else if(empty(trim($_POST['nombre']))){
        $enviar=false;
    }else if(empty(trim($_POST['apellido']))){
        $enviar=false;
    }else if(empty(trim($_POST['email']))){
        $enviar=false;
    }
    return $enviar;
}

function recogerDatosRegistro(){
    $VstDni=depurar($_POST['dni']);
    $VstNombre=depurar($_POST['nombre']);
    $VstApellido=depurar($_POST['apellido']);
    $VstEmail=depurar($_POST['email']);
    return [$VstDni, $VstNombre, $VstApellido, $VstEmail];
}


function validar(){
    $enviar=true;
    if(empty(trim($_POST['n1']))){
        $enviar=false;
    }else if(empty(trim($_POST['n2']))){
        $enviar=false;
    }else if(empty(trim($_POST['n3']))){
        $enviar=false;
    }else if(empty(trim($_POST['n4']))){
        $enviar=false;
    }else if(empty(trim($_POST['n5']))){
        $enviar=false;
    }else if(empty(trim($_POST['n6']))){
        $enviar=false;
    }
    
    return $enviar;
}

function recogerNuneros(){
    $i=1;

    $numerosSelect=array();
    while(count($numerosSelect) < 6 && $i<=6){
        $num=$_POST["n$i"];
        if(!in_array($num, $numerosSelect)){
            $numerosSelect[]=$num;
        }
        $i++;
    }
    return $numerosSelect;
}

function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr<br>";
    echo "Ending Script";
    die();
}

set_error_handler("customError",E_USER_WARNING);

function errores($errno, $errstr) {
    echo "<b>$errstr</b>";
}

set_error_handler("errores");

?>