<!-- crear usuario -->
<?php
require_once "conexion.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // recoger datos del metodo POST
    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    // Obtener la contraseña en crudo para hashearla correctamente
    $password = isset($_POST['password']) ? $_POST['password'] : false;

    $errores = array();

    //validacion antes de guardar los datos en bd
    if (!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres)) {
        $nombre_valido = true;
    } else {
        $nombre_valido = false;
        $errores['nombres'] = "El nombre no es valido";
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellido_valido = true;
    } else {
        $apellido_valido = false;
        $errores['apellidos'] = "El apellido no es valido";
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valido = true;
    } else {
        $email_valido = false;
        $errores['email'] = "El correo no es valido";
    }

    if (!empty($password)) {
        $password_valido = true;
    } else {
        $password_valido = false;
        $errores['password'] = "La contrasena no es valida";
    }

    if (count($errores) == 0) {
        // Cifrar la contraseña (hashear sobre el valor original)
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        // Escapar el hash antes de insertarlo en la BD
        $password_segura_esc = mysqli_real_escape_string($db, $password_segura);

        // INSERTAR EN BD (especificar columnas es buena práctica)
        $sql = "INSERT INTO usuarios (nombres, apellidos, email, password, fecha) VALUES('$nombres', '$apellidos', '$email', '$password_segura_esc', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con exito";
        } else {
            $_SESSION['errores']['general'] = "El registro no se ha completado";
            error_log('MySQL error: ' . mysqli_error($db));
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');
exit();
?>