<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Programadores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/estilos.css'); ?>">

    <!--CoreUi Vanilla-->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.10.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-iFYnumxmAfPWEvBBHVgQ1pcH7Bj9XLrhznQ6DpVFtF3dGwlEAqe4cmd4NY4cJALM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
   <script src="<?php echo base_url("assets/js/app.js");?>"></script>

</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Agenda de Programadores</a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("programador");?>">Listado de Programadores </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("programador/agregar");?>">Agregar Programador</a>
                    </li>
                    
                    <li class="nav-item"></li>

      
<li class="nav-item">
</li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>" id="logout-link">Salir</a>

                    </li>

                </ul>
            </div>
        </div>
    </nav>



