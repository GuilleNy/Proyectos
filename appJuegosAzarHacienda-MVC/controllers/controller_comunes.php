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


function recaudacionPremio($num, $conn){
    $cantidadTotalRec=obtenerRecaudacion($num, $conn);
    return ($cantidadTotalRec*0.50);//El 50% recaudación se dedica a premios.
}

function repartirPremio( $conn){
    //premio de 500
    
    $ganadores=calculoPremio($conn); //array(9) { ["6R"]=> float(126) [6]=> float(125) ["5R"]=> float(26) [5]=> float(25) ["4R"]=> int(0) [4]=> int(0) ["3R"]=> int(0) [3]=> int(0) ["R"]=> int(0) }
    $todosLosGand=$_SESSION['ganadores'];//array(4) { ["6R"]=> array(1) { [0]=> int(1) } [5]=> array(2) { [0]=> int(3) [1]=> int(5) } ["5R"]=> array(1) { [0]=> int(4) } [6]=> array(1) { [0]=> int(6) } }
    foreach($todosLosGand as $categ=> $subArray){
            foreach($subArray as $indice => $NAPUESTA){
                if(isset($ganadores[$categ])){
                    $premioAsignado = $ganadores[$categ];
                    //echo "Al número de apuesta $NAPUESTA le corresponde un premio de $premioAsignado € en la categoría $categ ";
                    insertarPremio($categ, $NAPUESTA, $premioAsignado, $conn);
                }
            }
    }
    //var_dump($todosLosGand);
}


function calculoPremio($conn){
    $sorteoSele=$_POST['sorteo'];//S001
    $cantidadPremios=recaudacionPremio($sorteoSele, $conn);//500
    $premios = [ "6R" => 0, "6" => 0, "5R" => 0, "5" => 0, "4R" => 0, "4" => 0, "3R" => 0, "3" => 0, "R" => 0 ];
    $ganadores=numeroGandPorCatg($conn); //array(9) { ["6R"]=> int(1) [6]=> int(0) ["5R"]=> int(1) [5]=> int(2) ["4R"]=> int(0) [4]=> int(0) ["3R"]=> int(0) [3]=> int(0) ["R"]=> int(0) }


    foreach($ganadores as $catg => $cant){
        if ($cant != 0){
            if($catg == "6" || $catg == "6R"){
                $premio_base = ($cantidadPremios * 0.50) / ($ganadores["6"] + $ganadores["6R"]);
            } elseif($catg == "5" || $catg == "5R"){
                $premio_base = ($cantidadPremios * 0.15) / ($ganadores["5"] + $ganadores["5R"]);
            } elseif($catg == "4" || $catg == "4R"){
                $premio_base = ($cantidadPremios * 0.10) / ($ganadores["4"] + $ganadores["4R"]);
            } elseif($catg == "3" || $catg == "3R"){
                $premio_base = ($cantidadPremios * 0.05) / ($ganadores["3"] + $ganadores["3R"]);
            } else {
                $premio_base = 0;
            }
    
            // A cada categoría con reintegro le sumas 1 €
            if (str_ends_with($catg, "R")) {
                $premios[$catg] = $premio_base + 1;
            } else {
                $premios[$catg] = $premio_base;
            }
        }
    }
    
    //var_dump($premios);
    return $premios;
}


function obetenerNumeroApost($conn){
    $numSort=$_POST['sorteo'];
    $numeros=obetenerApuestas($numSort, $conn);
    $arrayApuest=array();
    
    foreach($numeros as $index => $apuesta){
        //lo que hago aqui es que ubico la clave NAPUESTA al nuevo arrayApuest y le asigno el valor con array_slice a partir del
        //1 al total del array para solo obtener los numero del voleto, excluyendo NAPUESTA.
        //Luego con array_values elimino las claves
        $arrayApuest[$apuesta['NAPUESTA']]=array_values(array_slice($apuesta, 1, count($apuesta)-1));//aqui puedo cambiar en count($apuesta) por un numero menos para obetenr solo los digitos sin el reintegro 
    }
    return $arrayApuest;
}


function numeroGandPorCatg($conn){
    //$_SESSION["numGand"] --> "30-39-5-24-36-43-8"
    $premios = [ "6R" => 0, "6" => 0, "5R" => 0, "5" => 0, "4R" => 0, "4" => 0, "3R" => 0, "3" => 0, "R" => 0 ];// es un array que tiene en cada clave el numero de ganadores por categoria.
    $_SESSION['ganadores'] = array();//Es un array que como clave tiene la categoria y dentro de esa clave hay un sub array de el num de clave del apostante.
    $combGand=array_map('intval', explode("-", $_POST['combGanadora'])); //[30, 39, 5, 24, 36, 43, 8]
    $numReintegro=array_pop($combGand); //Combinacion ganadora 8 ; array_pop() se usa para quitar el último elemento de un array y devolverlo. También modifica el array original.

    $numeroAp=obetenerNumeroApost($conn);//devuelve los 7 numeros de la apuesta ["30", "39", "5", "24", "36", "43", "8"] todo tipo string
                                    // el cual lo debo recorrer con un foreach
   

    foreach ($numeroAp as $clave => $subArray)  {
        $subArray=array_map('intval', $subArray);//[30, 39, 5, 24, 36, 43, 8]
        $reintegro=array_pop($subArray);// me deuelve el numero del reintegro del array.
        
        //var_dump($reintegro) ;
        $aciertos = count(array_intersect($subArray, $combGand));
        
        if($aciertos == 6){
            if($reintegro == $numReintegro){
                $_SESSION['ganadores']["6R"][] = $clave;
                $premios["6R"]++;
            }else{
                $_SESSION['ganadores']["6"][] = $clave;
                $premios["6"]++;
            }
        }else if($aciertos == 5){
            if($reintegro == $numReintegro){
                $_SESSION['ganadores']["5R"][] = $clave;
                $premios["5R"]++;
            }else{
                $_SESSION['ganadores']["5"][] = $clave;
                $premios["5"]++;
            }
        }else if($aciertos == 4){  
            if($reintegro == $numReintegro){
                $_SESSION['ganadores']["4R"][] = $clave;
                $premios["4R"]++;
            }else{
                $_SESSION['ganadores']["4"][] = $clave;
                $premios["4"]++;
            }

        }else if($aciertos == 3){
            if($reintegro == $numReintegro){
                $_SESSION['ganadores']["3R"][] = $clave;
                $premios["3R"]++;
            }else{
                $_SESSION['ganadores']["3"][] = $clave;
                $premios["3"]++;
            }

        }else if($aciertos == 0){
            if($reintegro == $numReintegro){
                $_SESSION['ganadores']["R"][] = $clave;
                $premios["R"]++;
            }
        }
    }
    
    //var_dump($_SESSION['ganadores']);
    //var_dump($premios);
    return $premios;
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