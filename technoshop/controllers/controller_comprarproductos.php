<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_inicio.php");
    require_once("../models/model_comprarproductos.php");

    
    iniciarSession();
    //alertaCampoVreserva();
    
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['agregar'])){
        if(!empty($_POST['agregar'])){
            $producto = $_POST['productos'];
            
            annadirCesta($producto);//controller_session.php
            header("Refresh: 0");
            reservaAñadida();//controller_session.php

        }else{
            campoNoCompletado();//controller_session.php   
        }
    } else if(isset($_POST['pedido'])){
        $importeTotal=obtenerImporteTotal();//controller_session.php 

        //esto necesariompara la pasarela de pago
        require_once "controller_redsys.php";
        list($params,$signature,$version) = redireccionarPago($importeTotal);

        //estan en controller_repuestaCompra
        //realizarReserva();//model_vreservas.php
        //vaciarCesta();//controller_session.php  


    }else if(isset($_POST['vaciar'])){
        vaciarCesta();//controller_session.php
        header("Refresh: 0");
    }else if(isset($_POST['volver'])){
        header("Location: ../controllers/controller_inicio.php ");
        exit();
    }
    $datosUsuario=obtenerNombreApellido();//model_vreservas.php
    $allProductos=todosLosProductos();

    $cesta = devolverCesta();//controller_session.php

    $total=[];
    $total=obtenerImporteTotal();

    var_dump($total);
    
    
    
    require_once("../views/view_compraproductos.php");
    
?>