<?php
require_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }

    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    //consulta: obtener el usuario por email
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);

        //Comprobar contraseña
        $verify = password_verify($password, $usuario['password']);
        if($verify){
            $_SESSION['usuario'] = $usuario;
        } else {
            $_SESSION['error_login'] = "Login Incorrecto !!!!";  
        }
        //password_verify sirve para verficar las coontraseñas
    } else{
        $_SESSION['error_login'] = "Login Incorrecto !!!!";
    }
}
header('Location: index.php');
exit();
?>