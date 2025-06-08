<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Concesionario - Empleados - Alta Vehiculos</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Alta Vehiculos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Codigo Empleado:</B>  <?php mostrarCodigo() ?>  <BR>
		<B>Nombre Empleado:</B>  <?php mostrarNombre() ?>  <BR>
			  
		<BR><BR>
		
		<div class="form-group">
			Bastidor <input type="text" name="num_bastidor" placeholder="num_bastidor" class="form-control">
      		</div>
      		<div class="form-group">
			Matricula <input type="text" name="matricula" placeholder="matricula" class="form-control">
      		</div>
   		<div class="form-group">
			Marca <input type="text" name="marca" placeholder="marca" class="form-control">
      		</div>
      		<div class="form-group">
			Modelo <input type="text" name="modelo" placeholder="modelo" class="form-control">
      		</div>
		<div class="form-group">
			Kms <input type="text" name="kms" placeholder="kms" class="form-control">
      		</div>
      		<div class="form-group">
			Precio <input type="text" name="precio" placeholder="precio" class="form-control">
      		</div>
      		<div class="form-group">
			Descuento <input type="text" name="descuento" placeholder="descuento" class="form-control">
      		</div>
		
		
		<BR><BR>
		<div>
			
			<input type="submit" value="Alta Vehiculo" name="alta" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "controllers/logout_controller.php">Cerrar Sesion</a>
  </body>
   
</html>

