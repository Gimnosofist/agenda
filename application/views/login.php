<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Programadores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Centramos el formulario */
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

    <div class="login-container">
        <div class="login-box">
            <h3 class="text-center mb-3">Iniciar Sesión</h3>
                <?php if($this->session->flashdata("error")):?>
              <div class="alert alert-danger">
                <p><?php echo $this->session->flashdata("error")?></p>
              </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo base_url("auth/pre_auth_email");?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Ingresar</button>
            </form>
            <hr>
            <div align="center"><a href="<?php echo base_url("registro"); ?>">Crear una cuenta</a></div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
