<?php
    include 'conexion.php';
?>

<?php
    require_once 'cabecera.php';
?>

<div class="row justify-content-center">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item"><a href="#">Desarollo Web</a></li>
      <li class="breadcrumb-item"><a href="#">Componentes boostrap</a></li>
    </ol>
  </nav>

  <div class="slider col-lg-6 col-md-4 col-sm-6 col-xs-12 m-3">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">
                <div class="carousel-item active" style="background-image:url('../img/mario_broos.gif')">
          <div class="carousel-caption d-none d-md-block">
            <h5>Its me Mario</h5>
            <p>Time for salve the princess</p>
          </div>
        </div>

                <div class="carousel-item" style="background-image:url('../img/tkof.gif')">
          <div class="carousel-caption d-none d-md-block">
            <h5>The King of Fighters are back</h5>
            <p>Game for your figth.</p>
          </div>
        </div>

                <div class="carousel-item" style="background-image:url('../img/pacman.gif')">
          <div class="carousel-caption d-none d-md-block">
            <h5>Eat, Eat ,Eat</h5>
            <p>:V Look this pacman</p>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>

<h1>ALGUNAS OPINIONES Y RELEASE</h1>

<div class="row g-4 m-4 card-grid">
  <?php 
    $entradas = conseguir_entradas($db, true);
    if (!empty($entradas)):
        while ($entrada = mysqli_fetch_assoc($entradas)):
  ?>
  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100">
      <a href="entrada.php?id=<?= $entrada['id'] ?>">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-center"><?= $entrada['titulo']?></h5>
          <p class="card-text text-center flex-grow-1">
            <?= substr($entrada['descripcion'],0,180). '...' ?>
          </p>
          <p class="card-text text-center">
            <small><?= $entrada['categoria'] ?><br><?= $entrada['fecha'] ?></small>
          </p>
        </div>
      </a>
    </div>
  </div>
  <?php endwhile; endif; ?>
</div>
  <!-- <div class="card m-1">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>

  <div class="card m-1">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div> -->
<!-- </div> -->
<div id="ver-todas">
        <a href="entradas.php"> Ver todas las entradas</a>
</div>

<?php
    require_once 'footer.php';
?>