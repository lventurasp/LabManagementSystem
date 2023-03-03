<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}


// Conectar a la base de datos
$host = "localhost";
$user = "AdminPHP";
$pass = "1234_dcBA";
$dbname = "mydb";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtener valores del formulario
$id = $_SESSION['id'];
$shelf = $_POST['o_shelf'];
$box = $_POST['o_box'];
$label = $_POST['label'];
$reference = $_POST['reference'];
$stock = $_POST['o_stock'];

// Ejecutar la consulta SQL para actualizar los datos
$sql = "UPDATE Reagents SET Shelf='$shelf', Box='$box', Label='$label', Reference='$reference', Stock='$stock' WHERE idReagents='$id'";
$result = mysqli_query($conn, $sql);


// Verificar si la consulta SQL fue exitosa
if ($result) {
    $_SESSION['message_ok'] = "Los datos se han actualizado correctamente.";
} else {
    $_SESSION['message_error'] = "Ha ocurrido un error al actualizar los datos.";
}

// Redirigir a la página de búsqueda
unset($_SESSION['id']);
header("Location: output.php");
?>

