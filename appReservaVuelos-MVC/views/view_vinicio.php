<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
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
			<div>
				<input type="submit" value="Reservar Vuelos" name="reservar" class="btn btn-warning disabled">
				<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
				<input type="submit" value="Salir" name="salir" class="btn btn-warning disabled">
			</div>	
		</form>
		
       
		
		  
	</div>  
</body>
</html>