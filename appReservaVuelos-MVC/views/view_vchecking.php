<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checking</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario </div>
		<div class="card-body">

		<B>Email Cliente:</B> <?=  emailUsuario(); ?>   <BR>
		<B>Nombre Cliente:</B> <?= obtenerNombreUsuario(); ?>    <BR>
		<B>Fecha:</B> <?= date("Y-m-d"); ?>    <BR><BR>
	  
		<!--Formulario con enlaces -->
		<form action='' method='post'>
            <B>Vuelos</B><select name="vuelos" class="form-control">
				<option value="" disabled selected>-- Selecciona reserva --</option>
				<?php
				
				foreach ($allReservas as $fila)
					{
						print "<option value='".$fila["flight_id"]."|".$fila["flightno"]."|".$fila["salida"]."|".$fila["llegada"]."'>" . $fila['flightno'] ." salida de " .$fila['salida'] ." llegada a ". $fila['llegada']."</option>";
					}
					//var_dump($_SESSION["datosSorteo"]);
				?>
			</select>	
		<BR> 
			<div>
				
				<input type="submit" value="Checking" name="hacerChecking" class="btn btn-primary disabled">
				<input type="submit" value="Volver" name="volver" class="btn btn-primary disabled">
				<input type="submit" value="Cerrar Sesion" name="salir" class="btn btn-warning disabled">
			</div>	
		</form>
		
       
		
		  
	</div>  
</body>
</html>