<?php
require_once('vcompravehiculos.php');
?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Concesionario - Clientes </title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Concesionario - Clientes - Compra Vehiculos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Nombre Cliente:</B> <?php mostrarNombre() ?>  <BR>
		<B>Email:</B>   <?php mostrarEmail() ?>  <BR>
			  
		<BR><BR>
		
		
		
		<div class="form-group">
			<B>Vehículos</B><select name="vehiculos" class="form-control">
			<?php listaVehiculosDisponibles(); ?>
			</select>	
      	</div>
   		<BR><BR>
		<div>
			
			<input type="submit" value="Agregar Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Pedido" name="pedido" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "controllers/logout_controller.php">Cerrar Sesion</a>
  </body>
   
</html>

