<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 35rem;">
		<div class="card-header">Reservar Vuelos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B> <?=  emailUsuario(); ?>      <BR>
		<B>Nombre Cliente:</B> <?= obtenerNombreUsuario(); ?>    <BR>
		<B>Fecha:</B> <?= date("Y-m-d"); ?>      <BR><BR>
		
		<B>Vuelos</B><select name="vuelos" class="form-control">
				<option value="" disabled selected>-- Selecciona Vuelo --</option>
				<?php
				
				foreach ($allVuelos as $fila)
					{
						print "<option value='".$fila["flight_id"]."|".$fila["flightno"]."|".$fila["salida"]."|".$fila["llegada"]."'>" . $fila['flightno'] ." salida de " .$fila['salida'] ." llegada a ". $fila['llegada']."</option>";
					}
					//var_dump($_SESSION["datosSorteo"]);
				?>
			</select>	
		<BR> 
		<B>Número Asiento</B><input type="text" name="asiento" size="3"  class="form-control">
		<BR>
        <?php
            if($cesta != null)
            {
                echo "<div id='cesta'>";
                print '<table class="table table-bordered table-hover table-sm text-nowrap"><tr><th>Id Vuelo</th><th>Nombre Vuelo</th><th>Salida</th><th>Llegada</th><th>Asiento</th><th>Precio Total</th></tr>';
                
                foreach ($cesta as $productoCesta => $detalles) {
                    print "<tr><td>".$detalles[0]."</td><td>".$detalles[1]."</td><td>".$detalles[2]."</td><td>".$detalles[3]."</td><td>".$detalles[4]."</td></tr>";
                }
                print "</tr>";
                echo "</div>";
            }
        ?>
        
        
        <BR>
		<div>
			
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Finalizar Reserva" name="comprar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controllers/controller_cerrarSesion.php" class="btn btn-primary">Cerrar Sesion</a>
		<br>
  </body>
   
</html>