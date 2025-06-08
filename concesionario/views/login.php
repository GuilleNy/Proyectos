<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - CONCESIONARIO LEONARDO DA VINCI</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    <div class="container">
        <!--Aplicacion-->
        <div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="" method="post" class="card-body">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" placeholder="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="password" class="form-control">
                    </div>
                    <!-- Grupo de radio buttons para tipo de acceso -->
                    <div class="form-group">
                        <label>Tipo de Acceso:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoAcceso" id="accesoClientes" value="clientes" checked>
                            <label class="form-check-label" for="accesoClientes">
                                Acceso Clientes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoAcceso" id="accesoEmpleados" value="empleados">
                            <label class="form-check-label" for="accesoEmpleados">
                                Acceso Empleados
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

