<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosnn";

try {
	//Conexion a la base de datos usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	$dniUsu= $_POST['dni']?? '';
	
	$depart=$_POST['departamento']?? '';
	
	$datos=[$dniUsu, $depart];
	
	//obtengo el departamento seleccionado y lo que hago es mediante esa seleccion , mediante una select
	//obtener el codigo y asi poder trabajar con el.
	function obtenerCodigo($datos, $conn)
	{
		$stmt = $conn->prepare("SELECT cod_dpto
								FROM dpto
								where nombre=:nombreSeleccion");
								
		$stmt->bindParam(':nombreSeleccion', $datos[1]);
		$stmt->execute();

		 $stmt->setFetchMode(PDO::FETCH_ASSOC);
		 $cod=$stmt->fetch();
	return $cod;	
	}
	
	$seleccionado=obtenerCodigo($datos, $conn);
	
	
	function asignarDpto($datos, $conn, $seleccionado)
	{
		$stmt = $conn->prepare(" select d.cod_dpto, d.nombre, e.dni 
								from emple_dpto e 
								inner join dpto d on e.cod_dpto= d.cod_dpto");
		$stmt->execute();

		 $stmt->setFetchMode(PDO::FETCH_ASSOC);
		 $datosEmpleDpto=$stmt->fetchAll();
		 
		 if($datosEmpleDpto)
		 {
			 
			 for ($i=0 ; $i<count($datosEmpleDpto) ; $i++)
			 { 
				 if ($datos[0] == $datosEmpleDpto[$i]['dni'] )
				 {
					$stmt = $conn->prepare("UPDATE emple_dpto 
										SET  cod_dpto=:codigo
										WHERE dni=:dni");
					$stmt->bindParam(':dni', $datos[0]);
					$stmt->bindParam(':codigo', $seleccionado['cod_dpto']);
					
					if($stmt->execute())
					{
						echo "Datos introducidos correctamente en la tabla emple_dpto.";
						$varible=$datosEmpleDpto[$i]['cod_dpto'];
						echo $seleccionado['cod_dpto'];
					}
					else
					{
						echo "Error al registrar al empleado";
					}
				 } 
			 }
		 }
		 else{
			 echo "No se encontraron resultados en la tabla.";
		 }
		 
		
		
	}
	asignarDpto($datos, $conn, $seleccionado);
	
	
	
	function listaDepartamento($conn)
	{
	$stmt = $conn->prepare("SELECT nombre FROM dpto");
    $stmt->execute();

     $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 $nombresDpto=$stmt->fetchAll();
		
	return 	$nombresDpto;			
	}
	$departamentos=listaDepartamento($conn);
	
	function listaDni($conn)
	{
	$stmt = $conn->prepare("SELECT dni FROM emple");
    $stmt->execute();

     $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 $listaDni=$stmt->fetchAll();
		
	return 	$listaDni;			
	}
	$dni=listaDni($conn);
	
	
	if (!empty($dniUsu))
	{
		echo "<p>Dni seleccionado: " . $dniUsu . "</p>";
	} else {
        echo "<p>No se seleccionó ningún dni.</p>";
    }
	
	if (!empty($depart)) {
        echo "<p>Departamento seleccionado: " . $depart . "</p>";
    } else {
        echo "<p>No se seleccionó ningún departamento.</p>";
    }
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; //aqui la conexion se cierra automaticamente
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Empleado</title>
</head>
<body>
    <form method="POST" action="">
        <label for="dni">DNI del Empleado:</label>
		<select id="dni" name="dni" >
            <?php
            foreach ($dni as $row)
				{
					echo "<option value=\"" . $row['dni'] . "\">" . $row['dni'] . "</option>";
                }
            
            ?>
        </select><br>
	
		<br>
        <label for="departamento">Departamento:</label>
        <select id="departamento" name="departamento" >
            <?php
            foreach ($departamentos as $row)
				{
					echo "<option value=\"" . $row['nombre'] . "\">" . $row['nombre'] . "</option>";
                }
            
            ?>
        </select><br>
		<br>
        <input type="submit" value="Registrar Empleado" />
    </form>
</body>
</html>


