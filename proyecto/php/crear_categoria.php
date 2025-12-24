<?php require_once 'redirrecion.php' ?>
<?php require_once 'cabecera.php';?>

<!-- MAIN -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Crear reseñas</a></li>
    </ol>
</nav>
<div id="principal">
    <h1>Crear categorias</h1>
    <p>Crea una categoria para poder añadir tu propia reseña</p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="guardar-categoria.php" method="POST">
                <label class="col-form-label" for="nombre"> Nombre: </label>
                <input class="form-control" type="text" name="nombre"/>
                <?php echo isset ($_SESSION['errores_categoria']) ?mostrar_errores($_SESSION['errores_categoria'], 'nombre'): '' ?>
                <br>
                <input type="submit" class="btn btn-success mt-3" value="Guardar"/>
            </form>
            <?php borrar_errores(); ?>
        </div>
    </div>
</div>
<?php require_once 'footer.php' ?>
