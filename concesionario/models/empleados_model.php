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
?>