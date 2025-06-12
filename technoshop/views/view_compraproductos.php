<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title> TECHNOSHOP - Compra </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">TECHNOSHOP - Compra Productos </div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Nombre Completo Cliente:</B>  <?=  $datosUsuario['nombre']; ?>  <?=  $datosUsuario['apellidos']; ?> <BR>
		<B>Fecha Nacimiento:</B> <?=  $datosUsuario['fecha_nacimiento']; ?>  <BR>
		<B>Email:</B>   <?=  emailUsuario(); ?>  <BR>
			  
		<BR><BR>
		
		
		
		<div class="form-group">
			<B>Productos</B><select name="productos" class="form-control">
				<option value="" disabled selected>-- Selecciona un producto --</option>
				<?php
				
				foreach ($allProductos as $fila)
					{
						print "<option value='".$fila["id_producto"]."|".$fila["nombre_producto"]."|".$fila["precio_unidad"]."|".$fila["descuento"]."'>" . $fila['nombre_categoria'] ." ---- " .$fila['nombre_producto'] ." ---> ". $fila['precio_unidad']."</option>";
					}
					
					//var_dump($_SESSION["datosSorteo"]);
				?>
			</select>
			</select>	
      	</div>
   		<BR>
		 <?php
            if($cesta != null)
            {
                echo "<div id='cesta'>";
                print '<table class="table table-bordered table-hover table-sm text-nowrap"><tr><th>Id Producto</th><th>Nombre Producto</th><th>Precio</th></tr>';
                
                foreach ($cesta as $productoCesta => $detalles) {
                    print "<tr><td>".$detalles[0]."</td><td>".$detalles[1]."</td><td>".$detalles[2]."</td></tr>";
                }
                print "</tr>";
                echo "</div>";
            }
        ?>
		<BR>
		<div>
			
			<input type="submit" value="Agregar Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Pedido" name="pedido" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controllers/controller_cerrarSesion.php" class="btn btn-primary">Cerrar Sesion</a>
  </body>

  
	<?php
        if (isset($params) && isset($signature) && $params != null && $signature != null) {
            echo "
            <form style='display:none;' id='formularioPago' action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST'>
                <input type='hidden' name='Ds_SignatureVersion' value='" . $version . "'/>
                <input type='hidden' name='Ds_MerchantParameters' value='" . $params . "'/>
                <input type='hidden' name='Ds_Signature' value='" . $signature . "'/>	
            </form>
            <script>document.getElementById('formularioPago').submit();</script>";
        }
    ?>
   
</html>

