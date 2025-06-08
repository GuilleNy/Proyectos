<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Concesionario - Empleados </title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
   
    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Empleados </div>
		<div class="card-body">

		<B>Codigo Empleado:</B>  <?php mostrarCodigo() ?>  <BR>
		<B>Nombre Empleado:</B>  <?php mostrarNombre() ?>  <BR>
			  
		<BR><BR>
		
		<!--Formulario con enlaces -->
		<form action='' method='post'>
		<div>
			<input type="submit" value="Alta Vehiculos" name="alta" class="btn btn-warning disabled">
			<input type="submit" value="Salir" name="salir" class="btn btn-warning disabled">
		</div>	
		</form>	
       
		
		  
	</div>  
	  
	  
     
   </body>
   
</html>


