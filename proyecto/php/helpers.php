<?php 
    function conseguircategorias($conexion){
        $sql = "SELECT * FROM categorias ORDER BY id ASC;";
        $categorias = mysqli_query($conexion, $sql);
        
        $resultado = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $resultado = $categorias;
        }
        return $resultado;
    };
    function mostrar_errores($errores, $campo){
        $alerta = '';
        if(isset($errores[$campo]) && !empty($campo)){
            $mensaje = htmlspecialchars($errores[$campo]);
            $alerta = '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">' . $mensaje . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        return $alerta;  
    }
    function borrar_errores(){
        $borrar = false;
        if(isset($_SESSION['errores'])){
            $_SESSION['errores'] = null;
            $borrar = true;
        }
        if(isset($_SESSION['errores_entrada'])){
            $_SESSION['errores_entrada'] = null;
            $borrar = true;
        }
        if (isset($_SESSION['completado'])) {
            $_SESSION['completado'] = null;
            $borrar = true;
        }
        if (isset($_SESSION['errores_categoria'])) {
            $_SESSION['errores_categoria'] = null;
            $borrar = true;
        }
        return $borrar;
    }
    function conseguir_entradas($conexion, $limit = null,$categoria = null, $busqueda = null){
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ";
            if (!empty($categoria)) {
                $sql .= "WHERE e.categoria_id = $categoria ";
            }

            if (!empty($busqueda)) {
                $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
            }
        $sql .= "ORDER BY e.id DESC ";

        if($limit){
            $sql .= "LIMIT 4";
        }
        $entradas = mysqli_query($conexion, $sql);
        $resultado = array();
        if ($entradas && mysqli_num_rows($entradas) >= 1) {
            $resultado = $entradas;
        }
        return $resultado;
    }
    function conseguir_categoria($conexion , $id){
        $sql = "SELECT * FROM categorias WHERE id = $id;";
        $categoria = mysqli_query($conexion, $sql);
        $resultado = array();
        if($categoria && mysqli_num_rows($categoria) >= 1){
            $resultado = mysqli_fetch_assoc($categoria);
            return $resultado;
        }
    }
    function mostrar_entrada($conexion, $id){
        $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombres, ' ', u.apellidos) AS 'usuario'  FROM entradas e ".
        "INNER JOIN categorias c ON e.categoria_id = c.id ".
        "INNER JOIN usuarios u ON e.usuario_id = u.id ".
        "WHERE e.id = $id;";
        $entrada = mysqli_query($conexion, $sql);

        $resultado = array();
        if ($entrada && mysqli_num_rows($entrada) >= 1) {
            $resultado = mysqli_fetch_assoc($entrada);
        }
        return $resultado;
    }
?>