<?php require_once 'conexion.php'?>
<?php require_once 'helpers.php' ?>
<?php 
    $entrada_actual = mostrar_entrada($db, $_GET['id']);

    if (!isset($entrada_actual['id'])) {
        header("Location: index.php");
    }
?>
<?php require_once 'cabecera.php'; ?>
<?php //require_once 'lateral.php'; ?>

<!-- MAIN -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="entradas.php">Entradas</a></li>
        <li class="breadcrumb-item"><a href="#"><?= $entrada_actual['titulo'] ?></a></li>
    </ol>
</nav>
<div class="card-group m-4">
    <div class="card m-1">
        <div class="card-body">
            <h1 class="card-tittle"><?= $entrada_actual['titulo'] ?></h1>
            <h2>
                <a class="text-success" href="categoria.php?id=<?= $entrada_actual['categoria_id'] ?>"> <?= $entrada_actual['categoria'] ?></a>
            </h2>
            <h4><?= $entrada_actual['fecha']?> | <?= $entrada_actual['usuario'] ?></h4>
            <p class="card-text mt-4"><?= $entrada_actual['descripcion'] ?></p>
        </div>
        <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
            <br>
            <a href="editar_entrada.php?id=<?= $entrada_actual['id'] ?>" type="button" class="btn btn-outline-secondary"> Editar Reseña</a>
            <a href="borrar_entrada.php?id=<?= $entrada_actual['id'] ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro que deseas eliminar esta reseña?');"> Eliminar Reseña</a>
        <?php endif; ?>
    </div>
</div>
<?php require_once 'footer.php'; ?>