<?php 
    require_once 'cabecera.php';
?>
<?php 
    //require_once 'lateral.php';
?>
<!-- MAIN -->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    </ol>
</nav>
<h1>Todas las entradas</h1>
<div class="row">
    <?php 
        $entradas = conseguir_entradas($db);
        if (!empty($entradas)): 
            while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
    <div class="col-sm-6">
        <div class="card-m4">
            <a href="entrada.php?id=<?= $entrada['id'] ?>">
                <div class="card m-1">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $entrada['titulo']?></h5>
                        <p class="card-text text-center"><?= substr($entrada['descripcion'],0,180). '...' ?></p> 
                        <p class="card-text text-center"><small><?= $entrada['categoria']. "<br>". $entrada['fecha'] ?></small></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php 
            endwhile;
        endif;
    ?>
    <?php 
        require_once 'footer.php'; 
    ?>
</div>