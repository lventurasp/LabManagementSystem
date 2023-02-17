<?php

//Take data , if empty back to front page

if (!isset($_GET['id'])) {
    header('Location: search.php');
}

// Retrieve the ID from the query parameter
$id = $_GET['id'];

// Retrieve the row data from the database
$host = "localhost";
$user = "AdminPHP";
$pass = "1234_dcBA";
$dbname = "mydb";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database
$sql = "SELECT Name, Shelf, Box, Label, Reference, Stock, Placement_idPlacement FROM Reagents WHERE idReagents = '$id'";
$result = mysqli_query($conn, $sql);


// Loop through the query results
while ($row = mysqli_fetch_array($result)) {
    // Get the values of each column
    $name = $row['Name'];
    $shelf = $row['Shelf'];
    $box = $row['Box'];
    $label = $row['Label'];
    $reference = $row['Reference'];
    $stock = $row['Stock'];
    $id_container = $row['Placement_idPlacement'];

}

$sql = "SELECT Number FROM Placement WHERE idPlacement='$id_container'";
        $container = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($container);
        $container = $row["Number"];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LabManagementSystem</title>
    <!-- Bootstrap styles -->
    <link href="css/styles.css" rel="stylesheet" />
  

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
                    <li class="nav-item"><a class="nav-link" href="#services">Log out </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Options-->
    <header class="options">
        <div class="row">
            <div class="col-lg-4">
            </div>
                <div class="col-lg-4">
                <div class="priviledge-option_read mt-2">
                    <h4>Search results</h4>
                    <h4 class="subheading_options"><?php echo $name; ?></h4>
                </div>
                <div class= "container mt-2">
                    <div class="square">
                        <form name="MainForm" action="output.php" method="GET" enctype="multipart/form-data">
                            <div class="row">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Container</label>                  
                                        <input type="text" name="o_container" style="width:100%" size="5" value="<?php echo $container; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Shelf number</label>                  
                                        <input type="text" name="o_shelf" style="width:100%" size="5" value="<?php echo $shelf; ?>">
                                        <label>Box number</label>                  
                                        <input type="text" name="o_box" style="width:100%" size="5" value="<?php echo $box; ?>">                                     
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group">
                                        <label>Label</label>                  
                                        <input type="text" name="label" style="width:100%" size="5" value="<?php echo $label; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Reference</label>                  
                                        <input type="text" name="reference" style="width:100%" size="5" value="<?php echo $reference; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Remaining stock</label>                  
                                        <input type="text" name="o_stock" style="width:100%" size="5" value="<?php echo $stock; ?>">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p>
                        <button type='submit' class="btn btn-primary" href="output.htm">Edit</button>
                    </p>
                </div>
            </div>
            </form>
        </div>  
    </header>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="row">
            <div class="text-center">
                <a href="index.html#contact"><button type='contact' class="btn btn-primary">Contact</button></a>
            </div>          
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
