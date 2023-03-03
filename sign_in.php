<?php
session_start();

// Recibir los datos del formulario de inicio de sesión
$username = $_POST['username'];
$password = $_POST['password'];

// Conectar a la base de datos
$host = "localhost";
$user = "AdminPHP";
$pass = "1234_dcBA";
$dbname = "mydb";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario de registro
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    // Insertar los datos del usuario en la tabla de usuarios
    $sql = "INSERT INTO User (Email, Password, Name, Surname) VALUES ('$email', '$password', '$name', '$surname')";
    if (mysqli_query($conn, $sql)) {
    // Si el registro fue exitoso, agregar los permisos del usuario en la tabla User_has_Privilege
    $sql2 = "INSERT INTO User_has_Priviledge (User_Email, Priviledge_Priviledge) VALUES ('$email', 'R')";
    mysqli_query($conn, $sql2);

    // Iniciar sesión y redirigir al usuario a una página restringida
    $_SESSION['username'] = $email;
    header("location: choose_options.php");
}   
    else {
    // Si hubo un error en la inserción de datos, mostrar un mensaje de error
    $error_message = "Failed to register user." . mysqli_error($conn);
}

}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>LabManagementSystem</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">LabManagementSystem</a>
            </div>
        </nav>
        <!-- Services-->
        <section class="options">
    <div class="container my-6">
        <div class="text-center">
            <h1 class="section-heading my" >Sign up</h1>
            <form name="MainForm" action="" method="POST" enctype="multipart/form-data">
                <div class="form">
                    <label>Email</label>
                    <p>
                        <input type="text" name="email" size="5" style="width:50%">
                    </p>
                </div>
                <div class="form">
                    <label>Password</label>
                    <p>
                        <input type="password" name="password" size="5" style="width:50%">
                    </p>
                </div>
                <div class="form">
                    <label>Name</label>
                    <p>
                        <input type="text" name="name" size="5" style="width:50%">
                    </p>
                </div>
                <div class="form">
                    <label>Surname</label>
                    <p>
                        <input type="text" name="surname" size="5" style="width:50%">
                    </p>
                </div>
                <p>
                    <button type="submit" class="btn btn-primary">Register</button>
                </p>
            </form>
        </div>
    </div>
</section>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>


        <!-- Footer-->
    <footer class="footer py-4">
        <div class="text-center">
            <a href="index.html#contact"><button type='contact' class="btn btn-primary">Contact</button></a>
        </div>          
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
