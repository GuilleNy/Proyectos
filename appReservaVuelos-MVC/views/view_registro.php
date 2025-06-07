<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <form name="registro" action="" method="POST" class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Registrarse</b></h2>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><b>Nombre:</b></label>
                        <input type="text" name="nombre"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label"><b>Fecha de nacimiento:</b></label>
                        <input type="date" name="fechaNac" class="form-control w-75 mx-auto">
                    </div>
                    
                    <div class="mb-3">
                        <label for="genero" class="form-label"><b>Sexo:</b></label>
                        <select class="custom-select w-auto" name="genero" >
                            <option disabled selected>--Seleccione Género--</option>
                            <option value="m">Masculino</option>
                            <option value="w">Femenino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label"><b>Direccion:</b></label>
                        <input type="text" name="direccion"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label"><b>Ciudad:</b></label>
                        <input type="text" name="ciudad"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="codigoPostal" class="form-label"><b>Codigo Postal:</b></label>
                        <input type="text" name="codigoPostal"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label"><b>Pais:</b></label>
                        <input type="text" name="pais"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><b>Email:</b></label>
                        <input type="text" name="email" class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label"><b>Telefono:</b></label>
                        <input type="text" name="telefono"  class="form-control w-75 mx-auto">
                    </div>

                    <div>
                        <input type="submit" value="Registrarse" name="registro" class="btn btn-primary">
                    </div>
                    <hr>
                    <div>
                        <a href="../index.php" class="btn btn-warning">Volver al Login</a>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
    

</body>
</html>
