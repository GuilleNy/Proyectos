<?php
function todosLosProductos(){
    
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT c.nombre_categoria , p.id_producto, p.nombre_producto, p.precio_unidad , p.descuento
                                        FROM categorias c, productos p
                                        WHERE c.id_categoria=p.id_categoria AND p.num_unidades > 0
                                        ORDER BY c.nombre_categoria");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numReservas=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $numReservas;
}

$datos=devolverCesta();
    $importeTotal=0;

    foreach ($datos as $clave => $valor) {

        if($valor[3] != 0){
            $precioConDescuento=($valor[2]*$valor[3])/100;
            $importeTotal=$importeTotal+$precioConDescuento;
        }else{
            $importeTotal=$importeTotal+$valor[2];
        }
    }


function realizarPedido(){
    $idreserva=obtenerUltimoId();
    $dni= obtenerdni();
    $fecha=date("Y-m-d");
    $importeTotal=0;

    $datosReserva=devolverCesta();
  
    foreach($datosReserva as $vuelo => $reserva){
        $numPedido=obtenerUltimoIdPedido();

        if($reserva[3] != 0){
            $precioConDescuento=($reserva[2]*$reserva[3])/100;
            $importeTotal=$importeTotal+$precioConDescuento;
        }else{
            $importeTotal=$importeTotal+$reserva[2];
        }
        try{
        $GLOBALS["conn"]->beginTransaction();
        $stmt = $GLOBALS["conn"]->prepare("INSERT INTO pedidos; (num_pedido, dni, fecha_venta, importe_total) 
                                    VALUES (:numPedido, :dni, :fecha, :precioTotal)"); 
        $stmt->bindParam(':numPedido', $numPedido);
        $stmt->bindParam(':dni', $dni );
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':precioTotal', $importeTotal);
        $stmt->execute();
        
        $GLOBALS["conn"]->commit();
    }catch(PDOException $e)
        {
            if ($GLOBALS["conn"]->inTransaction()) {
                $GLOBALS["conn"]->rollBack(); 
            }
            echo "Error: " . $e->getMessage();
        }
    }
}

function obtenerdni(){
    $email=emailUsuario();
      try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT dni
                                        FROM clientes
                                        WHERE apellidos = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $dni=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $dni['dni'];

}

function obtenerUltimoIdPedido(){

     try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT num_pedido FROM pedidos ORDER BY num_pedido DESC LIMIT 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ultimoID=$stmt->fetch();

    
        if($ultimoID){
            $cod= intval($ultimoID['num_pedido']);//aqui intval convierte la cadena a entero en este caso de 001 a 1
		    $nuevoNum=$cod+1;
            
        }else{
            $nuevoNum=1; 
        }
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $nuevoNum;
    
}











?>