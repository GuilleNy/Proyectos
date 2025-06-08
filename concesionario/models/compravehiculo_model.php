<?php
  require_once('db/funciones.php');

  function datosCliente($user) {
    $sql = "SELECT *
            FROM clientes
            WHERE email = :email";
    $valores = [':email' => $user];
    $resultado = operarBd($sql, $valores);

    return $resultado ? $resultado[0] : false;
  }

  function vehiculosDisponibles(){
    $sql = "SELECT num_bastidor, marca, modelo, kms, precio_vehiculo, descuento 
            FROM vehiculos WHERE fecha_venta IS NULL";
    return operarBd($sql);
}

function detallesVuelo($v){
    $sql = "SELECT num_bastidor, matricula, marca, modelo, kms, precio_vehiculo, descuento, fecha_venta
            FROM vehiculos
            WHERE num_bastidor = :num_bastidor";
    $valores = ['num_bastidor' => $v];
    return operarBd($sql, $valores)[0];
}

function buscarDni($cliente) {
    $sql = "SELECT dni
              FROM clientes
              WHERE email = :email";
    $args = [':email' => $cliente];

    return operarBd($sql, $args)[0]['dni'];
}

function obtenerUltIdPedido() {
    $sql = "SELECT num_pedido
              FROM pedidos
              ORDER BY 1 DESC
              LIMIT 1";
    
    return operarBd($sql)[0]['num_pedido'];
}

// Función para añadir una reserva
function anadirPedido($idPedido, $dni, $importeTotal) {
    $sql = "INSERT INTO pedidos (num_pedido, dni, fecha_venta, importe_total)
              VALUES (:num_pedido, :dni, NOW(), :importe_total)";
    $args = [':num_pedido' => $idPedido, ':dni' => $dni, ':importe_total' => $importeTotal];
  
    return operarBd($sql, $args);
}

// Función para ocupar los asientos de un vuelo
function anadirLineaPedido($idPedido, $num_linea, $num_bastidor, $precio) {
    $sql = "INSERT INTO lineaspedido (num_pedido, num_linea, num_bastidor, precio_vehiculo)
              VALUES (:num_pedido, :num_linea, :num_bastidor, :precio_vehiculo)";
    $args = [':num_pedido' => $idPedido, ':num_linea' => $num_linea, ':num_bastidor' => $num_bastidor, ':precio_vehiculo' => $precio];
  
    return operarBd($sql, $args);
}
?>