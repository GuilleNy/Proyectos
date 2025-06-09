
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultar Apuesta</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Consultar Reservas</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B> <?=  emailUsuario(); ?>    <BR>
		<B>Nombre Cliente:</B> <?= obtenerNombreUsuario(); ?>     <BR>
		<B>Fecha:</B> <?= date("Y-m-d"); ?>     <BR><BR>
		
		<B>Numero Reserva</B><select name="reserva" class="form-control">
				<option value="" disabled selected>-- Selecciona un sorteo --</option>
				<?php
				
				foreach ($allReservas as $fila)
					{
						echo "<option value=\"" . $fila['booking_id'] . "\">" . $fila['booking_id'] . "</option>";
					}
					//var_dump($_SESSION["datosSorteo"]);
				?>
			</select>	
		<BR>
		<div class="mb-3 table-responsive" style="overflow-x: auto;">
				<table class="table table-bordered table-hover table-sm text-nowrap">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>NUMERO DE VUELO</th>
							<th>SALIDA</th>
							<th>LLEGADA</th>
							<th>FECHA DE SALIDA</th>
							<th>FECHA DE LLEGADA</th>
							<th>ASIENTO</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($datos)): ?>
							<?php foreach ($datos as $fila): ?>
								<tr>
									<td><?= htmlspecialchars($fila['name']) ?></td>
									<td><?= htmlspecialchars($fila['flightno']) ?></td>
									<td><?= htmlspecialchars($fila['salida']) ?></td>
									<td><?= htmlspecialchars($fila['llegada']) ?></td>
									<td><?= htmlspecialchars($fila['departure']) ?></td>
									<td><?= htmlspecialchars($fila['arrival']) ?></td>
									<td><?= htmlspecialchars($fila['seat']) ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr><td colspan="13" class="text-center">No hay apuestas para este sorteo.</td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>



		<div>
			<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controllers/controller_cerrarSesion.php" class="btn btn-primary">Cerrar Sesion</a>
   

</body>
</html>