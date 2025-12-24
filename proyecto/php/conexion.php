<?php 
//conexion 
$servidor= "localhost";
$usuario = "root";
$password = '';
$database = 'blog';
$db = mysqli_connect($servidor,$usuario,$password,$database);

// Configurar charset correctamente y comprobar conexión
if (!$db) {
    error_log('DB connection error: ' . mysqli_connect_error());
} else {
    if (!mysqli_set_charset($db, 'utf8')) {
        error_log('Error setting DB charset: ' . mysqli_error($db));
    }
}

//comenzar 

if(!isset($_SESSION)){
    session_start();
}
?>