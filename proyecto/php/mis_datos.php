<?php require_once 'redirrecion.php'; ?>
<?php require_once 'cabecera.php'; ?>
<?php //require_once 'lateral.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Mis datos</a></li>
    </ol>
</nav>

<div id="principal">
    <h1>Mis datos</h1>
    <p>En este apartado podras observar y actualizar tus datos de usuario</p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="guardar-usuario.php" method="POST">
                <label class="col-form-label" for="nombres"> NOMBRE: </label>
                <input class="form-control" type="text" name="nombres" value="<?= $_SESSION['usuario']['nombres']; ?>"/>
                <?php echo isset ($_SESSION['errores']) ?mostrar_errores($_SESSION['errores'], 'nombres'): '' ?>
                <label class="col-form-label" for="apellidos"> APELLIDOS</label>
                <input class="form-control" type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos']; ?>"/>
                <?php echo isset ($_SESSION['errores']) ?mostrar_errores($_SESSION['errores'], 'apellidos'): '' ?>
                <label class="col-form-label" for="email"> EMAIL: </label>
                <input class="form-control" type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>"/>
                <?php echo isset ($_SESSION['errores']) ?mostrar_errores($_SESSION['errores'], 'email'): '' ?>
                <input type="submit" class="btn btn-success mt-3" value="Guardar"/> 
            </form>
            <?php borrar_errores(); ?>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>

