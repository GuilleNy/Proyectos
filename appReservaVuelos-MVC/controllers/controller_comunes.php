<?php

function depurar($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=htmlspecialchars($cadena);
    return $cadena;
}

function validarRegistro(){
    $enviar=true;
    if(empty(trim($_POST['nombre']))){
        $enviar=false;
    }else if(empty(trim($_POST['fechaNac']))){
        $enviar=false;
    }else if(empty(trim($_POST['genero']))){
        $enviar=false;
    }else if(empty(trim($_POST['direccion']))){
        $enviar=false;
    }else if(empty(trim($_POST['codigoPostal']))){
        $enviar=false;
    }else if(empty(trim($_POST['email']))){
        $enviar=false;
    }else if(empty(trim($_POST['telefono']))){
        $enviar=false;
    }
    return $enviar;
}

function recogerDatosRegistro(){
    $VstNombre=depurar($_POST['nombre']);
    $VstFechaNac=depurar($_POST['fechaNac']);
    $VstSexo=depurar($_POST['genero']);
    $VstDireccion=depurar($_POST['direccion']);
    $VstCiudad=depurar($_POST['ciudad']);
    $VstCodPostal=depurar($_POST['codigoPostal']);
    $VstPais=depurar($_POST['pais']);
    $VstEmail=depurar($_POST['email']);
    $VstTelefono=depurar($_POST['telefono']);
    return [$VstNombre, $VstFechaNac,$VstSexo,$VstDireccion,$VstCiudad,$VstCodPostal,$VstPais, $VstEmail, $VstTelefono];
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