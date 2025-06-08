<?php
  require_once('db/funciones.php');

  function datosEmpleado($user) {
    $sql = "SELECT *
            FROM empleados
            WHERE cod_empleado = :cod_empleado";
    $valores = [':cod_empleado' => $user];
    $resultado = operarBd($sql, $valores);

    return $resultado ? $resultado[0] : false;
  }

  function darAltaVehiculo($num_bastidor, $matricula, $marca, $modelo, $kms, $precio, $descuento, $cod_empleado){
    $sql = "INSERT INTO vehiculos (num_bastidor, matricula, marca, modelo, kms, precio_vehiculo, descuento, fecha_venta, cod_empleado_alta)
              VALUES (:num_bastidor, :matricula, :marca, :modelo, :kms, :precio_vehiculo, :descuento, NULL, :cod_empleado_alta)";
    $valores = [':num_bastidor' => $num_bastidor, ':matricula' => $matricula, ':marca' => $marca, ':modelo' => $modelo, ':kms' => $kms, ':precio_vehiculo' => $precio, ':descuento' => $descuento, ':cod_empleado_alta' => $cod_empleado];
  
    return operarBd($sql, $valores);
  }
?>