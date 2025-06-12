<?php

    require_once "controller_comunes.php";
    require_once "controller_session.php";
    require_once "../tpv/apiRedsys.php";
    require_once ("../db/db.php");
    iniciarSession();
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    //alertaCargarSaldo();
    var_dump($_SESSION);

    // Se crea Objeto
    $miObj = new RedsysAPI;

    if (!empty( $_POST ) ) 
    {//URL DE RESP. ONLINE
                        
        $version = $_POST["Ds_SignatureVersion"];
        $datos = $_POST["Ds_MerchantParameters"];
        $signatureRecibida = $_POST["Ds_Signature"];

        $decodec = $miObj->decodeMerchantParameters($datos);	
        
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
        $firma = $miObj->createMerchantSignatureNotif($kc,$datos);	

        if ($firma === $signatureRecibida){
            $codigoRespuesta = intval($miObj->getParameter("Ds_Response"));
            if($codigoRespuesta >= 0 && $codigoRespuesta < 100)
            {
                //alertaCargoRealizado();
                print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
               
                    require_once("../models/model_comprarproductos.php");
                    realizarPedido();//model_comprarproductos.php
                   
                }
            }
            else 
            {
                //alertaCargoNoRealizada();
                echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    
                    require_once("../models/model_comprarproductos.php");
                    realizarPedido();//model_comprarproductos.php
                   
                }
            }
        } 
        
    }
    else{
        if (!empty( $_GET ) )
        {//URL DE RESP. ONLINE
                
            $version = $_GET["Ds_SignatureVersion"];
            $datos = $_GET["Ds_MerchantParameters"];
            $signatureRecibida = $_GET["Ds_Signature"];
                
            $decodec = $miObj->decodeMerchantParameters($datos);
            $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
            $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
        
            if ($firma === $signatureRecibida){
                $codigoRespuesta = intval($miObj->getParameter("Ds_Response"));
                if($codigoRespuesta >= 0 && $codigoRespuesta < 100)
                {
                    //alertaCargoRealizado();
                    print "<h2><strong>Compra Realizada Con Exito</h2></strong>";
                    $datosCompra = json_decode($decodec,true);
                    if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                    {
                        
                        require_once("../models/model_comprarproductos.php");
                        realizarPedido();//model_comprarproductos.php
                        
                    }
                }
                else 
                {
                    //alertaCargoNoRealizada();
                    echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                    $datosCompra = json_decode($decodec,true);
                    if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                    {
                 
                        require_once("../models/model_comprarproductos.php");
                        realizarPedido();//model_comprarproductos.php
                       
                    }
                }
            } 
        }
        else{
            die("No se recibió respuesta");
        }
    }
    vaciarCesta();//vacia la cesta al final de todo, una vez hecho o no la compra.
   
    
?>

<a href="../controllers/controller_inicio.php" class="btn btn-warning">Volver al inicio</a>
