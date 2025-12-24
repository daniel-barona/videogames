<?php   require_once 'conexion.php';?>
<?php   require_once 'helpers.php'; ?>
<?php 
    $categoria_actual = conseguir_categoria($db, $_GET['id']);

    if (!isset($categoria_actual['id'])) {
        header("Location: index.php");
    }
?>
<?php require_once 'cabecera.php' ?>
<?php //require_once 'lateral.php' ?>

<!-- MAIN -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Categorias</a></li>
        <li class="breadcrumb-item"><a href="#"><?= $categoria_actual['nombre'] ?></a></li>
    </ol>
</nav>
<h1>Reseñas/Release de <?= $categoria_actual['nombre'] ?></h1>
<div class="row">
    <?php 
        $entradas = conseguir_entradas($db, null, $_GET['id'], null);

        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
        <div class="col-sm-6">
            <div class="card m-4">
                        <a href="entrada.php?id=<?= $entrada['id'] ?>">
                            <h5 class="card-title text-center"><?= $entrada['titulo']?></h5>
                            <p class="card-text text-center"><?= substr($entrada['descripcion'],0,180). '...' ?></p> 
                            <p class="card-text text-center"><small class="text-muted"><?= $entrada['categoria']. "<br>". $entrada['fecha'] ?></small></p>
                        </a>
            </div>
        </div>
    <?php 
        endwhile;
        else:
    ?>
    <div class="alert alert-danger" role="alert"> No hay reseñas en esta categoria</div>
    <?php endif; ?>
</div>
<?php 
    require_once 'footer.php';
?>
