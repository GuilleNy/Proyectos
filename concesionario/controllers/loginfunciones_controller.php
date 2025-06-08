<?php
function login($user, $password, $tipoCliente) {

    //Si cliente
    if ($tipoCliente === 'clientes'){
        $cliente = datosCliente($user);

        if (!$cliente){
            trigger_error('Usuario inexistente', E_USER_WARNING);
            return false;
        }

        $passCliente = $cliente['clave'];

        //contraseña incorrecta o usuario inexistente
        if ($passCliente != $password){
            trigger_error('Contraseña incorrecta', E_USER_WARNING);
            return false;
        }

        //$_SESSION['usuario'] = $cliente['email'];
        $_SESSION['usuario'] = [
            'idcliente' => $cliente['email'],
            'tipo' => "clientes"
        ];

    }else{
        //Si Empleado
        if($tipoCliente === 'empleados'){
            $empleado = datosEmpleado($user);
        }

        if (!$empleado){
            trigger_error('Usuario inexistente', E_USER_WARNING);
            return false;
        }

        $passEmpleado = $empleado['clave'];

        //contraseña incorrecta o usuario inexistente
        if ($passEmpleado != $password){
            trigger_error('Contraseña incorrecta', E_USER_WARNING);
            return false;
        }

        //$_SESSION['usuario'] = $empleado['cod_empleado'];
        $_SESSION['usuario'] = [
            'idcliente' => $empleado['cod_empleado'],
            'tipo' => 'empleados'
        ];
    }

    return true;
}
?>