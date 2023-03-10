<?php

    session_start();
    require "globals.inc.php";
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
    }
    
    if (!isset($_SESSION['privilege_type']) || $_SESSION['privilege_type'] != 'build placements') {
    $error_message = "You don't have permissions to acces here";
    $_SESSION['error_message'] = $error_message;
    header("location: choose_options.php");
    }
    
    $name = $_SESSION['name'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $type = $_POST['Container_Type'];
    $number = $_POST['Container_Number'];
    $shelves = $_POST['shelves'];
    $boxes = $_POST['boxes'];
    
    if (($shelves or $boxes) <= 0) {
        // Display a pop-up to the user if the value already exists in the database
        echo "<script>alert('Shelves and Boxes cannot be 0');</script>";
        } else {

        $id_placement = uniqid('placement');
        $id_partition = uniqid('partition');

        $conn = mysqli_connect($host, $user, $pass, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the Placement Number already exists in the database
        $sql = "SELECT * FROM Placement WHERE Number='$number' AND Type='$type'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Display a pop-up to the user if the value already exists in the database
            echo "<script>alert('The value already exists in the database!');</script>";
        } else {

        $sql = "INSERT INTO Placement (idPlacement,type, number) VALUES ('$id_placement','$type', '$number')";
        mysqli_query($conn, $sql);


        
        $sql = "INSERT INTO Partition_type (idPartition_type,Shelves, Box) VALUES ('$id_partition','$shelves', '$boxes')";
        mysqli_query($conn, $sql);



        $sql = "INSERT INTO Placement_has_Partition_type (Placement_idPlacement , Partition_type_idPartition_type ) VALUES ('$id_placement', '$id_partition')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('The addition was successful!');</script>";
                
        mysqli_close($conn);
    
            }
        }
    }
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
  
        <script type="text/javascript" src="DataTable/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="DataTable/jquery.dataTables.min.js"></script>
</head>
<body id="page-top">
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
        <img class="img-fluid mb-3 mb-lg-3" src="matraz.png" width="50" height="50" alt="..." />
            <a class="navbar-brand" href="choose_options.php">LabManagementSystem</a>
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
        <form name="MainForm" action="create_search.php" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-lg-4">
            </div>
                <div class="col-lg-4">
                <div class="priviledge-option_read ">
                    <h3>Create a new container</h3>
                </div>
                <div class= "container">
                    <div class="square">
                        <div class="row">
                            <div class="form-group">
>
                                <label>Container type</label>
                                <select name="Container_Type">
                                    <option value ="Fridge">Fridge</option>
                                    <option value ="Freezer">Freezer</option>
                                    <option value ="Shelf">Shelf</option>
                                </select>
                            </div> 
                        </div>                          
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Number of placement</label>                  
                                    <input type="text" name="Container_Number" size="4" value="0">
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Shelves</label>                  
                                    <input type="text" name="shelves" size="4" value="0">
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="text-center">
                                <div class="form-group">
                                    <label>Boxes</label>                  
                                    <input type="text" name="boxes" size="4" value="0" >
                                </div>
                </div>
            </div>
        </div>
                        </div>
                    </div>
 
                    <div class="row">
                        <div class="text-center">
                            <p>
                            <button type='submit' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-primary">Reset</button>
                            </p>
                        </div>
                    </div> 
            </form> 
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
