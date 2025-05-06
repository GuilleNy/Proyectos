<?php

    require_once "controller_comunes.php";
    require_once "controller_session.php";
    require_once "../tpv/apiRedsys.php";
    require_once ("../db/db.php");
    iniciarSession();

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
                    $importe = intval($datosCompra['Ds_Amount'])/100;
                    require_once "../models/model_cargarSaldo.php";
                    require_once "../models/model_registro.php";
                    //$infoCliente = recuperarInformacionCliente();
                    ingresarRegistro();//si todo esta correcto con el pago realizo la insercion de los datos del apostante
                    insertarPagoRegistro($importe);// una vez registrado ingreso el cargo realizado a su cuenta o a su campo SALDO de su tabla apostante
                }
            }
            else 
            {
                //alertaCargoNoRealizada();
                echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                $datosCompra = json_decode($decodec,true);
                if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                {
                    $importe = intval($datosCompra['Ds_Amount'])/100;
                    require_once "../models/model_cargarSaldo.php";
                    //$infoCliente = recuperarInformacionCliente();
                    
                    insertarPagoRegistro($importe);
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
                        $importe = intval($datosCompra['Ds_Amount'])/100;
                        require_once "../models/model_cargarSaldo.php";
                        require_once "../models/model_registro.php";
                        //$infoCliente = recuperarInformacionCliente();
                        ingresarRegistro();
                        insertarPagoRegistro($importe);
                    }
                }
                else 
                {
                    //alertaCargoNoRealizada();
                    echo "<h2><strong>Compra en Espera. Pago no Realizado</h2></strong>";
                    $datosCompra = json_decode($decodec,true);
                    if ($datosCompra !== null && isset($datosCompra['Ds_Amount']))
                    {
                        $importe = intval($datosCompra['Ds_Amount'])/100;
                        require_once "../models/model_cargarSaldo.php";
                        //$infoCliente = recuperarInformacionCliente();
                        
                        insertarPagoRegistro($importe);
                    }
                }
            } 
        }
        else{
            die("No se recibió respuesta");
        }
    }
   
    //require_once ("../views/view_repuestaCompra.php"); borre view_repuestaCompra.php
?>

<a href="../controllers/controller_inicio.php" class="btn btn-warning">Volver al inicio</a>
