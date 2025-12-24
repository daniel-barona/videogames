<?php 
    require_once "conexion.php";
    require_once "helpers.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto Reseñas</title>
        <link rel="stylesheet" href="../boostrap//css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                if (!empty($_SESSION['completado'])):
            ?>
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <?php echo htmlspecialchars($_SESSION['completado']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                    unset($_SESSION['completado']);
                endif;

                if (!empty($_SESSION['errores']) && is_array($_SESSION['errores'])):
            ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <?php
                    foreach ($_SESSION['errores'] as $campo => $mensaje) {
                        echo htmlspecialchars($mensaje) . '<br>';
                    }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                    // keep field-level errors for the form but clear session summary
                    unset($_SESSION['errores']);
                endif;
            ?>
            <header class="col-md-12 mt-2">
                <nav class="navbar navbar-expand-lg navbar-dark  navbar-custom bg-transparent border border-white border-2">
                    <div class="container-fluid">
                        <div id="logo">
                            <a class="navbar-brand" href="#"></a>
                            <a href="index.php">Games-Anime</a>
                        </div>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categorias
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- <li>
                                            <a class="dropdown-item" href="#">Action</a>
                                        </li> -->
                                        <?php 
                                            $categorias = conseguircategorias($db);
                                            if (!empty($categorias)):
                                                while($categoria = mysqli_fetch_assoc($categorias)):
                                        ?>
                                        <li><a class="dropdown-item" href="categoria.php?id=<?= $categoria['id'] ?>"><?=  $categoria ['nombre'] ?></a> </li>
                                        <?php 
                                            endwhile;
                                        endif;
                                        ?>
                                    </ul>
                                </li>
                                <?php if(!isset($_SESSION['usuario'])): ?>
                                <li class="nav-item">
                                    <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#inicio-session">Inicio de session</a>
                                </li>

                                <li class="nav-item">
                                    <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#registro">Registro</a>
                                </li>
                                <?php endif;?>
                                <?php if(isset($_SESSION['usuario'])): ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Bievenido !! <?= $_SESSION['usuario']['nombres'] . ' '. $_SESSION['usuario']['apellidos'] ?></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="crear_entradas.php" class="boton boton-verde"> Crear entradas</a>
                                                <a class="dropdown-item" href="crear_categoria.php" class="boton boton-verde"> Crear categorias</a>
                                                <a class="dropdown-item" href="mis_datos.php" class="boton boton-verde"> Mis datos</a>
                                                <a class="dropdown-item" href="cerrar.php" class="boton boton-verde"> Cerrar sesion</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <form action="buscar.php" method="POST" class="d-flex" role="search">
                                <input name="busqueda" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        
                    </div>
                </nav>
                <?php if(!isset($_SESSION['usuario'])): ?>
                        <!-- ventana de spam para el login and create user -->
                        <!-- login -->
                        <div class="modal fade" id="inicio-session" tabindex="-1" aria-labelledby="inicio-session" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="login.php" method="POST">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Iniciar la session</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="email" class="form-label">Usuario(Correo)</label>
                                            <input type="email" name="email" class="form-control" id="email">

                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                            <button type="submit" class="btn btn-primary">Continuar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- create user -->
                        <div class="modal fade" id="registro" tabindex="-1" aria-labelledby="registro" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="registro.php" method="POST">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Registrate</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="nombres" class="form-label">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" id="email">
                                            <?php echo isset ($_SESSION['errores']) ? mostrar_errores($_SESSION['errores'], 'nombres') : ''; ?>

                                            <label for="apellidos" class="form-label">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" id="password">

                                            <label for="email" class="form-label">Usuario(Correo)</label>
                                            <input type="email" name="email" class="form-control" id="email">

                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                            <button type="submit" class="btn btn-primary">Continuar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- fin -->
                        <?php endif; ?>
            </header>