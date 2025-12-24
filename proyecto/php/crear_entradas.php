<?php require_once 'redirrecion.php' ?>
<?php
    require_once 'cabecera.php';
?>
<?php //require_once 'lateral.php' ?>
<!-- MAIN -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Crear reseñas</a></li>
    </ol>
</nav>
<div id="principal">
    <h1>Crear reseñas</h1>
    <p>Añade nuevas reseñas sobre tus videojuegos favoritos o proximos lanzamientos, demos, etc...</p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="guardar-entrada.php" method="POST">
                <label class="col-form-label" for="titulo"> TITULO: </label>
                <input class="form-control" type="text" name="titulo"/>
                <?php echo isset ($_SESSION['errores_entrada']) ?mostrar_errores($_SESSION['errores_entrada'], 'titulo'): '' ?>

                <label class="col-form-label" for="descripcion"> DESCRIPCION: </label>
                <textarea class="form-control" type="text" name="descripcion"></textarea>
                <?php echo isset ($_SESSION['errores_entrada']) ?mostrar_errores($_SESSION['errores_entrada'], 'descripcion'): '' ?>
                <label class="col-form-categoria" for="categoria" >CATEGORIA:</label>
                <select class="from-select" name="categoria">
                    <option selected disabled>Categoría</option>
                    <?php 
                        $categorias = conseguircategorias($db);
                        if(!empty($categorias)):
                            while($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                    <?php 
                            endwhile;
                        endif;
                    ?>
                </select>
                <?php echo isset($_SESSION['errores_entrada']) ?mostrar_errores($_SESSION['errores_entrada'], 'categoria') : '' ?>
                <input type="submit" class="btn btn-success mt-3" value="Guardar"/> 
            </form>
            <?php borrar_errores(); ?>
        </div>
    </div>
</div>
<?php require_once 'footer.php' ?>