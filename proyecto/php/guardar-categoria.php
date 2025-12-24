<?php 
    if (isset($_POST)) {
        require_once 'conexion.php';
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        //Array de errores
        $errores = array();
        //Validar los datos antes de guardarlos en la base de datos
        if(empty($nombre)){
            $errores['nombre'] = "El nombre de la categoría no es válido";
        }
        if(count($errores) == 0){
            $sql = "INSERT INTO categorias VALUES (null, '$nombre');";
            $guardar = mysqli_query($db, $sql);
            if ($guardar) {
                $_SESSION['completado'] = 'Categoría guardada correctamente';
            } else {
                $_SESSION['errores'] = ['general' => 'Error al guardar la categoría en la base de datos.'];
            }
            header("Location: index.php");
        } else {
            $_SESSION['errores_categoria'] = $errores;
            header("Location: crear_categoria.php");
        }
    } else {
        header("Location: crear_categoria.php");
    }
?>