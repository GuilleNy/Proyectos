<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>TECHNOSHOP - Pedidos </title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">TECHNOSHOP - Consulta Pedidos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Nombre Completo Cliente:</B>  <BR>
		<B>Fecha Nacimiento:</B>  <BR>
		<B>Email:</B>    <BR>
		
		<BR><BR>
		
		<div class="card-body">
                <form action="" method="post" class="card-body">
                    <div class="form-group">
                        <label for="fechadesde">Fecha Desde: </label>
                        <input type="date" id="fechadesde" name="fechadesde" placeholder="fechadesde" class="form-control">
                    </div>
					<div class="form-group">
                        <label for="fechahasta">Fecha Hasta: </label>
                        <input type="date" id="fechahasta" name="fechahasta" placeholder="fechahasta" class="form-control">
                    </div>
                    <BR><BR>                  
                    <div>
					<input type="submit" value="Consultar Pedido" name="consultar" class="btn btn-warning disabled">
					<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
					</div>	    
                    
                </form>
        </div>
		
		   		
		
			
	
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "">Cerrar Sesion</a>
  </body>
   
</html>

