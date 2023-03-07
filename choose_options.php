<?php

session_start();
require "globals.inc.php";
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

?>

<?php

// Recibir los datos del formulario de inicio de sesión
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());

};    

// Obtener el nombre del usuario a partir del nombre de usuario
$username2 = $_SESSION['username'];
$sql = "SELECT name FROM User WHERE Email='$username2'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$name = mysqli_fetch_assoc($result)['name'];
$_SESSION['name'] = $name;

// Obtener privilegios
$sql = "SELECT Priviledge.Priviledge_type
        FROM User
        JOIN User_has_Priviledge ON User.Email = User_has_Priviledge.User_Email
        JOIN Priviledge ON User_has_Priviledge.Priviledge_Priviledge = Priviledge.Priviledge
        WHERE User.Email = '" . $username2 . "';";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

$privilege_type = $row['Priviledge_type'];

$_SESSION['privilege_type'] = $privilege_type; 

mysqli_free_result($result);


mysqli_close($conn);
  
  


if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];;
    unset($_SESSION['error_message']);
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LabManagementSystem</title>
    <!-- Bootstrap styles -->
    <link href="css/styles.css" rel="stylesheet" />
  
    <!-- IE 8 Support-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
        <link rel="stylesheet" href=\"DataTable/jquery.dataTables.min.css\"/>
        <script type="text/javascript" src="DataTable/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="DataTable/jquery.dataTables.min.js"></script>
</head>
<body id="page-top">
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">LabManagementSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Welcome, <?php echo $name; ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log out </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Options-->
    <header class="choose_options">
            <div class="text-center">
                <h2 class="choose_options-heading text-uppercase">Options</h2>
                <h4 class="subheading_options"> Which priviledge do you have?</h4>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class= "container">
                        <div class="text-center">
                            <p>
                                <a href="create_search.php"><button type='priviledge' class="btn btn-primary">CREATE </button></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class= "container">
                        <div class="text-center">
                            <p>
                                <a href="add_search.php"><button type='priviledge' class="btn btn-primary" href=>ADD A NEW REAGENT</button></a>
                            </p>
                            <?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>
                        </div>
                    </div>  
                </div>
                <div class="col-lg-4">
                    <div class= "container">
                        <div class="text-center">
                            <p>
                                <a href="search.php" ><button type='priviledge' class="btn btn-primary">ONLY READ</button></a>
                            </p>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="row"></div>
            <div class="row"></div>
    </header>
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
