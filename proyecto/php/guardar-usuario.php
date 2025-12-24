<?php 
// Mostrar errores temporalmente para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conexion.php';

    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

        //Array de errores
        $errores = array();

        //Validar los datos antes de guardarlos en la base de datos
        if(!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres)){
            $nombre_validado = true;
        }else{
            $nombre_validado = false;
            $errores['nombres'] = "El nombre no es válido";
        }
        
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
            $apellidos_validado = true;
        }else{
            $apellidos_validado = false;
            $errores['apellidos'] = "Los apellidos no son válidos";
        }
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valido = true;
        } else {
        $email_valido = false;
        $errores['email'] = "El correo no es valido";
        }
        if (count($errores) == 0) {
            $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

            $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
            $isset_email = mysqli_query($db, $sql);
            $isset_user = null;
            if ($isset_email && mysqli_num_rows($isset_email) > 0) {
                $isset_user = mysqli_fetch_assoc($isset_email);
            }

            if (empty($isset_user) || ($usuario && $isset_user['id'] == $usuario['id'])) {
                $sql = "UPDATE usuarios SET " .
                    "nombres = '$nombres', " .
                    "apellidos = '$apellidos', " .
                    "email = '$email' " .
                    "WHERE id = " . $usuario['id'];
                $guardar = mysqli_query($db, $sql);

                if ($guardar) {
                    $_SESSION['usuario']['nombres'] = $nombres;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['errores']['general'] = "Error al actualizar tus datos!!";
                    header("Location: mis_datos.php");
                    exit();
                }
            } else {
                $_SESSION['errores']['general'] = "El correo ya existe!!";
                header("Location: mis_datos.php");
                exit();
            }
        } else {
            $_SESSION['errores'] = $errores;
            header("Location: mis_datos.php");
            exit();
        }
    }
?>