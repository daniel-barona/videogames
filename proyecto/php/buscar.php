<?php 
    if (!isset($_POST['busqueda'])) {
        header("Location: index.php");
    }
?>
<?php 
    require_once 'cabecera.php';
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    </ol>
</nav>
<h1>Busqueda: <?= $_POST['busqueda'] ?></h1>

<!-- MAIN -->

<div class="row">
    <?php 
        $entradas = conseguir_entradas($db, null,null, $_POST['busqueda']);

        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
    <div class="col-sm-6">
        <div class="card-m4">
            <a href="entrada.php?id=<?= $entrada['id'] ?>">
                <div class="card m-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $entrada['titulo']?></h5>
                        <p class="card-text text-center"><?= substr($entrada['descripcion'],0,180). '...' ?></p> 
                        <p class="card-text text-center"><small class="text-muted"><?= $entrada['categoria']. "<br>". $entrada['fecha'] ?></small></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php 
            endwhile;
        else:
    ?>
    <div class="alert alert-danger" role="alert"> No hay entradas con ese nombre</div>
    <?php endif; ?>
</div>