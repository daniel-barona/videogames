<?php 
    require_once 'conexion.php';

    if(isset($_SESSION['usuario']) && isset($_GET['id'])){
        $entrada_id = intval($_GET['id']);
        $usuario_id = intval($_SESSION['usuario']['id']);

        $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
        $borrar = mysqli_query($db, $sql);

        if ($borrar && mysqli_affected_rows($db) > 0) {
            $_SESSION['completado'] = 'Reseña eliminada correctamente';
        } else {
            $_SESSION['errores']['general'] = 'No se ha podido eliminar la reseña';
        }
    }

    header("Location: index.php");
    exit();
?>