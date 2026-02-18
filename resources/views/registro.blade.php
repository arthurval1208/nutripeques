<!DOCTYPE html>

<html>

<head>

    <title>Registro Firebase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

    <div class="row">

        <div class="col-md-6">

            <h3>Registrar Nuevo Usuario</h3>

            <form action="{{ url('/guardar-usuario') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Nombre Completo</label>

                    <input type="text" name="nombre" class="form-control" required>

                </div>

                <div class="mb-3">

                    <label>Correo Electrónico</label>

                    <input type="email" name="email" class="form-control" required>

                </div>

                <button type="submit" class="btn btn-success">Guardar en Firebase</button>

            </form>

        </div>

    </div>

</body>

</html>